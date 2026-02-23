<?php

namespace App\Form;

use App\Entity\Abonnement;
use App\Entity\User;
use App\Entity\TypeAbonn;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use VictorPrdh\RecaptchaBundle\Form\ReCaptchaType;

class AbonnementType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            //->add('dateabonnement', DateType::class, [
              //  'years' => range(2023,2024),
                //'format' => 'dd-MM-yyyy',

           // ])
            /*->add('typeabon', EntityType::class, [
                'class' => 'App\Entity\TypeAbonn', 
                'choice_label' => 'type', 
                'placeholder' => 'Select Type Abonnement',
                'required' => true, 

            ])*/
            //->add('VerificationCode')
            ->add('iduser', EntityType::class, [
                'class' => 'App\Entity\User', 
                'choice_label' => 'nom', 
                'placeholder' => 'Select your name', // Optional
                'required' => true, 

            ])
            //->add("captcha", ReCaptchaType::class)
           // ->add('save',SubmitType::class)
            
            
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Abonnement::class,
        ]);
    }
}
