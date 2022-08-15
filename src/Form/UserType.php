<?php

namespace App\Form;

use App\Entity\User;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

use Symfony\Component\Validator\Constraints as Assert;
use Webmozart\Assert\Assert as AssertAssert;

class UserType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('email',EmailType::class,[
                'attr'=>[
                    'class'=>'form-control'
                ],
                'label'=>'Email valide ',
                'label_attr'=>['class'=>'form-control'],
                'constraints'=>[
                    new Assert\NotBlank(),
                    
                ]
            ])
            ->add('roles',TextType::class)
            ->add('password',PasswordType::class,[
                'attr'=>[
                    'class'=>'form-control'
                ],
                'label'=>'Email valide ',
                'label_attr'=>['class'=>'form-control'],
                'constraints'=>[
                    new Assert\NotBlank(),
                    new Assert\Email()
                    
                ]
            ])
            ->add('fullname',TextType::class,[
                'attr'=>[
                    'class'=>'form-control'
                ],
                'label'=>'Email valide ',
                'label_attr'=>['class'=>'form-control'],
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
                'label'=>'Email valide ',
                'label_attr'=>['class'=>'form-control'],
                'constraints'=>[
                    new Assert\NotBlank(),
                    new Assert\Length([
                        'min'=>2,'max'=>50
                    ])
                    
                ]
            ])
            ->add('createdAt',DateType::class)
            ->add('submit',SubmitType::class)
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => User::class,
        ]);
    }
}
