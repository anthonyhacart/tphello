<?php

namespace App\Tests\Service\WeaponUser;

use App\Entity\User;
use App\Service\WeaponUser\HealUser;

use PHPUnit\Framework\TestCase;

use Doctrine\ORM\EntityManager;
use Symfony\Component\HttpFoundation\Session\Session;

use Symfony\Component\HttpFoundation\Session\Flash\FlashBag;

class HealUserTest extends TestCase
{

    private function initHealUser()
    {
        $em = $this->createMock(EntityManager::class);
        $em->expects($this->once())
            ->method('flush');

        $flashBag = $this->createMock(FlashBag::class);
        $session = $this->createMock(Session::class);
        $session->expects($this->once())
            ->method('getFlashBag')
            ->willReturn($flashBag);
        $flashBag->expects($this->once())
            ->method('add');


        return new HealUser($em, $session);
    }

    /**
     * @expectedException TypeError
     */
    public function testHealWithNoUser()
    {

        $healUser = $this->initHealUser();

        $healUser->heal(null);
    }

    public function testHealOneUser()
    {

        $user = new User();
        $user->setHealth(950)
            ->setEmail("toto@toto.fr")
            ->setEnabled(true)
            ->setFirstName("toto")
            ->setLastName("toto")
            ->setPassword("toto")
            ->setRoles(['ROLE_USER']);

        $healUser = $this->initHealUser([$user]);

        $healUser->load($user);

        $this->assertEquals(1000, $user->getHealth());
    }


}