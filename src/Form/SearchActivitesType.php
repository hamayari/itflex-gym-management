<?php

// src/Form/SearchActivitesType.php

namespace App\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\DateTimeType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class SearchActivitesType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('categorie', TextType::class, [
                'required' => false,
            ])
            ->add('dateDeb', DateTimeType::class, [
                'widget' => 'single_text',
                'required' => false,
            ])
            ->add('dateFin', DateTimeType::class, [
                'widget' => 'single_text',
                'required' => false,
            ])
            // Add other fields as needed
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            // Set the data_class to null to allow using an array to represent the form data
            'data_class' => null,
        ]);
    }
}
