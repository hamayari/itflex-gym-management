<?php

namespace App\Form;

use App\Entity\ReservationOffer;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use App\Entity\Offer;
use App\Entity\User;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use VictorPrdh\RecaptchaBundle\Form\ReCaptchaType;

class ReservationOfferType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            //->add('datereservation')
            ->add('codepromo')
            /*->add('idoffer', EntityType::class, [
                'class' => 'App\Entity\Offer', 
                'choice_label' => 'titleoffer', 
                'placeholder' => 'Select your offer prefere', // Optional
                'required' => true, 

            ])*/
            ->add('iduser', EntityType::class, [
                'class' => 'App\Entity\User', 
                'choice_label' => 'nom', 
                'placeholder' => 'Select your name', // Optional
                'required' => true, 

            ])
            ->add('captcha', ReCaptchaType::class)
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => ReservationOffer::class,
        ]);
    }
}
