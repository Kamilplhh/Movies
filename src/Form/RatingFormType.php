<?php

namespace App\Form;

use App\Entity\Rating;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class RatingFormType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
        ->add('Rating', ChoiceType::class, [
            'choices' => [
                '⭐' => 1,
                '⭐⭐' => 2,
                '⭐⭐⭐' => 3,
                '⭐⭐⭐⭐' => 4,
                '⭐⭐⭐⭐⭐' => 5
            ],
            'label' => false,
            'mapped' => false
        ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Rating::class,
        ]);
    }
}
