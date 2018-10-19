<?php

namespace App\Controller;

use App\Entity\Carte;
use App\Form\CarteType;
use App\Repository\CarteRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/carte")
 */
class CarteController extends AbstractController
{
    /**
     * @Route("/", name="carte_index", methods="GET")
     */
    public function index(CarteRepository $carteRepository): Response
    {
        return $this->render('carte/index.html.twig', ['cartes' => $carteRepository->findAll()]);
    }

    /**
     * @Route("/new", name="carte_new", methods="GET|POST")
     */
    public function new(Request $request): Response
    {
        $carte = new Carte();
        $form = $this->createForm(CarteType::class, $carte);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($carte);
            $em->flush();

            return $this->redirectToRoute('carte_index');
        }

        return $this->render('carte/new.html.twig', [
            'carte' => $carte,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="carte_show", methods="GET")
     */
    public function show(Carte $carte): Response
    {
        return $this->render('carte/show.html.twig', ['carte' => $carte]);
    }

    /**
     * @Route("/{id}/edit", name="carte_edit", methods="GET|POST")
     */
    public function edit(Request $request, Carte $carte): Response
    {
        $form = $this->createForm(CarteType::class, $carte);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('carte_edit', ['id' => $carte->getId()]);
        }

        return $this->render('carte/edit.html.twig', [
            'carte' => $carte,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="carte_delete", methods="DELETE")
     */
    public function delete(Request $request, Carte $carte): Response
    {
        if ($this->isCsrfTokenValid('delete'.$carte->getId(), $request->request->get('_token'))) {
            $em = $this->getDoctrine()->getManager();
            $em->remove($carte);
            $em->flush();
        }

        return $this->redirectToRoute('carte_index');
    }
}
