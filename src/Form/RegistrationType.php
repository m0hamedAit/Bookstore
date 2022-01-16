<?php

namespace App\Form;

use App\Entity\User;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class RegistrationType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('email',null, array('label' => false, 'attr' => ['placeholder' => "Email", 'class' => 'form-control form-control-lg']))
            ->add('password', PasswordType::class, array('label' => false, 'attr' => ['placeholder' => "Password", 'class' => 'form-control form-control-lg']))
            ->add('confirm_password',PasswordType::class , array('label' => false, 'attr' => ['placeholder' => "Confirm Password", 'class' => 'form-control form-control-lg']))
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => User::class,
        ]);
    }
}
