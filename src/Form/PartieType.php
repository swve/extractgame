<?php

namespace App\Form;

use App\Entity\Partie;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class PartieType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('date')
            ->add('status')
            ->add('terrain')
            ->add('pioche')
            ->add('jeton_chameaux')
            ->add('defausse')
            ->add('main_j1')
            ->add('main_j2')
            ->add('chameaux_j1')
            ->add('chameaux_j2')
            ->add('jetons_j1')
            ->add('jetons_j2')
            ->add('nb_manche')
            ->add('point_j1')
            ->add('point_j2')
            ->add('jetons_terrain')
            ->add('joueur1')
            ->add('joueur2')
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Partie::class,
        ]);
    }
}
