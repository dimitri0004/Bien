<?php

namespace App\Form;

use App\Entity\ContratLocation;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class ContratLocationType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('code')
            ->add('date_debut')
            ->add('date_fin')
            ->add('loyer_mensuel')
            ->add('montant_guarrantie')
            ->add('Locataire')
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => ContratLocation::class,
        ]);
    }
}
