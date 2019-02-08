<?php

namespace App\Service;

use App\Entity\Bet;
use phpDocumentor\Reflection\Types\Self_;

class CalculWinningsPariService
{
    public function winnings(Bet $bet, CalculPtsPariService $ratio){
        return $bet->getAmout() * $ratio->potentialWin($bet) * $bet->getGame()->getRating();
    }
}