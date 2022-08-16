<?php

namespace App\Controller;


use App\Entity\User;
use App\Form\UserType;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;

class UserController extends AbstractController
{
    #[Route('/user/edit/{id}', name: 'user.edit',methods: ['GET','POST'])]
    public function index(User $user,Request $request,EntityManagerInterface $manager , UserPasswordHasherInterface $passwordHasher): Response
    {   
        $form=$this->createForm(UserType::class,$user);
        if(!$this->getUser()){
            return $this->redirectToRoute('security.login');
        }if($this->getUser() !== $user){
            return $this->redirectToRoute('recipe.index');
        }
        $form->handleRequest($request);
        if($form->isSubmitted() && $form->isValid()) {
            if($passwordHasher->isPasswordValid($user,$form->getData()->getPlainPassword())){
                $add=$form->getData();
                $manager->persist($add);
                $manager->flush();
                $this->addFlash(
                    'modified',
                    'Votre compte a été modifier avec successfully'
                );
                return $this->redirectToRoute('recipe.index');

            }else{
                $this->addFlash(
                    'warning',
                    'votre mot de passe est incorrect'
                );
            }
           
        }
        return $this->render('user/index.html.twig', [
            'form' => $form->createView()
        ]);

    }
}
