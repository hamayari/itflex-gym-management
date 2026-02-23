<?php

namespace App\Form;

use App\Entity\Comment;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use App\Entity\User;
use Symfony\Component\Validator\Constraints\NotBlank;
use Symfony\Component\Validator\Constraints\Length;
use Symfony\Component\Validator\Constraints\Valid;
use Symfony\Component\Form\Extension\Core\Type\TextType;

class CommentType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
        ->add('content', TextType::class, [
            'constraints' => [
                new NotBlank(['message' => 'Le contenu ne peut pas être vide.']),
                new Length([
                    'max' => 255,
                    'maxMessage' => 'Le contenu ne peut pas dépasser {{ limit }} caractères.',
                ]),
            ],
        ])
        ->add('idpost', EntityType::class, [
            'class' => 'App\Entity\Post',
            'choice_label' => function ($post) {
                // Assuming 'image' is the property in the Post entity holding the image path
                return $post->getImage();
            },
        ])
            ->add('idUser', EntityType::class, [
                'class' => 'App\Entity\User',
                'choice_label' => 'nom', // Remplacez 'username' par la propriété de l'objet User que vous souhaitez utiliser comme libellé
            ]);

        
    }
        
    

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Comment::class,
        ]);
    }
}
