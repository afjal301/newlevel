<?php

namespace App\DataFixtures;

use App\Entity\Engredient;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class AppFixtures extends Fixture
{
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
