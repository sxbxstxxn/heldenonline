<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;


/**
 * @ORM\Entity(repositoryClass="App\Repository\CharacterRepository")
 * @ORM\Table(name="chars")
 */
class Character
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=45)
     */
    private $charname;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\User", inversedBy="characters")
     * @ORM\JoinColumn(nullable=false)
     */
    private $user;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getCharname(): ?string
    {
        return $this->charname;
    }

    public function setCharname(string $charname): self
    {
        $this->charname = $charname;

        return $this;
    }

    public function getUser(): ?User
    {
        return $this->user;
    }

    public function setUser(?User $user): self
    {
        $this->user = $user;

        return $this;
    }
}