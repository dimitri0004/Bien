<?php

namespace App\Form;

use App\Entity\BienImmobilier;
use App\Entity\Propreitaire;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class BienImmobilierType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('libelle')
            ->add('localisation')
            ->add('taille')
            ->add('prix')
            ->add('image', FileType::class)
            ->add('Propreitaire', EntityType::class, options:[
                'class' =>Propreitaire::class,
                'choice_label' => 'nom',
                'label'=>'Propreitaire',])
            ->add('AgentImmobilier')
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => BienImmobilier::class,
        ]);
    }
}
