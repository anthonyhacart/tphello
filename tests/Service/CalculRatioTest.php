<?php

namespace App\Tests\Service;

use App\Entity\Bet;
use App\Entity\Game;
use App\Entity\Team;
use App\Service\CalculPtsPariService;
use DateTime;
use PHPUnit\Framework\TestCase;

class CalculRatioTest extends TestCase
{
    public function testPerfect()
    {
        $bet = new Bet();
        $game = new Game();
        $team1 = (new Team())->setName("G2");
        $team2 = (new Team())->setName("C9");

        $game->setScoreTeamA(6)
            ->setScoreTeamB(6)
            ->setDate(new DateTime())
            ->setTeamB($team1)
            ->setTeamA($team2);
        $bet->setDate(new DateTime())
            ->setScoreTeamB(6)
            ->setScoreTeamA(6)
            ->setAmout(50)
            ->setGame($game);
        $calculator = new CalculPtsPariService();
        $result = $calculator->potentialWin($bet);

        $this->assertEquals(3, $result);
    }

    public function testWinA()
    {
        $bet = new Bet();
        $game = new Game();
        $team1 = (new Team())->setName("G2");
        $team2 = (new Team())->setName("C9");

        $game->setScoreTeamA(9)
            ->setScoreTeamB(3)
            ->setDate(new DateTime())
            ->setTeamB($team1)
            ->setTeamA($team2);
        $bet->setDate(new DateTime())
            ->setScoreTeamA(8)
            ->setScoreTeamB(4)
            ->setAmout(50)
            ->setGame($game);
        $calculator = new CalculPtsPariService();
        $result = $calculator->potentialWin($bet);

        $this->assertEquals(1, $result);
    }

    public function testWinB()
    {
        $bet = new Bet();
        $game = new Game();
        $team1 = (new Team())->setName("G2");
        $team2 = (new Team())->setName("C9");

        $game->setScoreTeamA(10)
            ->setScoreTeamB(2)
            ->setDate(new DateTime())
            ->setTeamB($team1)
            ->setTeamA($team2);
        $bet->setDate(new DateTime())
            ->setScoreTeamA(11)
            ->setScoreTeamB(1)
            ->setAmout(50)
            ->setGame($game);
        $calculator = new CalculPtsPariService();
        $result = $calculator->potentialWin($bet);

        $this->assertEquals(1, $result);
    }

    public function testLoose()
    {
        $bet = new Bet();
        $game = new Game();
        $team1 = (new Team())->setName("G2");
        $team2 = (new Team())->setName("C9");

        $game->setScoreTeamA(10)
            ->setScoreTeamB(2)
            ->setDate(new DateTime())
            ->setTeamB($team1)
            ->setTeamA($team2);
        $bet->setDate(new DateTime())
            ->setScoreTeamA(1)
            ->setScoreTeamB(12)
            ->setAmout(50)
            ->setGame($game);
        $calculator = new CalculPtsPariService();
        $result = $calculator->potentialWin($bet);

        $this->assertEquals(-1, $result);
    }

    public function testDraw()
    {
        $bet = new Bet();
        $game = new Game();
        $team1 = (new Team())->setName("G2");
        $team2 = (new Team())->setName("C9");

        $game->setScoreTeamA(5)
            ->setScoreTeamB(3)
            ->setDate(new DateTime())
            ->setTeamB($team1)
            ->setTeamA($team2);
        $bet->setDate(new DateTime())
            ->setScoreTeamA(3)
            ->setScoreTeamB(1)
            ->setAmout(50)
            ->setGame($game);
        $calculator = new CalculPtsPariService();
        $result = $calculator->potentialWin($bet);

        $this->assertEquals(1, $result);
    }
}
