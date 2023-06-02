<?php

namespace App\Form;

use App\Entity\BienImmobilier;
use App\Entity\Locataire;
use App\Entity\Propreitaire;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class LocataireType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('nom')
            ->add('prenom')
            ->add('age')
            ->add('numero')
            ->add('Propreitaire' , EntityType::class, options:[
                'class' =>Propreitaire::class,
                'choice_label' => 'nom',
                'placeholder'=>'Propreitaire',
                'label'=>'Propreitaire',])

            ->add('BienImmobilier', EntityType::class, options:[
                'class' =>BienImmobilier::class,
                'choice_label' => 'libelle',
                'placeholder'=>'Bien Immobilier',
                'label'=>'Propreitaire',])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Locataire::class,
        ]);
    }
}
 