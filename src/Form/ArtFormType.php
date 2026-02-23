<?php

namespace App\Form;

use App\Entity\Offer;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Vich\UploaderBundle\Form\Type\VichImageType;

class ArtFormType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('imageFile', VichImageType::class, [
            'label' => 'Image de loffre ( des images uniquement)',
            'label_attr' => [
                'class' => 'form-label mt-4'
            ],
            'required' => true
             ])
            ->add('titleoffer')
            ->add('descriptionoffer')
            ->add('prix')
            ->add('datedeboffer')
            ->add('datefinoffer')
            //->add('img')

        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Offer::class,
        ]);
    }
}
