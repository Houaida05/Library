<?php

namespace App\Form;

use App\Entity\User;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class ProfileType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('email',TextType::class , [
                'attr' => ['class' => 'form-control'
                ]])
          //  ->add('password')
            //->add('isVerified')
          ->add('firstname',TextType::class , [
              'attr' => ['class' => 'form-control'

              ]])
            ->add('name',TextType::class , [
                'attr' => ['class' => 'form-control'
            ]])
            ->add('adresse',TextType::class , [
                'attr' => ['class' => 'form-control'
                ]])
           ->add('country',TextType::class , [
               'attr' => ['class' => 'form-control'
               ]])
            ->add('tel',TextType::class , [
                'attr' => ['class' => 'form-control'
                ]])
            ->add('Update', SubmitType::class , [
                'attr' =>  ['class' => 'btn btn-primary']])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => User::class,
        ]);
    }
}
