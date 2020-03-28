<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\SpeciesRepository")
 */
class Species
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
    private $speciesname;

    public function getId(): ?int
    {
        return $this->id;
    }


    public function getSpeciesname(): ?string
    {
        return $this->speciesname;
    }

    public function setSpeciesname(string $speciesname): self
    {
        $this->speciesname = $speciesname;

        return $this;
    }
}
