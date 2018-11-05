<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

class BackController extends AbstractController
{
    /**
     * @Route("/back", name="back")
     */
    public function index()
    {
        return $this->render('back/index.html.twig', [
            'controller_name' => 'BackController',
        ]);
    }

}
