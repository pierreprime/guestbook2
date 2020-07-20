<?php


namespace App\MessageHandler;

use App\Message\CommentMessage;
use App\Repository\CommentRepository;
use App\SpamChecker;
use Doctrine\ORM\EntityManagerInterface;
use Psr\Log\LoggerInterface;
use Symfony\Component\Messenger\Handler\MessageHandlerInterface;
use Symfony\Component\Messenger\MessageBusInterface;
use Symfony\Component\Workflow\WorkflowInterface;

class CommentMessageHandler implements MessageHandlerInterface
{
    private $spamChecker;
    private $em;
    private $commentRepository;
    private $bus;
    private $workflow;
    private $logger;

    public function __construct(
        EntityManagerInterface $em,
        SpamChecker $spamChecker,
        CommentRepository $commentRepository,
        MessageBusInterface $bus, WorkflowInterface $commentStateMachine,
        LoggerInterface $logger = null
    ) {
        $this->em = $em;
        $this->spamChecker = $spamChecker;
        $this->commentRepository = $commentRepository;
        $this->bus = $bus;
        $this->workflow = $commentStateMachine;
        $this->logger = $logger;
    }

    public function __invoke(CommentMessage $message)
    {
        $comment = $this->commentRepository->find($message->getId());
        if (!$comment) {
            return;
        }

        if ($this->workflow->can($comment, 'accept')) {
            $score = $this->spamChecker->getSpamScore($comment, $message->getContext());
            $transition = 'accept';
            if (2 === $score) {
                $transition = 'reject_spam';
            } else {
                if (1 === $score) {
                    $transition = 'might_be_spam';
                }
            }
            $this->workflow->apply($comment, $transition);
            $this->em->flush();
            $this->bus->dispatch($message);
        } else if($this->workflow->can($comment, 'publish') || $this->workflow->can($comment, 'publish_ham')){
            $this->em->flush();
        }
        else if ($this->logger) {
            $this->logger->debug('Dropping comment message',
                ['comment' => $comment->getId(), 'state' => $comment->getState()]);
        }
    }
}
