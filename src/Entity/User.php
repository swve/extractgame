<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Security\Core\User\UserInterface;

/**
 * @ORM\Entity(repositoryClass="App\Repository\UserRepository")
 */
class User implements UserInterface
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $username;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $email;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $password;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $avatar_img;

    /**
     * @ORM\Column(type="array", nullable=true)
     */
    private $role = [];

    /**
     * @ORM\Column(type="integer", nullable=true)
     */
    private $games_played;

    /**
     * @ORM\Column(type="integer", nullable=true)
     */
    private $games_won;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getUsername(): ?string
    {
        return $this->username;
    }

    public function setUsername(string $username): self
    {
        $this->username = $username;

        return $this;
    }

    public function getEmail(): ?string
    {
        return $this->email;
    }

    public function setEmail(string $email): self
    {
        $this->email = $email;

        return $this;
    }

    public function getPassword(): ?string
    {
        return $this->password;
    }

    public function setPassword(string $password): self
    {
        $this->password = $password;

        return $this;
    }

    public function getAvatarImg(): ?string
    {
        return $this->avatar_img;
    }

    public function setAvatarImg(string $avatar_img): self
    {
        $this->avatar_img = $avatar_img;

        return $this;
    }

    public function getRole(): ?array
    {
        return $this->role;
    }

    public function setRole(?array $role): self
    {
        $this->role = $role;

        return $this;
    }

    public function getGamesPlayed(): ?int
    {
        return $this->games_played;
    }

    public function setGamesPlayed(?int $games_played): self
    {
        $this->games_played = $games_played;

        return $this;
    }

    public function getGamesWon(): ?int
    {
        return $this->games_won;
    }

    public function setGamesWon(?int $games_won): self
    {
        $this->games_won = $games_won;

        return $this;
    }

    public function getRoles(){
        return ['ROLE_USER'];
    }
    public function getSalt(){}
    public function eraseCredentials(){}

}
