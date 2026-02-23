<?php

namespace App\Form;

use App\Entity\User;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Form\Extension\Core\Type\EmailType; // Use Symfony's built-in EmailType
use Symfony\Component\Form\Extension\Core\Type\ChoiceType; // Use Symfony's built-in EmailType
use Symfony\Component\Form\Extension\Core\Type\FileType; // Use Symfony's built-in EmailType
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Validator\Constraints\File;
use Symfony\Component\Validator\Constraints\Image;



class UserType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('nom')
            ->add('prenom')
            ->add('mdp')
            ->add('role',ChoiceType::class, [
                'label' => 'Role',
                'choices' => [
                    'Admin' => 'Admin',
                    'Utilisateur' => 'Utilisateur',
                    'Coach' => 'Coach',
                    // Add more options as needed
                ],
                'placeholder' => 'Select Role',
                'data' => 'Utilisateur', // Set the default value here // Optional
            ])
            ->add('email', EmailType::class, [
                'label' => 'Email',
            ])
            ->add('img', FileType::class, [
                'label' => 'Choose Image',
                'mapped' => false, 
                'constraints' => [
                    new File([
                        'maxSize' => '1024k',
                        'mimeTypes' => ['image/*'],
                        'mimeTypesMessage' => 'Please upload a valid image file.',
                    ]),
                    new Image([
                        'maxSize' => '1024k',
                    ]),
                ],
            ])
            ->add('age')
            ->add('numtel')
            ->add('sex', ChoiceType::class, [
                'label' => 'Sex',
                'choices' => [
                    'Homme' => 'Homme',
                    'Femme' => 'Femme',
                ],
                'expanded' => true, // Render as radio buttons
                'multiple' => false, // Allow only one option to be selected
            ])
            

        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => User::class,
        ]);
    }

}


