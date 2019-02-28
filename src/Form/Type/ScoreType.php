<?php

namespace App\Form\Type;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;

class ScoreType extends AbstractType
{
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'choices' => $this->genererScoreLimite(),
            'attr' => ['onChange' => 'changeColor(this.value)']
        ]);

    }

    private function genererScoreLimite($min = 0, $max = 12)
    {
        $tab = array();
        for ($i = $min; $i <= $max; $i++) {
            $tab[$i] = $i;
        }
        return $tab;
    }

    public function getParent()
    {
        return ChoiceType::class;
    }
}
