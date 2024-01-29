<?php

namespace App\Form;

use App\Entity\User;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class RegisterType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('fullName', TextType::class, [
                'attr'=> [
                    'placeholder'=>'Nom complet',
                    'tabindex'=>1,
                ],
            ])
            ->add('matricule', TextType::class, [
                'attr'=> [
                    'placeholder'=>'Votre matricule',
                    'tabindex'=>1,
                ],
            ])
            ->add('password', PasswordType::class, [
                'attr'=> [
                    'placeholder'=>'Mot de passe',
                    'tabindex'=>2,
                ],
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => User::class,
        ]);
    }
}
