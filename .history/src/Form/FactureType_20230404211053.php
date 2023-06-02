<?php

namespace App\Form;

use App\Entity\Facture;
use App\Entity\Locataire;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\OptionsResolver\OptionsResolver;

class FactureType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('date_emission')
            ->add('date_delai')
            ->add('montant')
            ->add('Locataire' , EntityType::class, options:[
                'class'=>Locataire::class,
               'choice_label'=>'libelle',
               'placeholder'=>'Bien Immobilier'
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Facture::class,
        ]);
    }
}
