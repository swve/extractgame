<?php

namespace App\Controller;

use App\Entity\Partie;
use App\Repository\CarteRepository;
use App\Repository\JetonRepository;
use App\Repository\UserRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

class JouerController extends AbstractController
{
    /**
     * @Route("/jouer", name="jouer")
     */
    public function index()
    {
        return $this->render('jouer/index.html.twig', [
            'controller_name' => 'JouerController',
        ]);
    }

    /**
     * @Route("/creer-partie", name="creer_partie")
     */
    public function creerPartie(UserRepository $userRepository,
        CarteRepository $carteRepository,
        JetonRepository $jetonRepository,
        Request $request) {

        if ($request->getMethod() == 'POST') {
            $j1 = $userRepository->find($request->request->get('joueur1'));
            $j2 = $userRepository->find($request->request->get('joueur2'));

            $partie = new Partie();
            $partie->setJoueur1($j1);
            $partie->setJoueur2($j2);
            $partie->setDate(new \DateTime('now'));

            $partie->setNbManche(1);
            $partie->setDefausse(false); //pas de carte dans la défausse.
            $partie->setStatus('1');
            $partie->setJetonChameaux(0); //dans aucun des deux joueurs
            $partie->setPointJ1(0); //a 0 pas de point au début d'une partie
            $partie->setPointJ2(0);
            $partie->setJetonsJ1([]); //tableau vide, pas encore de jeton en début de partie
            $partie->setJetonsJ2([]);

            //construction du terrain.
            $cartes = $carteRepository->findBy([], ['valeur' => 'DESC']);

            $tTerrain = [];
            for($i=0; $i<3; $i++) { ///on commence par 3 chameaux
                $tTerrain[] = array_pop($cartes)->getId();
            }

            shuffle($cartes);
            for($i=0; $i<2; $i++) { //on complète avec deux cartes au hasard
                $tTerrain[] = array_pop($cartes)->getId();
            }
            $partie->setTerrain($tTerrain);

            $tMain = [];
            $tChameau = [];
            for($i=0; $i<5; $i++) { //On distribue 5 cartes à J1

                $carte = array_pop($cartes);
                if ($carte->getValeur() === 0) {
                    $tChameau[] = $carte->getId();
                } else {
                    $tMain[] = $carte->getId();
                }
            }
            $partie->setMainJ1($tMain);
            $partie->setChameauxJ1($tChameau);

            $tMain = [];
            $tChameau = [];

            for($i=0; $i<5; $i++) { //On distribue 5 cartes à J2
                $carte = array_pop($cartes);
                if ($carte->getValeur() === 0) {
                    $tChameau[] = $carte->getId();
                } else {
                    $tMain[] = $carte->getId();
                }
            }
            $partie->setMainJ2($tMain);
            $partie->setChameauxJ2($tChameau);

            $tPioche = [];
            for($i=0; $i<count($cartes); $i++) {
                $tPioche[] = array_pop($cartes)->getId();
            }
            $partie->setPioche($tPioche); //les dernières cartes constituent la pioche.

            //construire les jetons sur le terrain
            $jetons = $jetonRepository->findByTypeValeur();
            $partie->setJetonsTerrain($jetons);

            $em = $this->getDoctrine()->getManager();
            $em->persist($partie);
            $em->flush();

            return $this->redirectToRoute('afficher_partie', ['partie' => $partie->getId()]);


        }
        return $this->render('jouer/creer-partie.html.twig', [
            'joueurs' => $userRepository->findAll()
        ]);
    }

    /**
     * @Route("/afficher-partie/{partie}", name="afficher_partie")
     */
    public function afficherPartie(Partie $partie) {

        return $this->render('jouer/afficher_partie.html.twig',
            ['partie' => $partie
                ]);
    }

    /**
     * @Route("/afficher-plateau/{partie}", name="afficher_plateau")
     */
    public function afficherPlateau(JetonRepository $jetonRepository, CarteRepository $carteRepository, Partie $partie) {

        return $this->render('jouer/afficher_plateau.html.twig',
            ['partie' => $partie,
             'jetons' => $jetonRepository->findByArrayId(),
             'cartes' => $carteRepository->findByArrayId(),
            ]);
    }

    /**
     * @Route("/actualise-plateau/{partie}", name="actualise_plateau")
     */
    public function actualisePlateau(Partie $partie) {
        switch ($partie->getStatus()) {
            //tester si je suis J1 ou J2 et en fonction adapter les return.
            case '1':
                return $this->json('montour');
            case '2':
                return $this->json('touradversaire');
            case 'T':
                return $this->json('T');
            default:
                return $this->json('E');
        }
    }

    /**
     * @Route("/liste-partie", name="partie_liste")
     */
    public function listePartie() {

    }
}
