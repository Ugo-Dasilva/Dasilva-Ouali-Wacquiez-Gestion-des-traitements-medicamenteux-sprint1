<?php

namespace App\Form;

use App\Entity\Indication;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use App\Entity\Traitement;
use App\Entity\Medicament;

class IndicationType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('Posologie')
            ->add('traitement',EntityType::class,array('class'=>Traitement::class,'choice_label'=>'id'))
            ->add('medicament',EntityType::class,array('class'=>Medicament::class,'choice_label'=>'libelle'))
            ->add('save',SubmitType::class,array('label'=>'Enregistrer l\'indication'))
            
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Indication::class,
        ]);
    }
}
