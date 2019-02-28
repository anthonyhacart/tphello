<?php

namespace App\Service;

use App\Entity\User;
use App\Repository\ActionUserRepository;
use Doctrine\ORM\EntityManagerInterface;

class resetMoveUserService
{
    private $entityManager;
    private $resetPosition;
    private $actionUserRepo;

    public function __construct(EntityManagerInterface $entityManager, resetPositionService $resetPosition, ActionUserRepository $actionUserRepository)
    {
        $this->entityManager = $entityManager;
        $this->resetPosition = $resetPosition;
        $this->actionUserRepo = $actionUserRepository;

    }

    public function resetMoveUser(User $user)
    {

        if (count($this->actionUserRepo->findBy(['user' => $user])) > 10) {
            $this->resetPosition->resetPosition($user);
        }
    }
}