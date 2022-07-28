<?php

namespace App\DataFixtures;

use App\Entity\Categorie;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Faker\Factory;

class AppFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {
        $faker=Factory::create();
        for($i=1;$i<=10;$i++){
            $categorie=new Categorie();
            $categorie->setDescription(($faker->realText(200)));
            $categorie->setDescription(($faker->realText(200)));


        }
        // $product = new Product();
        // $manager->persist($product);

        $manager->flush();
    }
}
