<?php

namespace App\Controller;

use App\Entity\Jeton;
use App\Form\JetonType;
use App\Repository\JetonRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/jeton")
 */
class JetonController extends AbstractController
{
    /**
     * @Route("/", name="jeton_index", methods="GET")
     */
    public function index(JetonRepository $jetonRepository): Response
    {
        return $this->render('jeton/index.html.twig', ['jetons' => $jetonRepository->findAll()]);
    }

    /**
     * @Route("/new", name="jeton_new", methods="GET|POST")
     */
    public function new(Request $request): Response
    {
        $jeton = new Jeton();
        $form = $this->createForm(JetonType::class, $jeton);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($jeton);
            $em->flush();

            return $this->redirectToRoute('jeton_index');
        }

        return $this->render('jeton/new.html.twig', [
            'jeton' => $jeton,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="jeton_show", methods="GET")
     */
    public function show(Jeton $jeton): Response
    {
        return $this->render('jeton/show.html.twig', ['jeton' => $jeton]);
    }

    /**
     * @Route("/{id}/edit", name="jeton_edit", methods="GET|POST")
     */
    public function edit(Request $request, Jeton $jeton): Response
    {
        $form = $this->createForm(JetonType::class, $jeton);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('jeton_edit', ['id' => $jeton->getId()]);
        }

        return $this->render('jeton/edit.html.twig', [
            'jeton' => $jeton,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="jeton_delete", methods="DELETE")
     */
    public function delete(Request $request, Jeton $jeton): Response
    {
        if ($this->isCsrfTokenValid('delete'.$jeton->getId(), $request->request->get('_token'))) {
            $em = $this->getDoctrine()->getManager();
            $em->remove($jeton);
            $em->flush();
        }

        return $this->redirectToRoute('jeton_index');
    }
}
