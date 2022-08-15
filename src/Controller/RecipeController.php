<?php

namespace App\Controller;

use App\Entity\Recipe;
use App\Form\RecipeType;
use App\Repository\RecipeRepository;
use Doctrine\ORM\EntityManagerInterface;
use Knp\Component\Pager\PaginatorInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use App\Entity\Engredient;

class RecipeController extends AbstractController
{
    #[Route('/recipe', 'recipe.index',methods:['GET'])]
    public function index(RecipeRepository $repository,PaginatorInterface $paginator,Request $request): Response
    {   $requete=$repository->findAll();
        $all=$paginator->paginate(
            $requete,
            $request->query->getInt('page',1),10
        );
        return $this->render('recipe/index.html.twig', [
           'all'=>$all,
        ]);
    }
    #[Route('/recipe/create','recipe.create',methods:['GET','POST'])]
    public function create(EntityManagerInterface $manager,Request $request){
        $recipe=new Recipe();
        $form=$this->createForm(RecipeType::class,$recipe);
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) { 
            $recipe=$form->getData();
            $manager->persist($recipe);
            $manager->flush();
            return $this->redirectToRoute('recipe.index');
            
        }

        return $this->render('recipe/create.html.twig',[
            'form'=>$form->createView()
                ]);
    }
    
    #[Route('/recipe/edit/{id}','recipe.edit',methods:['GET','POST'])]
    public function edit(Recipe $recipe,Request $request,EntityManagerInterface $manager){
        $form=$this->createForm(RecipeType::class,$recipe);
        $form->handleRequest($request);
        if(  $form->isSubmitted() && $form->isValid()){
            $task=$form->getData();
            $manager->persist($task);
            $manager->flush();
            return $this->redirectToRoute('recipe.index');

        }
        return $this->render('recipe/edit.html.twig',[
            'form'=>$form->createView()
        ]);
    }
    #[Route('/recipe/delete/{id}','recipe.delete',methods:['GET','POST'])]
    public function delete(Recipe $recipe, EntityManagerInterface $manager , Request $request):Response{
        $manager->remove($recipe);
        $manager->flush();
        return $this->redirectToRoute('recipe.index');
        $this->addFlash(
            'deleted',
            'Delete successfully'
        );
        return $this->render('recipe/delete.html.twig',[]);
    }
 
}
