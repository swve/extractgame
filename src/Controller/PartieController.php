<?php

namespace App\Controller;

use App\Entity\Partie;
use App\Form\PartieType;
use App\Repository\PartieRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/back/partie")
 */
class PartieController extends AbstractController
{
    /**
     * @Route("/", name="partie_index", methods="GET")
     */
    public function index(PartieRepository $partieRepository): Response
    {
        return $this->render('partie/index.html.twig', ['parties' => $partieRepository->findAll()]);
    }

    /**
     * @Route("/new", name="partie_new", methods="GET|POST")
     */
    public function new(Request $request): Response
    {
        $partie = new Partie();
        $form = $this->createForm(PartieType::class, $partie);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($partie);
            $em->flush();

            return $this->redirectToRoute('partie_index');
        }

        return $this->render('partie/new.html.twig', [
            'partie' => $partie,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="partie_show", methods="GET")
     */
    public function show(Partie $partie): Response
    {
        return $this->render('partie/show.html.twig', ['partie' => $partie]);
    }

    /**
     * @Route("/{id}/edit", name="partie_edit", methods="GET|POST")
     */
    public function edit(Request $request, Partie $partie): Response
    {
        $form = $this->createForm(PartieType::class, $partie);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('partie_edit', ['id' => $partie->getId()]);
        }

        return $this->render('partie/edit.html.twig', [
            'partie' => $partie,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="partie_delete", methods="DELETE")
     */
    public function delete(Request $request, Partie $partie): Response
    {
        if ($this->isCsrfTokenValid('delete'.$partie->getId(), $request->request->get('_token'))) {
            $em = $this->getDoctrine()->getManager();
            $em->remove($partie);
            $em->flush();
        }

        return $this->redirectToRoute('partie_index');
    }
}
