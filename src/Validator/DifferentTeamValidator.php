<?php

namespace App\Validator;

use App\Entity\Game;
use Symfony\Component\Validator\Constraint;
use Symfony\Component\Validator\ConstraintValidator;

class DifferentTeamValidator extends ConstraintValidator
{
    public function validate($value, Constraint $constraint)
    {
        // custom constraints should ignore null and empty values to allow
        // other constraints (NotBlank, NotNull, etc.) take care of that
        if (null === $value || '' === $value) {
            return;
        }

        if ($this->isSameTeam($value)) {
            $this->context->buildViolation($constraint->message)
                ->setParameter('{{ value }}', $value->getTeamA()->getName())
                ->addViolation();
        }
    }

    public function isSameTeam(Game $value)
    {
        $teamA = $value->getTeamA();
        $teamB = $value->getTeamB();

        if($teamA === $teamB)
            return true;

        return false;
    }

}
