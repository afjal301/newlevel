<?php

namespace App\Form;

use App\Entity\User;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Validator\Constraints as Assert;

class RegistrationType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
        ->add('email',EmailType::class,[
            'attr'=>[
                'class'=>'form-control'
            ],
            'label'=>'Email valide ',
            'constraints'=>[
                new Assert\NotBlank(),
                
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
