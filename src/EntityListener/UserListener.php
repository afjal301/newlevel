<?php
namespace App\EntityListener;

use App\Entity\User;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;

class UserListener{
    private UserPasswordHasherInterface $hashers;
    public function __construct(UserPasswordHasherInterface $hashers)
    {
        $this->hashers=$hashers;
    }
     public function prePersist(User $user){
        $this->encodePassword($user);
     }
     public function preUpdate(User $user){
        $this->encodePassword($user);
     }
     public function encodePassword(User $user){
        if($user->getPlainPassword()=== null){
            return ;
        }
        $user->setPassword(
            $this->hashers->hashPassword(
                $user,
                $user->getPlainPassword()
            )
            );

     }
}

?>