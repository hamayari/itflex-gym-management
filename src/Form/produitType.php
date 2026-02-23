<?php

namespace App\Form;

use App\Entity\produit;
use App\Entity\categoriemagasin;
use Symfony\Component\Form\AbstractType;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Validator\Constraints as Assert;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\Extension\Core\Type\DateType;

class produitType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('titre', null, [
                'constraints' => [
                    new Assert\NotBlank(['message' => 'Le champ Titre doit être rempli.']),
                    new Assert\Length([
                        'min' => 3,
                        'max' => 50,
                        'minMessage' => 'Le titre doit avoir au moins {{ limit }} caractères.',
                        'maxMessage' => 'Le titre doit avoir au plus {{ limit }} caractères.',
                    ]),
                ],
            ])
            ->add('image', FileType::class, [
                'label' => 'Image',
                'attr' => ['class' => 'form-control-file'],
                'constraints' => [
                    new Assert\NotBlank(['message' => 'Le champ Image doit être rempli.']),
                    new Assert\File([
                        'maxSize' => '1024k',
                        'mimeTypes' => ['image/*'],
                        'mimeTypesMessage' => 'Veuillez télécharger un fichier image valide',
                    ]),
                ],
                'data_class' => null, // Permet à Symfony de gérer le type de fichier
            ])
            ->add('date', DateType::class, [
                'constraints' => [
                    new Assert\NotBlank(['message' => 'Veuillez fournir une date.']),
                   // new Assert\DateTime(['message' => 'La date doit être au format valide.']),
                ],
            ])
            ->add('description', null, [
                'constraints' => [
                    new Assert\NotBlank(['message' => 'Le champ Description doit être rempli.']),
                    new Assert\Length([
                        'min' => 3,
                        'max' => 50,
                        'minMessage' => 'La description doit avoir au moins {{ limit }} caractères.',
                        'maxMessage' => 'La description doit avoir au plus {{ limit }} caractères.',
                    ]),
                ],
            ])
            ->add('categorie', EntityType::class, [
                'class' => Categoriemagasin::class,
                'choice_label' => 'categorie',
                'placeholder' => 'Choose a category',
                'constraints' => [
                    new Assert\NotBlank(['message' => 'Le champ Catégorie doit être rempli.']),
                ],
            ]);
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => produit::class,
        ]);
    }
}
