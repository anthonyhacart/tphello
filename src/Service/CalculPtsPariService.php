<?php

namespace App\Service;

use App\Entity\Bet;

class CalculPtsPariService
{
    private const PERFECT_RESULT = 3;
    private const CORRECT_RESULT = 1;
    private const BAD_RESULT = -1;

    public function potentialWin(Bet $bet)
    {
        $match = $bet->getGame();

        //perfect
        if ($match->getScoreTeamA() === $bet->getScoreTeamA() &&
            $match->getScoreTeamB() === $bet->getScoreTeamB())
            return self::PERFECT_RESULT;

        //bon result mais pas parfait
        if (
            ($match->getScoreTeamA() > $match->getScoreTeamB() && $bet->getScoreTeamA() > $bet->getScoreTeamB()) //win team A
            ||
            ($match->getScoreTeamB() > $match->getScoreTeamA() && $bet->getScoreTeamB() > $match->getScoreTeamB()) //win team B
            ||
            ($match->getScoreTeamA() - $match->getScoreTeamB() === 0) && ($bet->getScoreTeamA() - $bet->getScoreTeamB() === 0)
        )
            return self::CORRECT_RESULT;



        //perdu
        return self::BAD_RESULT;
    }
}