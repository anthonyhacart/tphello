<?php

namespace App\Controller;


<<<<<<< HEAD
use App\Entity\Game;
use App\Repository\GameRepository;
=======
use App\Repository\GameRepository;
use App\Repository\TeamRepository;
>>>>>>> ba5fbdd83a9feb51024776cd8b636bd2c0fdb77c
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;
use Symfony\Component\Translation\TranslatorInterface;
use Symfony\Component\HttpFoundation\Session\SessionInterface;

class HomeController extends AbstractController
{
    /**
     * @Route("/", name="home_index", methods="GET")
     */
    public function index(Request $request, TranslatorInterface $translator, SessionInterface $session): Response
    {
        $session->set('_locale','en');

        $name = "ZimZoum";
        return $this->render('home/index.html.twig', ['roro' => $translator->trans('admin.toto',['%name%' => $name])]);
    }

    /**
     * @Route({"fr": "/maison", "en": "/house"}, name="home_index_language", methods="GET")
     */
    public function indexLanguage(TranslatorInterface $translator): Response
    {
        $name = "ZimZoum";
        return $this->render('home/index.html.twig', ['roro' => $translator->trans('admin.toto',['%name%' => $name])]);
    }


    /**
     * @Route("/teams", name="home_team", methods={"GET"})
     */
    public function homeTeam(TeamRepository $teamRepository): Response
    {
        return $this->render('home/teams.html.twig', [
            'teams' => $teamRepository->findBy([], ['name' => 'ASC']),
        ]);
    }

    /**
     * @Route("/matchs", name="match_index", methods="GET")
     */
    public function matchs(GameRepository $gameRepository): Response
    {
        return $this->render('home/matchs.html.twig', ['games' => $gameRepository->findAll()]);
    }

    /**
     * @Route("/match/{id}", name="voir_match", methods="GET")
     */
    public function match(Game $game): Response
    {
        return $this->render('home/match_show.html.twig', ['game' => $game]);
    }

}
