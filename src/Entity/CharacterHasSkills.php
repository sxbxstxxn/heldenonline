<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\CharacterHasSkillsRepository")
 */
class CharacterHasSkills
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Character", inversedBy="hasSkills")
     * @ORM\JoinColumn(nullable=false)
     */
    private $charid;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Skill", inversedBy="hasCharacters")
     * @ORM\JoinColumn(nullable=false)
     */
    private $skillid;

    /**
     * @ORM\Column(type="integer", nullable=true)
     */
    private $value;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getCharid(): ?Character
    {
        return $this->charid;
    }

    public function setCharid(?Character $charid): self
    {
        $this->charid = $charid;

        return $this;
    }

    public function getSkillid(): ?Skill
    {
        return $this->skillid;
    }

    public function setSkillid(?Skill $skillid): self
    {
        $this->skillid = $skillid;

        return $this;
    }

    public function getValue(): ?int
    {
        return $this->value;
    }

    public function setValue(?int $value): self
    {
        $this->value = $value;

        return $this;
    }
}
