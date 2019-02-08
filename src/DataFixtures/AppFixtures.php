<?php

namespace App\DataFixtures;

use App\Entity\Game;
use App\Entity\Team;
use App\Entity\User;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;

class AppFixtures extends Fixture {
    private $passwordEncoder;
    public function __construct(UserPasswordEncoderInterface $passwordEncoder) {
        $this->passwordEncoder = $passwordEncoder;
    }

    public function load(ObjectManager $manager) {

        $user1 = new User();
        $user1->setEnabled(true);
        $user1->setEmail('user@user.fr');
        $user1->setFirstName('user');
        $user1->setLastName('userlast');
        $user1->setPassword($this->passwordEncoder->encodePassword($user1,'user'));
        $manager->persist($user1);

        $user1 = new User();
        $user1->setEnabled(true);
        $user1->setEmail('user1@user.fr');
        $user1->setFirstName('user1');
        $user1->setLastName('userlast1');
        $user1->setPassword($this->passwordEncoder->encodePassword($user1,'user1'));
        $manager->persist($user1);

        $user1 = new User();
        $user1->setEnabled(true);
        $user1->setEmail('user2@user.fr');
        $user1->setFirstName('user2');
        $user1->setLastName('userlast2');
        $user1->setPassword($this->passwordEncoder->encodePassword($user1,'user2'));
        $manager->persist($user1);

<<<<<<< HEAD
        $user1 = new User();
        $user1->setEnabled(true);
        $user1->setEmail('admin@admin.fr');
        $user1->setFirstName('admin');
        $user1->setLastName('admin');
        $user1->setPassword($this->passwordEncoder->encodePassword($user1,'admin'));
        $user1->setRoles(['ROLE_ADMIN']);
        $manager->persist($user1);

        $vita = new Team();
        $vita->setName("Team Vitality")
            ->setFlag("FR");
        $manager->persist($vita);

        $g2 = new Team();
        $g2->setName("G2 Esports")
            ->setFlag("FR");
        $manager->persist($g2);

        $astralis = new Team();
        $astralis->setName("Astralis")
            ->setFlag("DK");
        $manager->persist($astralis);

        $nip = new Team();
        $nip->setName("Ninja In Pyjamas")
            ->setFlag("SE");
        $manager->persist($nip);

        $vp = new Team();
        $vp->setName("Virtus Pro")
            ->setFlag("FR");
        $manager->persist($vp);

        $c9 = new Team();
        $c9->setName("Cloud9")
            ->setFlag("US");
        $manager->persist($c9);

        $match1 = new Game();
        $match1->setDate(new \DateTime())
            ->setTeamA($vita)
            ->setTeamB($g2)
            ->setRating(3);
        $manager->persist($match1);

        $match2 = new Game();
        $match2->setDate(new \DateTime())
            ->setTeamA($astralis)
            ->setTeamB($nip)
            ->setRating(1);
        $manager->persist($match2);

        $match3 = new Game();
        $match3->setDate(new \DateTime())
            ->setTeamA($vp)
            ->setTeamB($c9);
        $manager->persist($match3);

        $match4 = new Game();
        $match4->setDate(new \DateTime())
            ->setTeamA($vita)
            ->setTeamB($vp)
            ->setScoreTeamA(7)
            ->setScoreTeamB(3);
        $manager->persist($match4);

        $match5 = new Game();
        $match5->setDate(new \DateTime())
            ->setTeamA($c9)
            ->setTeamB($g2)
            ->setScoreTeamA(4)
            ->setScoreTeamB(7);
        $manager->persist($match5);

=======
        $team1 = new Team();
        $team1->setName('toto');
        $team1->setFlag('flag a toto');
        $manager->persist($team1);

        $team2 = new Team();
        $team2->setName('roro');
        $team2->setFlag('flag a roro');
        $manager->persist($team2);

        $team3 = new Team();
        $team3->setName('titi');
        $team3->setFlag('flag a titi');
        $manager->persist($team3);

        $team4 = new Team();
        $team4->setName('riri');
        $team4->setFlag('flag a riri');
        $manager->persist($team4);

        $game1 = new Game();
        $game1->setTeamA($team1);
        $game1->setTeamB($team2);
        $game1->setDate(new \DateTime('now'));
        $game1->getRating(2);
        $manager->persist($game1);
>>>>>>> ba5fbdd83a9feb51024776cd8b636bd2c0fdb77c

        $manager->flush();
    }
}
