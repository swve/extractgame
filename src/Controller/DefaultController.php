<?php

namespace App\Controller;

use App\Repository\PartieRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Core\Authorization\AuthorizationCheckerInterface;

class DefaultController extends AbstractController
{
    /**
     * @Route("/", name="index_route")
     */
    public function index(AuthorizationCheckerInterface $authChecker)
    {
        // Redirection if the user is already registered and logged in
        if (true === $authChecker->isGranted('IS_AUTHENTICATED_FULLY')) {
            return $this->redirectToRoute('home_route');
        }

        return $this->render('default/index.html.twig');
    }

    /**
     * @Route("/home", name="home_route")
     */
    public function home(AuthorizationCheckerInterface $authChecker, PartieRepository $PartieRepository)
    {
        if (true === $authChecker->isGranted('ROLE_BANNED')) {
            return $this->redirectToRoute('banned');
        }
        $user = $this->getUser();
        return $this->render('default/home.html.twig',
            ['mesparties' => $PartieRepository->findBy(['joueur1' => $user->getId()]),
                'invparties' => $PartieRepository->findBy(['joueur2' => $user->getId()]),
            ]

        );
    }
}
