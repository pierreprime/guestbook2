<?php


namespace App\Tests\Controller;

use App\Repository\CommentRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class ConferenceControllerTest extends WebTestCase
{
    public function testIndex()
    {
        $client = static::createClient();
        $client->request('GET', '/conferences');

//        echo $client->getResponse();

        $this->assertResponseIsSuccessful();
        $this->assertSelectorTextContains('h2', 'Give your feedback');
    }

    public function testCommentSubmission()
    {
        $client = static::createClient();
        $client->request('GET', 'conference/athens-2004');
        $client->submitForm('Submit', [
            'comment_form[author]' => 'Myself',
            'comment_form[text]' => 'This conference was antique',
            'comment_form[email]' => $email = 'me@automat.ed',
            'comment_form[photo]' => dirname(__DIR__, 2).'/public/images/wip.gif',
        ]);
        $this->assertResponseRedirects();

        // simulate comment validation OK
        $comment = self::$container->get(CommentRepository::class)->findOneByEmail($email);
        $comment->setState('published');
        self::$container->get(EntityManagerInterface::class)->flush();

        $client->followRedirect();
        $this->assertSelectorExists('div:contains("There are 1 comments")');
    }

    public function testConferencePage()
    {
        $client = static::createClient();
        $crawler = $client->request('GET', '/conferences');

        $this->assertCount(2, $crawler->filter('h4'));
        $client->clickLink('View');

        $this->assertPageTitleContains('Sydney');
        $this->assertResponseIsSuccessful();
        $this->assertSelectorTextContains('h2', 'Sydney 2000');
        $this->assertSelectorExists('div:contains("There are 1 comments")');
    }
}