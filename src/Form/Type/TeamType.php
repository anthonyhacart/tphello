<?php

namespace App\Form\Type;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use App\Entity\Team;
use App\Repository\TeamRepository;

class TeamType extends AbstractType
{
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'class' => Team::class,
            'query_builder' => function (TeamRepository $tr) {
                return $tr->createQueryBuilder('tr')
                    ->orderBy('tr.name', 'ASC');
            },
            'choice_label' => 'name',
        ]);

    }

    public function getParent(){
        return EntityType::class;
    }
}
