<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\AdvantageRepository")
 */
class Advantage
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
    private $advantagename;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getAdvantagename(): ?string
    {
        return $this->advantagename;
    }

    public function setAdvantagename(string $advantagename): self
    {
        $this->advantagename = $advantagename;

        return $this;
    }
}
