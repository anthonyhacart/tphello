<?php
namespace App\Tests\Service\Bet;

use App\Entity\Bet;
use App\Entity\Game;

use App\Service\Bet\BetIsWon;
use PHPUnit\Framework\TestCase;

class BetIsWonTest extends TestCase{


    /**
    * @expectedException \InvalidArgumentException
    */
    public function testScoreWithoutBet(){

        $betWin = new BetIsWon();

        $this->assertEquals(BetIsWon::MADXWIN, $betWin->calcul());
    }

    public function testScoreExacte0vs0(){

        $bet = new Bet();
        $bet->setScoreTeamA(0);
        $bet->setScoreTeamB(0);
        $game = new Game();
        $game->setScoreTeamA(0);
        $game->setScoreTeamB(0);
        $bet->setGame($game);

        $betWin = new BetIsWon();

        $this->assertEquals(BetIsWon::MADXWIN, $betWin->calcul($bet));
    }

    public function testScoreExacte10vs10(){

        $bet = new Bet();
        $bet->setScoreTeamA(10);
        $bet->setScoreTeamB(10);
        $game = new Game();
        $game->setScoreTeamA(10);
        $game->setScoreTeamB(10);
        $bet->setGame($game);

        $betWin = new BetIsWon();

        $this->assertEquals(BetIsWon::MADXWIN, $betWin->calcul($bet));
    }

    public function testScoreEquipeAWin(){

        $bet = new Bet();
        $bet->setScoreTeamA(12);
        $bet->setScoreTeamB(0);
        $game = new Game();
        $game->setScoreTeamA(3);
        $game->setScoreTeamB(1);
        $bet->setGame($game);

        $betWin = new BetIsWon();

        $this->assertEquals(BetIsWon::WIN, $betWin->calcul($bet));
    }

    public function testScoreEquipeBWin(){

        $bet = new Bet();
        $bet->setScoreTeamA(4);
        $bet->setScoreTeamB(6);
        $game = new Game();
        $game->setScoreTeamA(2);
        $game->setScoreTeamB(5);
        $bet->setGame($game);

        $betWin = new BetIsWon();

        $this->assertEquals(BetIsWon::WIN, $betWin->calcul($bet));
    }

    public function testScoreEquipeDraw(){

        $bet = new Bet();
        $bet->setScoreTeamA(6);
        $bet->setScoreTeamB(6);
        $game = new Game();
        $game->setScoreTeamA(2);
        $game->setScoreTeamB(2);
        $bet->setGame($game);

        $betWin = new BetIsWon();

        $this->assertEquals(BetIsWon::WIN, $betWin->calcul($bet));
    }

    public function testScoreEquipeDrawLess(){

        $bet = new Bet();
        $bet->setScoreTeamA(3);
        $bet->setScoreTeamB(3);
        $game = new Game();
        $game->setScoreTeamA(2);
        $game->setScoreTeamB(2);
        $bet->setGame($game);

        $betWin = new BetIsWon();

        $this->assertEquals(BetIsWon::WIN, $betWin->calcul($bet));
    }

    public function testScoreEquipeDrawLose(){

        $bet = new Bet();
        $bet->setScoreTeamA(5);
        $bet->setScoreTeamB(2);
        $game = new Game();
        $game->setScoreTeamA(2);
        $game->setScoreTeamB(2);
        $bet->setGame($game);

        $betWin = new BetIsWon();

        $this->assertEquals(BetIsWon::LOSE, $betWin->calcul($bet));
    }

    public function testScoreEquipeWinLose(){

        $bet = new Bet();
        $bet->setScoreTeamA(5);
        $bet->setScoreTeamB(2);
        $game = $this->createMock(Game::class);
        $game->expects($this->any())
            ->method('setScoreTeamA')
            ->willReturn(5);
        $game->expects($this->any())
            ->method('setScoreTeamB')
            ->willReturn(0);
        $bet->setGame($game);

        $betWin = new BetIsWon();

        $this->assertEquals(BetIsWon::LOSE, $betWin->calcul($bet));
    }
}