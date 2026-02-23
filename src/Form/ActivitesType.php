<?php

namespace App\Form;

use App\Entity\Activites;
use App\Entity\User;
use Doctrine\ORM\EntityRepository;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\DateTimeType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Validator\Constraints as Assert;

class ActivitesType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder

            ->add('dateDeb', DateTimeType::class, [
                'date_widget' => 'single_text',
                'constraints' => [
                    new Assert\NotBlank(['message' => 'dateDeb cannot be blank.']),
                ],
            ])
            ->add('dateFin',DateTimeType::class, [
                'date_widget' => 'single_text'
            ])
            ->add('description',null,[
                'constraints' => [
                    new Assert\NotBlank(['message' => 'description cannot be blank.']),

                ],])
            ->add('salle',ChoiceType::class,[
                'choices' => [
                    'Salle des cours' => 'Salle des cours',
                    'Salle Cross training' => 'Salle cross training',
                    'Salle RPM'=>'Salle RPM',
                    'Salle Zen'=>'Salle Zen',
                    'Salle BOX'=>'Salle BOX',
                    'Piscine'=>'Piscine'
                ]
                ,'constraints' => [
                    new Assert\NotBlank(['message' => 'salle cannot be blank.']),

                ],])
            ->add('titre', ChoiceType::class, [
                'choices' => [
                    'KB Workout' => 'KB Workout',
                    'BODYATTACK' => 'BODYATTACK',
                    'BODYBALANCE' => 'BODYBALANCE',
                    'CROSS FORCE' => 'CROSS FORCE',
                    'BODYCOMBAT' => 'BODYCOMBAT',
                    'BODYSTEP' => 'BODYSTEP',
                    'GRIT' => 'GRIT',
                    'RPM' => 'RPM',
                    'SH`BAM' => 'SH`BAM',
                    'ABDOS FESSIERS' => 'ABDOS FESSIERS',
                    'BOXING' => 'BOXING',
                    'TRX' => 'TRX',
                    'YOGA' => 'YOGA',
                    'AQUABODYBIKE'=>'AQUABODYBIKE',
                    'AQUADYNAMIC'=>'AQUADYNAMIC',
                    'ABDO 30`'=>'ABDO 30`',
                    'BODYPUMP'=>'BODYPUMP',
                ],
                'constraints' => [
                    new Assert\NotBlank(['message' => 'titre cannot be blank.']),

                    // Add other constraints as needed
                ],
            ])
            ->add('idcategorie')
            ->add('idUser', EntityType::class, [
                'class' => User::class,
                'choice_label' => function (User $user) {
                    return $user->getNom() . ' ' . $user->getPrenom();
                },
                'query_builder' => function (EntityRepository $er) {
                    return $er->createQueryBuilder('u')
                        ->andWhere('u.role = :role')
                        ->setParameter('role', 'Coach');
                },
                // Add your other constraints here
            ])
            ->setAttributes(['novalidate' => 'novalidate']); // Apply novalidate to the entire form
    }


    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Activites::class,
        ]);
    }
}
