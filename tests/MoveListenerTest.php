<?php

namespace App\Tests;

use App\Entity\User;
use App\EventListener\MoveListener;
use App\Repository\UserRepository;
use App\Service\moveUserService;
use Doctrine\Common\Persistence\ObjectManager;
use PHPUnit\Framework\TestCase;

class MoveListenerTest extends TestCase
{

    public function testOnUserMove()
    {
        $user = new User();
        $user
            ->setEnabled(true)
            ->setEmail('user@user.fr')
            ->setFirstName('user')
            ->setLastName('userlast')
            ->setPassword('secret')
            ->setPositionY(0)
            ->setPositionX(0);

        $userRepo = $this->createMock(UserRepository::class);
        $userRepo->expects($this->any())
            ->method('find')
            ->willReturn($user);

    }
}
