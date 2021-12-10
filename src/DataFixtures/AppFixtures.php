<?php

namespace App\DataFixtures;

use App\Entity\User;
use App\Entity\Utilisateur;
use App\Entity\Video;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;

class AppFixtures extends Fixture
{
    public function __construct(private UserPasswordHasherInterface $passwordHasher)
    {
        
    }

    public function load(ObjectManager $manager): void
    {
        /**
         * Un user pour l'authentification JWT
         */
        $user = new User();
        $user->setUsername('Jojau');
        $user->setPassword($this->passwordHasher->hashPassword($user, "jojo1234"));
        $manager->persist($user);

        /**
         * Les vidéos
         */
        $video1 = new Video;
        $video1->setId('WROlGNthbNE');
        $video1->setTitle("EasyVista IT Service Management for the Mobile User (Française)");
        $manager->persist($video1);

        $video2 = new Video;
        $video2->setId('i9MHigUZKEM');
        $video2->setTitle("AngularJS Fundamentals In 60ish Minutes");
        $manager->persist($video2);

        $video3 = new Video;
        $video3->setId('-s9cjIADE90');
        $video3->setTitle("EasyVista IT Heroes S01/E01 FR (#itheroessaga)");
        $manager->persist($video3);

        $video4 = new Video;
        $video4->setId('Ke90Tje7VS0');
        $video4->setTitle("Learn React - React Crash Course 2018 - React Tutorial with Examples | Mosh");
        $manager->persist($video4);

        $video5 = new Video;
        $video5->setId('8ILQOFAgaXE');
        $video5->setTitle("Introduction to Angular JS");
        $manager->persist($video5);

        $utilisateur1 = new Utilisateur;
        $utilisateur1->setName('john');
        $utilisateur1->addVideo($video1);
        $utilisateur1->addVideo($video2);
        $utilisateur1->addVideo($video3);
        $manager->persist($utilisateur1);

        $utilisateur2 = new Utilisateur;
        $utilisateur2->setName('mark');
        $utilisateur2->addVideo($video4);
        $utilisateur2->addVideo($video5);
        $manager->persist($utilisateur2);

        $manager->flush();
    }
}
