<?php

namespace App\DataFixtures;

use Faker\Factory;
use faker\Generator;
use App\Entity\Engredient;
use Doctrine\Persistence\ObjectManager;
use Doctrine\Bundle\FixturesBundle\Fixture;

class AppFixtures extends Fixture
{
    private Generator $faker;
    public function __construct()
    {
        $this->faker=Factory::create('fr_FR');
    }
    public function load(ObjectManager $manager): void
    {
        // $product = new Product();
        for ($i=050; $i <50 ; $i++){ 
            # code...
            $engredient= new Engredient();
            $engredient->setName($this->faker->word())
                        ->setPrice(mt_rand(50,5000));
            $manager->persist($engredient);
        }
    
                    
        
       

        $manager->flush();
    }
}
