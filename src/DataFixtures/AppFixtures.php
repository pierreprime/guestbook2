<?php

namespace App\DataFixtures;

use App\Entity\Admin;
use App\Entity\Comment;
use App\Entity\Conference;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;
use Symfony\Component\Security\Core\Encoder\EncoderFactoryInterface;

class AppFixtures extends Fixture
{
    // we need this to re-create admin user at run
    private $encoderFactory;

    public function __construct(EncoderFactoryInterface $encoderFactory)
    {
        $this->encoderFactory = $encoderFactory;
    }

    public function load(ObjectManager $manager)
    {
        $sydney = new Conference();
        $sydney->setCity('Sydney');
        $sydney->setYear('2000');
        $sydney->setIsInternational(true);
        $manager->persist($sydney);

        $athens = new Conference();
        $athens->setCity('Athens');
        $athens->setYear('2004');
        $athens->setIsInternational(true);
        $manager->persist($athens);

        $comment1 = new Comment();
        $comment1->setConference($sydney);
        $comment1->setAuthor('Myself');
        $comment1->setEmail('myself@server.org');
        $comment1->setText('This was a great game');
        $comment1->setState('published');
        $manager->persist($comment1);

        $comment2 = new Comment();
        $comment2->setConference($athens);
        $comment2->setAuthor('Him');
        $comment2->setEmail('him@server.org');
        $comment2->setText('blabla');
        $manager->persist($comment2);

        $admin = new Admin();
        $admin->setRoles(['ROLE_ADMIN']);
        $admin->setUsername('admin');
        $admin->setPassword($this->encoderFactory->getEncoder(Admin::class)->encodePassword('admin', null));
        $manager->persist($admin);

        $manager->flush();
    }
}
