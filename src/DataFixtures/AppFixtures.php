<?php

namespace App\DataFixtures;

use App\Entity\User;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;

class AppFixtures extends Fixture
{
    public function __construct(private UserPasswordHasherInterface $hash)
    {
        
    }

    public function load(ObjectManager $manager): void
    {
        $faker = \Faker\Factory::create("fr_FR");
        $userAdmin = new User();
        $userAdmin->setEmail("dimitri-bonnet@hotmail.fr");
        $userAdmin->setName("dimitri");
        $userAdmin->setRoles(["ROLE_ADMIN"]);
        $userAdmin->setPassword($this->hash->hashPassword($userAdmin, "test"));

        $manager->persist($userAdmin);

        $userRegular = new User();
        $userRegular->setEmail("dim.one.sfk@gmail.com");
        $userRegular->setName("dim");
        $userRegular->setRoles(["ROLE_USER"]);
        $userRegular->setPassword($this->hash->hashPassword($userRegular, "test"));

        $manager->persist($userRegular);

        $manager->flush();


    }
}
