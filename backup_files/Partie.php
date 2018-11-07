<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\PartieRepository")
 */
class Partie
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="datetime")
     */
    private $date;

    /**
     * @ORM\Column(type="string", length=1)
     */
    private $status;

    /**
     * @ORM\Column(type="text")
     */
    private $terrain;

    /**
     * @ORM\Column(type="text")
     */
    private $pioche;

    /**
     * @ORM\Column(type="integer")
     */
    private $jeton_chameaux;

    /**
     * @ORM\Column(type="boolean")
     */
    private $defausse;

    /**
     * @ORM\Column(type="text")
     */
    private $main_j1;

    /**
     * @ORM\Column(type="text")
     */
    private $main_j2;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\User", inversedBy="parties")
     */
    private $joueur1;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\User", inversedBy="parties")
     */
    private $joueur2;

    /**
     * @ORM\Column(type="text")
     */
    private $chameaux_j1;

    /**
     * @ORM\Column(type="text")
     */
    private $chameaux_j2;

    /**
     * @ORM\Column(type="text")
     */
    private $jetons_j1;

    /**
     * @ORM\Column(type="text")
     */
    private $jetons_j2;

    /**
     * @ORM\Column(type="integer")
     */
    private $nb_manche;

    /**
     * @ORM\Column(type="integer")
     */
    private $point_j1;

    /**
     * @ORM\Column(type="integer")
     */
    private $point_j2;

    /**
     * @ORM\Column(type="text")
     */
    private $jetons_terrain;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getDate(): ?\DateTimeInterface
    {
        return $this->date;
    }

    public function setDate(\DateTimeInterface $date): self
    {
        $this->date = $date;

        return $this;
    }

    public function getStatus(): ?string
    {
        return $this->status;
    }

    public function setStatus(string $status): self
    {
        $this->status = $status;

        return $this;
    }

    public function getTerrain()
    {
        return $this->terrain;
    }

    public function setTerrain($terrain): self
    {
        json_encode($this->terrain = $terrain);

        return $this;
    }

    public function getPioche()
    {
        return json_decode($this->pioche);
    }

    public function setPioche($pioche): self
    {
        json_encode($this->pioche = $pioche);

        return $this;
    }

    public function getJetonChameaux()
    {
        return $this->jeton_chameaux;
    }

    public function setJetonChameaux($jeton_chameaux): self
    {
        $this->jeton_chameaux = $jeton_chameaux;

        return $this;
    }

    public function getDefausse(): ?bool
    {
        return $this->defausse;
    }

    public function setDefausse(bool $defausse): self
    {
        $this->defausse = $defausse;

        return $this;
    }

    public function getMainJ1()
    {
        return json_decode($this->main_j1);
    }

    public function setMainJ1($main_j1): self
    {
        json_encode($this->main_j1 = $main_j1);

        return $this;
    }

    public function getMainJ2()
    {
        return json_decode($this->main_j2);
    }

    public function setMainJ2($main_j2): self
    {
        json_encode($this->main_j2 = $main_j2);

        return $this;
    }

    public function getJoueur1(): ?User
    {
        return $this->joueur1;
    }

    public function setJoueur1(?User $joueur1): self
    {
        $this->joueur1 = $joueur1;

        return $this;
    }

    public function getJoueur2(): ?User
    {
        return $this->joueur2;
    }

    public function setJoueur2(?User $joueur2): self
    {
        $this->joueur2 = $joueur2;

        return $this;
    }

    public function getChameauxJ1()
    {
        return $this->chameaux_j1;
    }

    public function setChameauxJ1($chameaux_j1): self
    {
        json_encode($this->chameaux_j1 = $chameaux_j1);

        return $this;
    }

    public function getChameauxJ2()
    {
        return json_decode($this->chameaux_j2);
    }

    public function setChameauxJ2($chameaux_j2): self
    {
        json_encode($this->chameaux_j2 = $chameaux_j2);

        return $this;
    }

    public function getJetonsJ1()
    {
        return json_decode($this->jetons_j1);
    }

    public function setJetonsJ1($jetons_j1): self
    {
        json_encode($this->jetons_j1 = $jetons_j1);

        return $this;
    }

    public function getJetonsJ2()
    {
        return json_decode($this->jetons_j2);
    }

    public function setJetonsJ2($jetons_j2): self
    {
        json_encode($this->jetons_j2 = $jetons_j2);

        return $this;
    }

    public function getNbManche(): ?int
    {
        return $this->nb_manche;
    }

    public function setNbManche(int $nb_manche): self
    {
        $this->nb_manche = $nb_manche;

        return $this;
    }

    public function getPointJ1(): ?int
    {
        return $this->point_j1;
    }

    public function setPointJ1(int $point_j1): self
    {
        $this->point_j1 = $point_j1;

        return $this;
    }

    public function getPointJ2(): ?int
    {
        return $this->point_j2;
    }

    public function setPointJ2(int $point_j2): self
    {
        $this->point_j2 = $point_j2;

        return $this;
    }

    public function getJetonsTerrain()
    {
        return json_decode($this->jetons_terrain);
    }

    public function setJetonsTerrain($jetons_terrain): self
    {
        json_encode($this->jetons_terrain = $jetons_terrain);

        return $this;
    }
}
