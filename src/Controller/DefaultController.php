<?php

namespace App\Controller;
use Symfony\Component\Security\Core\Authorization\AuthorizationCheckerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

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
    public function home()
    {
        return $this->render('default/home.html.twig');
    }
}
