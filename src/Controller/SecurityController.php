<?php

namespace App\Controller;
use App\Entity\User;
use App\Form\RegistrationType;
use Symfony\Component\HttpFoundation\Request;
use Doctrine\Common\Persistence\ObjectManager;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Security\Http\Authentication\AuthenticationUtils;

class SecurityController extends AbstractController
{
    /**
     * @Route("/register", name="register")
     */
    public function register(Request $request , ObjectManager $manager)
    {

        $user = new User();
        $form = $this->createForm(RegistrationType::class, $user );
        $form -> handleRequest($request);
        
        if ( $form->isSubmitted() && $form->isValid()) {
            $user->setAvatarImg('Nothing');
            $manager->persist($user);
            $manager->flush();
            return $this->redirectToRoute('security_login');
            
        }
        return $this->render('security/register.html.twig' , [
            'form' => $form->createView()
        ]);

    }

    /**
     * @Route("/login", name="security_login")
     */
    public function login()
    {
        return $this->render('security/login.html.twig');
    }
}
