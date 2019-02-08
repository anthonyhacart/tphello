<?php

namespace App\Service\Bet;


use App\Entity\Bet;

class BetIsWon{

    const MADXWIN = 3;
    const WIN = 1;
    const LOSE = -1;


    public function calcul(Bet $bet = null){

        if(!$bet instanceof Bet){
            throw new \InvalidArgumentException('Bet must be set');
        }

        if($bet->getScoreTeamA() === $bet->getGame()->getScoreTeamA() && $bet->getScoreTeamB() === $bet->getGame()->getScoreTeamB()){
            return self::MADXWIN;
        }

        if($bet->getScoreTeamA() > $bet->getScoreTeamB() && $bet->getGame()->getScoreTeamA() > $bet->getGame()->getScoreTeamB()){
            return self::WIN;
        }

        if($bet->getScoreTeamA() < $bet->getScoreTeamB() && $bet->getGame()->getScoreTeamA() < $bet->getGame()->getScoreTeamB()){
            return self::WIN;
        }

        if($bet->getScoreTeamA() === $bet->getScoreTeamB() && $bet->getGame()->getScoreTeamA() === $bet->getGame()->getScoreTeamB()){
            return self::WIN;
        }

        return self::LOSE;
    }
}