<?php

namespace App\Controller;
use App\Entity\User;

use App\Repository\UserRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

class BanController extends AbstractController
{
    /**
     * @Route("/back/ban", name="back_ban")
     */
    public function index(UserRepository $userRepository)
    {
        return $this->render('ban/index.html.twig', ['users' => $userRepository->findAll()]);
    }

    /**
     * @Route("/back/user_ban/{id}" , name="ban_user")
     */
    public function user_ban($id)
    {
        $entityManager = $this->getDoctrine()->getManager();
        $user = $entityManager->getRepository(User::class)->find($id);

        if (!$user) {
            throw $this->createNotFoundException(
                'No product found for id ' . $id
            );
        }

        $user->setRoles(array('ROLE_BANNED'));
        $entityManager->flush();

        return $this->redirectToRoute('back_ban');
    }


     /**
     * @Route("/back/user_deban/{id}" , name="deban_user")
     */
    public function user_deban($id)
    {
        $entityManager = $this->getDoctrine()->getManager();
        $user = $entityManager->getRepository(User::class)->find($id);

        if (!$user) {
            throw $this->createNotFoundException(
                'No product found for id ' . $id
            );
        }

        $user->setRoles(array('ROLE_USER'));
        $entityManager->flush();

        return $this->redirectToRoute('back_ban');
    }


    /**
     * @Route("/banned", name="banned")
     */
    public function banned(UserRepository $userRepository)
    {
        return $this->render('ban/banned.html.twig');
    }
}
