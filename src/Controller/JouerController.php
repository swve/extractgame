<?php

namespace App\Controller;

use App\Entity\Partie;
use App\Repository\UserRepository;
use App\Repository\CarteRepository;
use App\Repository\JetonRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Core\User\UserInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

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
     * @Route("/creer-partie", name="partie_creer")
     */
    public function creerPartie(
        UserRepository $userRepository,
        CarteRepository $carteRepository,
        JetonRepository $jetonRepository,
        Request $request,
        UserInterface $user
    ) {
        $userId = $user->getId();

        if ($request->getMethod() == 'POST') {
            $j1 = $userRepository->find($userId);
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
            for ($i = 0; $i < 3; $i++) { ///on commence par 3 chameaux
                $tTerrain[] = array_pop($cartes)->getId();
            }

            shuffle($cartes);
            for ($i = 0; $i < 2; $i++) { //on complète avec deux cartes au hasard
                $tTerrain[] = array_pop($cartes)->getId();
            }
            $partie->setTerrain($tTerrain);

            $tMain = [];
            $tChameau = [];
            for ($i = 0; $i < 5; $i++) { //On distribue 5 cartes à J1

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

            for ($i = 0; $i < 5; $i++) { //On distribue 5 cartes à J2
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
            $nbcartes = count($cartes);
            for ($i = 0; $i < $nbcartes; $i++) {
                echo $i;
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
            'joueurs' => $userRepository->findAll(),
        ]);
    }

    /**
     * @Route("/afficher-partie/{partie}", name="afficher_partie")
     */
    public function afficherPartie(Partie $partie)
    {
        
        return $this->render('jouer/afficher_partie.html.twig',
            [
                'partie' => $partie,
            ]);
    }

    /**
     * @Route("/afficher-plateau/{partie}", name="afficher_plateau")
     */
    public function afficherPlateau(JetonRepository $jetonRepository, CarteRepository $carteRepository, Partie $partie)
    {

        return $this->render('jouer/afficher_plateau.html.twig',
            [
                'partie' => $partie,
                'jetons' => $jetonRepository->findByArrayId(),
                'cartes' => $carteRepository->findByArrayId(),
            ]);
    }

    /**
     * @Route("/actualise-plateau/{partie}", name="actualise_plateau")
     */
    public function actualisePlateau(Partie $partie)
    {
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
     * @Route("/jouer-action/prendre/{partie}", name="jouer_action_prendre")
     */
    public function jouerActionPrendre(
        EntityManagerInterface $entityManager,
        CarteRepository $carteRepository,
        Request $request,
        Partie $partie
    ) {

        $idcarte = $request->request->get('cartes');
        $idchameaux = $request->request->get('chameaux');

        if ($idchameaux !== null) {
            $chameau = $carteRepository->find($idchameaux[0]);

            //je considére que je suis j1.
            $main_chameaux = $partie->getChameauxJ1();
            $terrain = $partie->getTerrain();

            for ($i = 0; $i < count($idchameaux); $i++) {

                $main_chameaux[] = $idchameaux[$i]; //on ajoute dans la main de J1

                $index = array_search($idchameaux[$i], $terrain);

                unset($terrain[$index]); // on retire du terrain

                $pioche = $partie->getPioche();

            }

            for ($i = 0; $i < count($idchameaux); $i++) {

                $pioche = $partie->getPioche();

                $idcartep = array_pop($pioche);
                $cartep = $carteRepository->find($idcartep);

                $terrain[] = array_rand($pioche); //piocher et mettre sur le terrain

            }

            // executer
            $partie->setChameauxJ1($main_chameaux);
            $partie->setTerrain($terrain);
            $partie->setPioche($pioche);

            $entityManager->flush();

            return $this->json(['carteterrain' => $cartep->getJson(), 'carteschameaux' => $chameau->getJson()], 200);
        }

        if ($idcarte !== null) {
            $carte = $carteRepository->find($idcarte[0]);

            if ($carte !== null) {

                //je considére que je suis j1.
                $main = $partie->getMainJ1();
                //vérifier s'il y a 7 cartes dans la main (pourrait se faire en js).

                if (count($main) < 7) {
                    $main[] = $carte->getId(); //on ajoute dans la main de J1
                    $terrain = $partie->getTerrain();
                    $index = array_search($carte->getId(), $terrain);
                    unset($terrain[$index]); // on retire du terrain
                    $pioche = $partie->getPioche();
                    if (count($pioche) > 0) {
                        $idcartep = array_pop($pioche);
                        $cartep = $carteRepository->find($idcartep);
                        if ($cartep !== null) {
                            $terrain[] = $cartep->getId(); //piocher et mettre sur le terrain
                        }
                    }

                    $partie->setMainJ1($main);
                    $partie->setTerrain($terrain);
                    $partie->setPioche($pioche);
                    $entityManager->flush();

                    return $this->json(['carteterrain' => $cartep->getJson(), 'cartemain' => $carte->getJson()], 200);
                } else {
                    return $this->json('erreur7', 500);
                }

            }
        }
        return $this->json('erreur', 500);
    }

    /**
     * @Route("/jouer-action/vendre/{partie}", name="jouer_action_vendre")
     */
    public function jouerActionVendre(
        EntityManagerInterface $entityManager,
        CarteRepository $carteRepository,
        Request $request,
        Partie $partie
    ) {

        $idcarteMain = $request->request->get('main');

        if ($idcarteMain !== null) {
            $carte = $carteRepository->find($idcarteMain[0]);

            $terrain = $partie->getTerrain();
            if ($carte !== null && count($terrain) <= 5) {
                //je considére que je suis j1.

                $main = $partie->getMainJ1();
                $terrain = $partie->getTerrain();
                $index = array_search($carte->getId(), $main);
                unset($main[$index]); // on retire du terrain

                // Ajouter au terrain
                $terrain[] = $carte->getId(); //piocher et mettre sur le terrain

                $partie->setMainJ1($main);
                $partie->setTerrain($terrain);

                $entityManager->flush();

                return $this->json(['cartemain' => $carte->getJson(), 'main' => $main, 'terrain' => $terrain, 'count' => count($terrain)], 200);
            } else {
                return $this->json('Erreur action vendre ', 500);
            }

        }
    }

 /**
     * @Route("/jouer-action/troc/{partie}", name="jouer_action_troc")
     */
    public function jouerActionTroc(
        EntityManagerInterface $entityManager,
        CarteRepository $carteRepository,
        Request $request,
        Partie $partie
    ) {

        $idcarteMain = $request->request->get('main');
        $idcarteTerrain = $request->request->get('terrain');

        if ($idcarteMain !== null) {

            $carteMain = $carteRepository->find($idcarteMain[0]);
            $carteTerrain = $carteRepository->find($idcarteTerrain[0]);
            $terrain = $partie->getTerrain();

            if ($carteMain !== null && count($terrain) <= 6) {
                //je considére que je suis j1.

                $main = $partie->getMainJ1();
                $terrain = $partie->getTerrain();

                // Retirer de la main & ID de la carte retirée
                for ($i = 0; $i < count($idcarteMain); $i++) {
                $index = array_search($idcarteMain[$i], $main);
                unset($main[$index]); 
                }
                
                // Retirer du terrain & ID de la carte retirée
                for ($i = 0; $i < count($idcarteTerrain); $i++) {
                $index = array_search($idcarteTerrain[$i], $terrain);
                unset($terrain[$index]); 
                }
               
                // Ajoutes les cartes 
                for ($i = 0; $i < count($idcarteMain); $i++) {
                $terrain[] = $idcarteMain[$i];
                }
                
                for ($i = 0; $i < count($idcarteTerrain); $i++) {
                $main[] = $idcarteTerrain[$i];
                }

                
                // Appliquer les changements
                $partie->setMainJ1($main);
                $partie->setTerrain($terrain);

                $entityManager->flush();

                return $this->json([ 'main' => $main, 'terrain' => $terrain, 'cartemain' => $carteMain->getJson() , 'carteterrain' => $carteTerrain->getJson() ], 200);
            } else {
                return $this->json('Erreur action vendre ', 500);
            }

        }
    }




    /**
     * @Route("/jouer-action/suivant/{partie}", name="jouer_action_suivant")
     */
    public function jouerActionSuivant(EntityManagerInterface $entityManager,
        Partie $partie) {
        $partie->setStatus('2'); //en considérant que je suis J1 ... a calculer.
        $entityManager->flush();
        return $this->json('Joueur-suivant', 200);
    }

    /**
     * @Route("/liste-partie", name="partie_liste")
     */
    public function listePartie()
    {

    }
}
