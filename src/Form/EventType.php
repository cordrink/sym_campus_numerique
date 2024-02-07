<?php

namespace App\Form;

use App\Entity\Category;
use App\Entity\Event;
use App\Entity\User;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\DateIntervalType;
use Symfony\Component\Form\Extension\Core\Type\DateTimeType;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class EventType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('title', TextType::class, [
                'label' => 'Entrez le titre',
                'attr' => [
                    'placeholder' => 'Entrez le titre',
                    'class'=>'titleInp'
                ],
                'label_attr'=>[
                    'class'=>'lableTitle'
                ]

            ])
            ->add('startAt', DateTimeType::class, [
                'label' => 'Date de debut',
                'required'=>true,
                'attr'=>[
                    'placeholder' => 'Date de debut',
                    'class'=>'flexInp'
                ],
                'row_attr' => [
                    'class' => 'flexLefInp'
                ],
                'label_attr'=>[
                    'class'=>'labelflex'
                ]
            ])
            ->add('endAt', DateTimeType::class, [
                'label' => 'Date de fin',
                'required'=>true,
                'attr'=>[
                    'placeholder' => 'Date de fin',
                    'class'=>'flexInp'
                ],
                'row_attr' => [
                    'class' => 'flexRightInp'
                ],
                'label_attr'=>[
                    'class'=>'lableTitle'
                ]
            ])
            ->add('illustration', FileType::class, [
                'label' => false,
                'required' => true,
            ])
            ->add('CatEvent', EntityType::class, [
                'label' => 'Sélectionne la categorie',
                'class' => Category::class,
                'choice_label' => 'name',
                'multiple' => true,
                'attr' => [
                    'class' => 'choice_categories',
                ],
                'label_attr'=>[
                    'class'=>'labelSelect'
                ],
                'row_attr' => [
                    'class' => 'choice'
                ],
            ])
            ->add('description', TextareaType::class, [
                'label' => 'Contenu de l\'evenement',
                'required' => true,
                'attr' => [
                    'placeholder' => 'Contenu de l\'evenement ...',
                    'rows'=> 10,
                    'cols'=> 50
                ],
                'label_attr'=>[
                    'class'=>'labelTxt',
                ]
            ]);

    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Event::class,
        ]);
    }
}
