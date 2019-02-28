<?php

namespace App\Service;

use App\Entity\User;
use App\Repository\ActionUserRepository;
use Doctrine\ORM\EntityManagerInterface;

class resetPositionService
{
    private $entityManager;

    public function __construct(EntityManagerInterface $entityManager, ActionUserRepository $actionUserRepository)
    {
        $this->entityManager = $entityManager;
        $this->actionUserRepo = $actionUserRepository;
    }

    public function resetPosition(User $user)
    {
        $user->setPositionX(0);
        $user->setPositionY(0);

        foreach($this->actionUserRepo->findBy(['user' => $user]) as $action)
        {
            $this->entityManager->remove($action);
        }

        $this->entityManager->persist($user);
        $this->entityManager->flush();

    }
}