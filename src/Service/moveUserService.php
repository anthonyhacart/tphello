<?php

namespace App\Service;

use App\Entity\User;
use Doctrine\ORM\EntityManagerInterface;

class moveUserService
{
    private $entityManager;

    public function __construct(EntityManagerInterface $entityManager, logMoveUserService $logMoveUserService)
    {
        $this->entityManager = $entityManager;
        $this->logMoveUser = $logMoveUserService;
    }

    public function moveUser(User $user, string $action)
    {
        $this->logMoveUser->logMoveUser($user, $action);
        switch ($action) {
            case 'RIGHT':
                // RIGHT X + 1
                $user->setPositionX($user->getPositionX() + 1);
                break;
            case 'LEFT':
                // LEFT X - 1
                $user->setPositionX($user->getPositionX() - 1);
                break;
            case 'TOP':
                // top y + 1
                $user->setPositionY($user->getPositionY() + 1);
                break;
            case 'BOTTOM':
                // BOTTOM Y - 1
                $user->setPositionY($user->getPositionY() - 1);
                break;
        }
        $this->entityManager->persist($user);
        $this->entityManager->flush();
    }
}