<?php

namespace App\Form\Type;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;

class DirectionType extends AbstractType
{
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'choices' => [
                'LEFT' => 'LEFT',
                'RIGHT' => 'RIGHT',
                'TOP' => 'TOP',
                'BOTTOM' => 'BOTTOM',
            ],
            'expanded' => true,
        ]);

    }

    public function getParent(){
        return ChoiceType::class;
    }
}
