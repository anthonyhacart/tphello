<?php

namespace App\EventListener;


use App\Event\MoveEvent;
use App\Service\moveUserService;
use Symfony\Component\Security\Core\Authentication\Token\Storage\TokenStorageInterface;

class MoveListener
{
    private $moveUserService;
    private $tokenStorage;

    public function __construct(moveUserService $moveUserService, TokenStorageInterface $tokenStorage)
    {
        $this->moveUserService = $moveUserService;
        $this->tokenStorage = $tokenStorage;
    }

    public function onUserMove(MoveEvent $event)
    {
        $user = $this->tokenStorage->getToken()->getUser();
        $this->moveUserService->moveUser($user, $event->getAction());
    }
}