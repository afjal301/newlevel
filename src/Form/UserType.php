<?php

namespace App\Form;

use App\Entity\User;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\DateTimeType;
use Webmozart\Assert\Assert as AssertAssert;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Validator\Constraints as Assert;
use Symfony\Component\Form\Extension\Core\Type\DateType;

use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;
use Symfony\Component\Form\Extension\Core\Type\RepeatedType;

class UserType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            
            ->add('fullname',TextType::class,[
                'attr'=>[
                    'class'=>'form-control'
                ],
                'label'=>'Nom valide ',
                
                'constraints'=>[
                    new Assert\NotBlank(),
                    new Assert\Length([
                        'min'=>2,'max'=>50
                    ])
                    
                ]
            ]
            )
            ->add('pseudo',TextType::class,[
                'attr'=>[
                    'class'=>'form-control'
                ],
                'label'=>'Pseudo valide ',
                
                'constraints'=>[
                    new Assert\NotBlank(),
                    new Assert\Length([
                        'min'=>2,'max'=>50
                    ])
                    
                ]
            ])
            ->add('plainPassword',RepeatedType::class,[
                'type'=>PasswordType::class,
                'first_options'=>[
                    'attr'=>[
                        'class'=>'form-control'
                    ],
                    'label'=>'entrer une mot de passe'
    
                ],
                'second_options'=>[
                    'label'=>'confirmer le mot de passe ',
                    'attr'=>[
                        'class'=>'form-control'
                    ],
                ],
                'invalid_message'=>'les deux mot de passe ne correspond pas '
            ]
            )
           
            ->add('submit',SubmitType::class,['attr'=>[
                'class'=>'btn btn-primary form-control'
            ]])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => User::class,
        ]);
    }
}
