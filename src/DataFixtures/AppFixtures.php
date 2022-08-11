<?php

namespace App\DataFixtures;

use App\Entity\Engredient;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use faker\Generator;

class AppFixtures extends Fixture
{
    private $faker
    public function load(ObjectManager $manager): void
    {
        // $product = new Product();
        $engredient= new Engredient();
        $engredient->setName('hello')
                    ->setPrice(4000);
                    
        
        $manager->persist($engredient);

        $manager->flush();
    }
}
