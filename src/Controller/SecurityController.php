<?php

namespace App\Controller;

use App\Entity\User;
use App\Form\RegistrationType;
use Symfony\Component\HttpFoundation\Request;
use Doctrine\Common\Persistence\ObjectManager;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;
use Symfony\Component\Security\Core\Authorization\AuthorizationCheckerInterface;

class SecurityController extends AbstractController
{
    /**
     * @Route("/security", name="security")
     */
    public function index()
    {
        return $this->render('security/index.html.twig', [
            'controller_name' => 'SecurityController',
        ]);
    }

     /**
     * @Route("/login", name="security_login")
     */
    public function login(AuthorizationCheckerInterface $authChecker)
    {

        // Redirection if the user is already registered and logged in
        if (true === $authChecker->isGranted('IS_AUTHENTICATED_FULLY')) {
            return $this->redirectToRoute('home_route');
        }

        return $this->render('security/login.html.twig', [
            'controller_name' => 'SecurityController',
        ]);
    }

     /**
     * @Route("/register", name="security_register")
     */
    public function register(Request $request , ObjectManager $manager , UserPasswordEncoderInterface $encoder , AuthorizationCheckerInterface $authChecker)
    {

        // Redirection if the user is already registered and logged in
        if (true === $authChecker->isGranted('IS_AUTHENTICATED_FULLY')) {
            return $this->redirectToRoute('home_route');
        }

        $user = new User();
        $form = $this->createForm(RegistrationType::class, $user);


        // 2) handle the submit (will only happen on POST)
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {

            $user->setAvatarImg('nothing');
            $encoded = $encoder->encodePassword($user, $user->getPassword());
            $user->setPassword($encoded);
           
            $manager->persist($user);
            $manager->flush();

            // ... do any other work - like sending them an email, etc
            // maybe set a "flash" success message for the user

            return $this->redirectToRoute('security_login');
        }
        return $this->render('security/register.html.twig', [
            'form' => $form->createView(),
        ]);
    }

     /**
     * @Route("/logout", name="security_logout")
     */
    public function logout()
    {
        
    }
}
