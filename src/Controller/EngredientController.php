<?php

namespace App\Controller;

use App\Entity\Engredient;
use App\Repository\EngredientRepository;
use Doctrine\ORM\EntityManagerInterface;
use Knp\Component\Pager\PaginatorInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class EngredientController extends AbstractController
{
    #[Route('/engredient','engredient.home')]
    public function index(EngredientRepository $repository,PaginatorInterface $paginator ,Request $request ): Response
    {
        $find=$repository->findAll();
        $all=$paginator->paginate(
            $find,
            $request->query->getInt('page',1),5
        );
        return $this->render('engredient/index.html.twig',[
            'all'=>$all,
        ]);
    }
    #[Route('/engredient/delete/{id}','engredient.delete',methods:['GET','POST'])]
    public function delete(Engredient $engredient,EntityManagerInterface $manager):Response {
        if(!$engredient){
            $this->$this->addFlash(
               'success',
               'Il n \' y a pas de'
            );
            return $this->redirectToRoute('engredient.home');
        }
        $manager->remove($engredient);
        $manager->flush();
        return $this->redirectToRoute('engredient.home');
        return $this->render('engredient/index.html.twig',[]);

    }
}
