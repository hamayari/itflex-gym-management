<?php

namespace App\Form;

use App\Entity\Participation;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;

class ParticipationType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('nom')
            ->add('prenom')
            ->add('ntel')
           # ->add('datepart')
            ->add('idUser', EntityType::class, [ 
                'class' => 'App\Entity\User',
                'choice_label' => 'email',
            ])
            ->add('idEvent', EntityType::class, [ 
                'class' => 'App\Entity\Events',
                'choice_label' => 'titreevent',
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Participation::class,
        ]);
    }
}
