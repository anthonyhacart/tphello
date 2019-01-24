<?php

namespace App\Service\WeaponUser;

use App\Entity\Weapon;
use Doctrine\ORM\EntityManagerInterface;
use App\Entity\WeaponUser;
use Symfony\Component\HttpFoundation\Session\SessionInterface;

use Symfony\Component\Security\Core\Authentication\Token\Storage\TokenStorageInterface;


class StowWeapon
{

    private $em;
    private $session;
    private $token;

    public function __construct(EntityManagerInterface $em, SessionInterface $session, TokenStorageInterface $token)
    {
        $this->em = $em;
        $this->session = $session;
        $this->token = $token;
    }

    public function stow(WeaponUser $weaponUser)
    {
        $weaponUser->setActive(false);
        $this->session->getFlashBag()->add('success', $weaponUser->getWeapon()->getName() . ' is stowed');
        $this->em->flush();
    }
}