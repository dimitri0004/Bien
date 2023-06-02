<?php

namespace App\Form;

use App\Form\StringToFileTransformer;
use App\Entity\AgentImmobilier;
use App\Entity\BienImmobilier;
use App\Entity\Propreitaire;
use Doctrine\DBAL\Types\SmallIntType;
use StringToFileTransformer as GlobalStringToFileTransformer;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\Extension\Core\Type\MoneyType;
use Symfony\Component\Form\Extension\Core\Type\NumberType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Validator\Constraints\File;

class BienImmobilierType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('libelle')
            ->add('localisation')
            ->add('taille')
            ->add('prix', MoneyType::class)
            ->add('image', FileType::class , options:[
                'label'=>'Image ',

                'mapped' => false,

                'required' => false,
                
                'data_class'=>null,

                'constraints' => [
                    new File([
                        'maxSize' => '1024k',
                        'mimeTypes' => [
                            'image/jpg',
                            'image/png',
                            'image/jif',
                            'image/jpeg',
                        ],
                        'mimeTypesMessage' => 'Please upload a valid image type document',
                    ])
                ],
                
            ])
           

            ->add('Propreitaire', EntityType::class, options:[
                'class' =>Propreitaire::class,
                'choice_label' => 'nom',
                'placeholder'=>'Propreitaire',
                'label'=>'Propreitaire',])
            ->add('AgentImmobilier',  EntityType::class, options:[
                'class' =>AgentImmobilier::class,
                'choice_label' => 'nom',
                'placeholder'=>'Agent Immobilier',
                'label'=>'Agent Immobilier',])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => BienImmobilier::class,
        ]);
    }

    
}
