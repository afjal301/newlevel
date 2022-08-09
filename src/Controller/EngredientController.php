<?php

namespace App\Controller;

use App\Entity\Engredient;
use App\Repository\EngredientRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class EngredientController extends AbstractController
{
    #[Route('/engredient', name: 'app_engredient')]
    public function index(Engredient $engredient, EngredientRepository $repository,EntityManagerInterface $manager,Request $request): Response
    {
        $all=$repository->findAll();
        return $this->render('engredient/index.html.twig', [
            'all' => $all,
        ]);
    }
}
