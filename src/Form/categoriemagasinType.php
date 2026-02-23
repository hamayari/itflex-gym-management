<?php

namespace App\Form;

use App\Entity\categoriemagasin;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Validator\Constraints as Assert;

class categoriemagasinType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
        ->add('categorie', null, [
            'constraints' => [
                new Assert\Regex([
                    'pattern' => '/^[a-zA-Z]+$/',
                    'message' => 'Le champ Catégorie doit être une chaîne de caractères.',
                ]),
            ],
        ]);
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => categoriemagasin::class,
        ]);
    }
}
