<?php

namespace App\Tests\Service\WeaponUser;

use App\Entity\User;
use App\Entity\Weapon;
use App\Service\WeaponUser\LoadWeapon;
use PHPUnit\Framework\TestCase;

use App\Entity\WeaponUser;

use Doctrine\ORM\EntityManager;
use Symfony\Component\HttpFoundation\Session\Session;
use Symfony\Component\Security\Core\Authentication\Token\Storage\TokenStorage;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Symfony\Component\Security\Guard\Token\PostAuthenticationGuardToken;
use Symfony\Component\HttpFoundation\Session\Flash\FlashBag;

class LoadWeaponTest extends TestCase{

    private function initLoadWeapon($repoData){
        $repo = $this->createMock(ServiceEntityRepository::class);
        $repo->expects($this->once())
            ->method('findBy')
            ->willReturn($repoData);
        $em = $this->createMock(EntityManager::class);
        $em->expects($this->once())
            ->method('getRepository')
            ->willReturn($repo);
        $em->expects($this->once())
            ->method('flush');

        $flashBag = $this->createMock(FlashBag::class);
        $session = $this->createMock(Session::class);
        $session->expects($this->once())
            ->method('getFlashBag')
            ->willReturn($flashBag);
        $flashBag->expects($this->once())
            ->method('add');

        $user = $this->createMock(User::class);

        $tokenToken = $this->createMock(PostAuthenticationGuardToken::class);
        $tokenToken->expects($this->once())
            ->method('getUser')
            ->willReturn($user);

        $token = $this->createMock(TokenStorage::class);
        $token->expects($this->once())
            ->method('getToken')
            ->willReturn($tokenToken);

        return new LoadWeapon($em, $session, $token);
    }

    /**
     * @expectedException TypeError
     */
    public function testLoadWithNoWeaponUser(){

        $loadWeapon = $this->initLoadWeapon();

        $loadWeapon->load(null);
    }

    public function testLoadWithOneWeaponUnload(){

        $weaponUser = new WeaponUser();
        $weapon = $this->createMock(Weapon::class);
        $weapon->expects($this->once())
            ->method('getName')
            ->willReturn('toto');

        $weaponUser->setWeapon($weapon);

        $loadWeapon = $this->initLoadWeapon([$weaponUser]);

        $loadWeapon->load($weaponUser);

        $this->assertTrue($weaponUser->getActive());
    }

    public function testLoadWithOneWeaponLoad(){

        $weaponUser = new WeaponUser();
        $weaponUser->setActive(true);
        $weapon = $this->createMock(Weapon::class);
        $weapon->expects($this->once())
            ->method('getName')
            ->willReturn('toto');
        $weaponUser->setWeapon($weapon);

        $loadWeapon = $this->initLoadWeapon([$weaponUser]);

        $loadWeapon->load($weaponUser);

        $this->assertTrue($weaponUser->getActive());
    }


    public function testLoadWithThreeWeaponMixLoad(){

        $weaponUser = new WeaponUser();
        $weaponUser->setActive(true);
        $weapon = $this->createMock(Weapon::class);
        $weapon->expects($this->once())
            ->method('getName')
            ->willReturn('toto');

        $weaponUser1 = clone($weaponUser);
        $weaponUser2 = clone($weaponUser);
        $weaponUser2->setActive(false);

        $weaponUser->setWeapon($weapon);

        $loadWeapon = $this->initLoadWeapon([$weaponUser, $weaponUser1, $weaponUser2]);

        $loadWeapon->load($weaponUser);

        $this->assertTrue($weaponUser->getActive());
    }

}