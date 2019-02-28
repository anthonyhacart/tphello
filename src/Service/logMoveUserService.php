<?php

namespace App\Service;

use App\Entity\ActionUser;
use App\Entity\User;
use Doctrine\ORM\EntityManagerInterface;

class logMoveUserService
{
    private $entityManager;

    public function __construct(EntityManagerInterface $entityManager)
    {
        $this->entityManager = $entityManager;
    }

    public function logMoveUser(User $user, string $action)
    {
        $actionUser = new ActionUser();
        $actionUser->setUser($user)
            ->setCreatedAt(new \DateTime())
            ->setPositionX($user->getPositionX())
            ->setPositionY($user->getPositionY())
            ->setDirection($action);
        $this->entityManager->persist($actionUser);
        $this->entityManager->flush();
    }
}