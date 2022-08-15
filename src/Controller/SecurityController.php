<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
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
}
