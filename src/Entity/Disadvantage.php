<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\DisadvantageRepository")
 */
class Disadvantage
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
    private $disadvantagename;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getDisadvantagename(): ?string
    {
        return $this->disadvantagename;
    }

    public function setDisadvantagename(string $disadvantagename): self
    {
        $this->disadvantagename = $disadvantagename;

        return $this;
    }
}
