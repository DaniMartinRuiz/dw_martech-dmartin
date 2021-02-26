<?php

namespace App\DataFixtures;

use Faker;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use App\Entity\Members;
use App\Entity\Productos;

class AppFixtures extends Fixture
{
    public function load(ObjectManager $manager)
    {
        for ($i = 0; $i < 6; $i++){
            $productFaker = Faker\Factory::create();
            
            //Members
            $members = new Members();
            $members -> setUser("martech_$i");
            $members -> setPass("4Vientos");
            
            $manager -> persist($members);
            
            //Products
            $product = new Productos();
            $product -> setName($productFaker->name);
            $product -> setDescription($productFaker->sentence);
            $product ->setUrlPicture($productFaker->imageUrl($width=400, $height=200));
            $product ->setPrice($productFaker->numberBetween(120,685));
            
            $product ->setMembers($members);
            
            $manager->persist($product);
        }

        $manager->flush();
    }
}
