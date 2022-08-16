<?php

namespace App\Controller;

use App\Entity\User;
use App\Form\RegistrationType;
use App\Form\UserType;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Security\Http\Authentication\AuthenticationUtils;

class SecurityController extends AbstractController
{
    #[Route('/connection', 'security.login',methods:['GET','POST'])]
    public function index(AuthenticationUtils $authenticationUtils): Response
    {
        $lastUsername=$authenticationUtils->getLastUsername();
        $error=$authenticationUtils->getLastAuthenticationError();
        return $this->render('security/index.html.twig', [
            'lastuser' => $lastUsername,
            'error'=>$error
        ]);
    }
    #[Route('/deconnection','security.logout',methods:['GET','POST'])]
    public function logout(){

    }
    #[Route('/user/create','user.create',methods:['POST','GET'])]
    public function create(Request $request,EntityManagerInterface $manager):Response{
        $user=new User();
        $user->setRoles(['ROLES USER']);
        $form=$this->createForm(RegistrationType::class,$user);
        $form->handleRequest($request);
        if($form->isSubmitted() && $form->isValid()){
            $add=$form->getData();
            $manager->persist($add);
            $manager->flush();
            $this->addFlash(
                'success',
                'ajout successfully'
            );
            return $this->redirectToRoute('security.login');
        }
        return $this->render('security/create.html.twig',[
            'form' => $form->createView(),
        ]);
    }
}
