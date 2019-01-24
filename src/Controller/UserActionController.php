<?php

namespace App\Controller;


use App\Entity\User;
use App\Entity\Weapon;
use App\Entity\WeaponUser;
use App\Service\WeaponUser\HealUser;
use App\Service\WeaponUser\LoadWeapon;
use App\Service\WeaponUser\ReloadWeapon;
use App\Service\WeaponUser\ShootWeapon;
use App\Service\WeaponUser\StowWeapon;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;

/**
 * @Route("/user-action")
 */
class UserActionController extends AbstractController
{

    /**
     * @Route("/", name="user_action_index", methods="GET")
     */
    public function index(): Response
    {
        $em = $this->getDoctrine()->getManager();

        $weaponsUser = $em->getRepository(WeaponUser::class)->findBy(['user' => $this->getUser()]);

        $users = $em->getRepository(User::class)->findAllPlayerAlive($this->getUser());

        return $this->render('user_action/index.html.twig', ['weaponsUser' => $weaponsUser, 'users' => $users]);
    }


    /**
     * @Route("/reload/{id}", name="user_action_reload", methods="GET")
     */
    public function reload(WeaponUser $weaponUser, ReloadWeapon $reloadWeapon): Response
    {
        $reloadWeapon->reload($weaponUser);

        return $this->redirectToRoute('user_action_index');
    }

    /**
     * @Route("/load/{id}", name="user_action_load", methods="GET")
     */
    public function load(WeaponUser $weaponUser, LoadWeapon $loadWeapon): Response
    {
        $loadWeapon->load($weaponUser);

        return $this->redirectToRoute('user_action_index');
    }

    /**
     * @Route("/shoot/{id}", name="user_action_shoot", methods="GET", defaults={"id"=null})
     * @return Response
     */
    public function shoot(User $user, ShootWeapon $shootWeapon): Response
    {
        $shootWeapon->shoot($user);

        return $this->redirectToRoute('user_action_index');
    }

    /**
     * @param WeaponUser $weaponUser
     * @param StowWeapon $stowWeapon
     * @Route("/stow/{id}", name="user_action_stow", methods="GET")
     */
    public function stow(WeaponUser $weaponUser, StowWeapon $stowWeapon){
        $stowWeapon->stow($weaponUser);

        return $this->redirectToRoute('user_action_index');
    }

    /**
     * @param User $user
     * @param HealUser $healUser
     * @return \Symfony\Component\HttpFoundation\RedirectResponse
     * @Route("/heal/{id}", name="user_action_heal", methods="GET")
     */
    public function heal(User $user, HealUser $healUser){
        $healUser->heal($user);
        return $this->redirectToRoute('user_action_index');
    }
}
