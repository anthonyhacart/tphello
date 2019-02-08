<?php

namespace App\Form;

use App\Entity\Game;
<<<<<<< HEAD
use App\Form\Type\ScoreType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use App\Form\Type\TeamType;
=======
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
>>>>>>> ba5fbdd83a9feb51024776cd8b636bd2c0fdb77c

class GameType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
<<<<<<< HEAD
            ->add('scoreTeamA',ScoreType::class)
            ->add('scoreTeamB',ScoreType::class)
            ->add('date')
            ->add('rating')
            ->add('teamA',TeamType::class)
            ->add('teamB',TeamType::class)
=======
            ->add('scoreTeamA')
            ->add('scoreTeamB')
            ->add('date')
            ->add('rating')
            ->add('teamA')
            ->add('teamB')
>>>>>>> ba5fbdd83a9feb51024776cd8b636bd2c0fdb77c
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Game::class,
        ]);
    }
}
