<?php

namespace App\DataFixtures;

use App\Entity\Category;
use App\Entity\Nft;
use App\Entity\User;
use DateTime;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;

class AppFixtures extends Fixture
{
    public function __construct(private UserPasswordHasherInterface $hash)
    {
        
    }
    const CATEGORY = 4;
    const NFT = 30;

    public function load(ObjectManager $manager): void
    {

        $users = [];
        
        $faker = \Faker\Factory::create("fr_FR");
        $userAdmin = new User();
        $userAdmin->setEmail("dimitri-bonnet@hotmail.fr");
        $userAdmin->setName("dimitri");
        $userAdmin->setRoles(["ROLE_ADMIN"]);
        $userAdmin->setPassword($this->hash->hashPassword($userAdmin, "test"));
        $userAdmin->setIsVerified(true);

        $users[]=$userAdmin;
        

        $manager->persist($userAdmin);

        $userRegular = new User();
        $userRegular->setEmail("dim.one.sfk@gmail.com");
        $userRegular->setName("dim");
        $userRegular->setRoles(["ROLE_USER"]);
        $userRegular->setPassword($this->hash->hashPassword($userRegular, "test"));
        $userRegular->setIsVerified(false);

        $users[]=$userRegular;

        $manager->persist($userRegular);

        

        for ($i=0; $i < self::CATEGORY; $i++) { 
            $category = new Category();
            $category->setName("category ".$i);
            $category->setDescription($faker->text());

            $categories[]=$category;

            $manager->persist($category);
        }

        for ($i=0; $i < self::NFT; $i++) { 
            $nft = new Nft();
            $nft->setImageUrl($faker->imageUrl(200, 200));
            $nft->setName($faker->firstName());
            $nft->setPrice($faker->numberBetween(0, 1000000));
            $nft->setDateDrop(new DateTime($faker->date('d-m-Y')));
            $nft->setUser($faker->randomElement($users));
            $nft->addCategory($faker->randomElement($categories));

            $manager->persist($nft);

        }

        $manager->flush();


    }
}
