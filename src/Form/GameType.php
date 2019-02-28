<?php

namespace App\Form;

use App\Entity\Game;
use App\Entity\Team;
use App\Form\Type\ScoreType;
use App\Form\Type\TeamType;
use App\Form\Type\VersusType;
use App\Repository\TeamRepository;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Form\FormEvent;
use Symfony\Component\Form\FormEvents;
use Symfony\Component\OptionsResolver\OptionsResolver;

class GameType extends AbstractType
{
    private $teamA;

    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $this->teamA = $options['teamA'];
        $builder
            ->add('scoreTeamA', ScoreType::class)
            ->add('scoreTeamB', ScoreType::class)
            ->add('date', DateType::class, [
                'widget' => 'single_text'
            ])
            ->add('rating')
            ->add('teamA')
            ->add('teamB')
        ;

        $builder->addEventListener(
            FormEvents::PRE_SET_DATA,
            array($this, 'preSetData')
        );
    }

    public function preSetData(FormEvent $event)
    {
        $form = $event->getForm();
        $match = $event->getData();

        $match->setDate(new \DateTime());

        if ($this->teamA !== null && $this->teamA instanceof Team) {
            $match->setTeamA($this->teamA);

            $form->remove('teamA')
                ->remove('teamB')
                ->remove('date')
                ->remove('scoreTeamA')
                ->remove('rating')
                ->remove('scoreTeamB');

            $form->add('teamB', TeamType::class, [
                'query_builder' => function (TeamRepository $tr) {
                    return $tr->createQueryBuilder('tr')
                        ->andWhere('tr != :val')
                        ->setParameter(':val', $this->teamA);
                },
            ]);
        }

    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Game::class,
            'teamA' => null
        ]);
    }
}
