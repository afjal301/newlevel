<?php
namespace App\Controller;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class Home extends AbstractController
{
    /**
     * @Route("/path")
     */
    #[Route('/home','home.index',methods:['GET'])]
    public function index(): Response
    {
       return $this->render('index.html.twig',[
         
       ]);
    }
}

?>