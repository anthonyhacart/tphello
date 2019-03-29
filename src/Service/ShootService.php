<?php

namespace App\Service;

use App\Entity\Game;

class ShootService
{

    public function shoot(Game $attacker, Game $target)
    {
        if (1 === rand(0, 4)) {
            //une chance sur deux de le kill
            $this->shootKill($target,$attacker);
        }

        if (1 === rand(0, 1)) {
            //une chance sur deux de faire 100dmg
            $this->shootDMG($target, 100);
        }
    }

    public function shootKill(Game $target, Game $attacker)
    {
        $this->shootDMG($target,100);
        $target->setEndGame(true);
        $attacker->setAssassination($attacker->getAssassination()+1);
    }

    public function shootDMG(Game $target, $dmg)
    {
        $target->setDamage( $target->getDamage() - $dmg);
    }
}