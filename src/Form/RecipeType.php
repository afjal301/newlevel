<?php

namespace App\Form;

use App\Entity\Recipe;
use App\Entity\Engredient;
use App\Repository\EngredientRepository;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\TimeType;
use Symfony\Component\Form\Extension\Core\Type\MoneyType;
use Symfony\Component\Form\Extension\Core\Type\RangeType;
use Symfony\Component\Form\Extension\Core\Type\NumberType;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;
use Symfony\Component\Form\Extension\Core\Type\CheckboxType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Config\Doctrine\Orm\EntityManagerConfig\EntityListeners\EntityConfig;

class RecipeType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('name',TextType::class,[
                'attr'=>[
                    'class'=>'form-control',
                     ] 
                 ])
            ->add('time',TimeType::class,
            [
                'attr'=>[
                    'class'=>'form-control',
                     ] 
                 ]
            )
            ->add('nbpeople',IntegerType::class,
            [
                'attr'=>[
                    'class'=>'form-control',
                     ] 
                 ])
            ->add('difficulty',RangeType::class,
            [
                'attr'=>[
                    'class'=>'form-control',
                     ] 
                 ]
            )
            ->add('description',TextType::class,
            [
                'attr'=>[
                    'class'=>'form-control',
                     ] 
                 ])
            ->add('price',MoneyType::class,
            [
                'attr'=>[
                    'class'=>'form-control',
                     ] 
                 ])
            ->add('isFavorite',CheckboxType::class)
            ->add('engredient',EntityType::class,[
                'class'=>Engredient::class,
                'query_builder' => function (EngredientRepository $er) {
                    return $er->createQueryBuilder('i')
                        ->orderBy('i.name', 'ASC');
                },
                'choice_label'=>'Name',
                'multiple'=>true,
                'expanded'=>true,
            ])
            ->add('submit',SubmitType::class,[
                'attr'=>[
                    'class'=>'form-control btn btn-primary',

                     ] 
                 ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Recipe::class,
        ]);
    }
}
