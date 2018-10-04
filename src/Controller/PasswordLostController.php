<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

class PasswordLostController extends AbstractController
{
    /**
     * @Route("/password/lost", name="password_lost")
     */
    public function index()
    {
        return $this->render('password_lost/index.html.twig', [
            'controller_name' => 'PasswordLostController',
        ]);
    }
}
