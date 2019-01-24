<?php

namespace App\Service\WeaponUser;

use App\Entity\User;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Session\SessionInterface;

use Symfony\Component\Security\Core\Authentication\Token\Storage\TokenStorageInterface;


class HealUser
{

    private $em;
    private $session;
    private $token;

    public function __construct(EntityManagerInterface $em, SessionInterface $session)
    {
        $this->em = $em;
        $this->session = $session;
    }

    public function heal(User $user)
    {
        $user->setHealth(User::HEALT);
        $this->session->getFlashBag()->add('success', $user->getUsername() . ' is full HP NOW');
        $this->em->flush();
    }
}