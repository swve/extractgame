<?php

namespace App\Controller;

use App\Entity\User;
use App\Form\RegistrationType;
use Doctrine\Common\Persistence\ObjectManager;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Core\Authorization\AuthorizationCheckerInterface;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;

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
    public function register(Request $request, ObjectManager $manager, UserPasswordEncoderInterface $encoder, AuthorizationCheckerInterface $authChecker, \Swift_Mailer $mailer)
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
            $plain_password = $user->getPassword();
            $user->setPassword($encoded);
            $user->setRoles(array('ROLE_USER'));
            $mail_user = $user->getEmail();
            $username_user = $user->getUsername();
            $manager->persist($user);
            $manager->flush();

            // Sending an Email

            $message = (new \Swift_Message('Extract | Inscription réussie '))
                ->setFrom('extract.mission312@gmail.com')
                ->setTo($mail_user)
                ->setBody(
                    $this->renderView(
                        // templates/emails/registration.html.twig
                        'emails/registration.html.twig',
                        array('username' => $username_user)
                    ),
                    'text/html'
                );

            $mailer->send($message);

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

    /**
     * @Route("/reset", name="security_reset")
     */
    public function reset(Request $request, UserPasswordEncoderInterface $encoder, \Swift_Mailer $mailer)
    {

        $id = $request->get('user_id');
        $email = $request->get('user_email');

       

        if ( $request->isMethod('POST') ) {
            
            $entityManager = $this->getDoctrine()->getManager();
            $user = $entityManager->getRepository(User::class)->findOneBy(['email' => $email]);

            if ($user) {
              
                            $username_user = $user->getUsername();
                            

                                // Generate password
                                function generateRandomString($length = 10)
                                {
                                    $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
                                    $charactersLength = strlen($characters);
                                    $randomString = '';
                                    for ($i = 0; $i < $length; $i++) {
                                        $randomString .= $characters[rand(0, $charactersLength - 1)];
                                    }
                                    return $randomString;
                                }
                                $plain_password = generateRandomString();

                                $encoded = $encoder->encodePassword($user, $plain_password);
                                $user->setPassword($encoded);
                                $entityManager->flush();

                                // Sending an Email

                                $message = (new \Swift_Message('Extract | Mot de passe changé  '))
                                    ->setFrom('extract.mission312@gmail.com')
                                    ->setTo($email)
                                    ->setBody(
                                        $this->renderView(
                                            // templates/emails/registration.html.twig
                                            'emails/reset.html.twig',
                                            array('username' => $username_user)
                                        ),
                                        'text/html'
                                    );

                                $mailer->send($message);

                                $this->addFlash('success', "Mot de passe changé avec succès , veuillez verifier vos emails ");
                        }
            elseif (!$user) {
                $this->addFlash('fail', "Aucun utilisateur avec cette adresse mail ");
                $user = "null";
            }
           

        }
           
        
      
        return $this->render('security/reset.html.twig', [
            'user_id' => $id, 'user_email' => $email,
        ]);

    }
}
