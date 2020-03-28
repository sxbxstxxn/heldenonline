<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\CultureRepository")
 */
class Culture
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
    private $culturename;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getCulturename(): ?string
    {
        return $this->culturename;
    }

    public function setCulturename(string $culturename): self
    {
        $this->culturename = $culturename;

        return $this;
    }
}
