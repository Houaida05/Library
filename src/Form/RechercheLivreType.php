<?php

namespace App\Form;

use App\Entity\Categorie;
use App\Entity\Livre;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\NumberType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class RechercheLivreType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
          ->add('categorie', EntityType::class , [
              "class" => Categorie::class,
              'required' => false,
              "choice_label" => 'designation',
              //'expanded'=> true,
              'attr' => ['class' => 'form-control']
          ])

            ->add('titre', TextType::class , [
                'label' => false,
                'required' => false,
                'attr' => ['class' => 'form-control',
                'placeholder' => 'Enter some keywords'
                ]])
           ->add ('prix', NumberType::class, [
                'label' => false,
                'required'=> false,
                'attr' => ['placeholder' => ' Enter the price here']
            ])

            ->add("search" , SubmitType::class , [
                'attr' =>  ['class' => 'btn btn-primary']
        ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Livre::class,
        ]);
    }
}
