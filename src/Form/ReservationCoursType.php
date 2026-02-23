<?php

namespace App\Form;

use App\Entity\ReservationCours;
use Symfony\Bridge\Doctrine\Form\Type\EntityType; // Add this import
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class ReservationCoursType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder

            ->add('code', EntityType::class, [
                'class' => \App\Entity\Activites::class, // Update with the correct namespace for Activites entity
                'choice_label' => 'titre', // Update to the property you want to display
            ])
            ->add('idUser', EntityType::class, [
                'class' => \App\Entity\User::class, // Update with the correct namespace for User entity
                'choice_label' => 'nom', // Update to the property you want to display
            ]);
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => ReservationCours::class,
        ]);
    }
}
