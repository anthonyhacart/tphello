<?php

namespace App\EventSubscriber;

use App\Service\resetMoveUserService;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\EventDispatcher\EventSubscriberInterface;
use App\Event\MoveEvent;
use Symfony\Component\Security\Core\Authentication\Token\Storage\TokenStorageInterface;


class ResetSubscriber implements EventSubscriberInterface
{
    private $entityManager;
    private $resetMoveUser;
    private $tokenStorage;

    public function __construct(EntityManagerInterface $entityManager, resetMoveUserService $resetMoveUser, TokenStorageInterface $tokenStorage)
    {
        $this->entityManager = $entityManager;
        $this->resetMoveUser = $resetMoveUser;
        $this->tokenStorage = $tokenStorage;
    }
    public function onUserMove(MoveEvent $event)
    {
        $this->resetMoveUser->resetMoveUser($this->tokenStorage->getToken()->getUser());
    }

    public static function getSubscribedEvents()
    {
        return [
           'user.move' => 'onUserMove',
        ];
    }
}
