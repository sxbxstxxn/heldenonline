<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\ProfessionRepository")
 */
class Profession
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
    private $professionname;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getProfessionname(): ?string
    {
        return $this->professionname;
    }

    public function setProfessionname(string $professionname): self
    {
        $this->professionname = $professionname;

        return $this;
    }
}
