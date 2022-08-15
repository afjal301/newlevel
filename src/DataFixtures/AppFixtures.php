<?php

namespace App\DataFixtures;

use Faker\Factory;
use App\Entity\User;
use faker\Generator;
use App\Entity\Recipe;
use App\Entity\Engredient;
use Doctrine\Persistence\ObjectManager;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasher;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;

class AppFixtures extends Fixture
{
    private Generator $faker;
    private UserPasswordHasherInterface $hashers;
    public function __construct(  UserPasswordHasherInterface $hashers)
    {
        $this->faker=Factory::create('fr_FR');
        $this->hashers=$hashers;
    }
    public function load(ObjectManager $manager): void
    {
        // $product = new Product();
        for ($i=0; $i <15 ; $i++){ 
            # code...
            $engredient= new Engredient();
            $engredient->setName($this->faker->word())
                        ->setPrice(mt_rand(50,5000));
            $engredients[]=$engredient;
            $manager->persist($engredient);
        }
        for ($i=0; $i <15 ; $i++) { 
            # code...
            $recipe=new Recipe();
            $recipe->setName($this->faker->word())
                    ->setPrice(mt_rand(50,5000))
                    ->setNbpeople(mt_rand(1,5))
                    ->setDifficulty(mt_rand(0,5))
                    ->setDescription($this->faker->text(300))
                    ->setIsFavorite(mt_rand(0,1)==1?true:false)
                    ->setTime(new \DateTime('H'));
            for ($i=0; $i <mt_rand(1,15) ; $i++) { 
                # code...
                $recipe->addEngredient($engredients[(mt_rand(0,14))]);
            }  
            $manager->persist($recipe);   
        }
        for ($i=0; $i <5 ; $i++) { 
            $user=new User();
            $user->setFullname($this->faker->name())
                 ->setPseudo($this->faker->name())
                 ->setEmail($this->faker->email())
                 ->setRoles(['ROLES USER'])
        /*$password=$this->hashers->hashPassword(
            $user,
            'password'
        );*/
                  ->setPlainPassword('password');
            $manager->persist($user);
            
            # code...
        }
        $manager->flush();
    }
}
