<?php

namespace App\Form;

use App\Entity\BienImmobilier;
use App\Entity\Revenu;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class RevenuType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('date')
            ->add('montant')
            ->add('BienImmobilier', EntityType::class, options:[
                'class'=>BienImmobilier::class,
               'choice_label'=>'libelle',
               'placeholder'=>'Bien Immobilier'
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Revenu::class,
        ]);
    }
}
