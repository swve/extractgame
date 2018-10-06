<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

class DefaultController extends AbstractController
{
    /**
     * @Route("/", name="index_route")
     */
    public function index()
    {
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
