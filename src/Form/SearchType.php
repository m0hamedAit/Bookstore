<?php

namespace App\Form;

use App\Entity\PropertySearch;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\DateType;

class SearchType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('dateFrom', DateType::class,[
                'required' => true,
                'label' => "From",
                'widget'=>'single_text',
                'attr'=>[
                    'class' => 'js-datepicker'
                ]
            ])

            ->add('dateTo', DateType::class,[
                'required' => true,
                'label' => "To",
                'widget'=>'single_text',
                'attr'=>[
                'class' => 'js-datepicker'
                ]
                
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => PropertySearch::class,
            'method' => 'get',
            'csrf_protection' => false,
        ]);
    }

    public function getBlockPrefix(){
        return '';
    }
}
