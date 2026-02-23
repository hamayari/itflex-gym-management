<?php

namespace App\Form;

use App\Entity\TypeAbonn;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\TextType;

class TypeAbonnementSearchType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
             ->add('search', TextType::class, [
            'label' => 'Search Type Abonnement',
            'required' => false,
            'attr' => ['placeholder' => 'type'],
        ]);        ;
    }

    /*public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => TypeAbonn::class,
        ]);
    }*/
}
