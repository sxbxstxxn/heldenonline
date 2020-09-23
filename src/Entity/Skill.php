<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\SkillRepository")
 */
class Skill
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
    private $name;

    /**
     * @ORM\Column(type="string", length=45)
     */
    private $proof;

    /**
     * @ORM\Column(type="string", length=45)
     */
    private $be;

    /**
     * @ORM\Column(type="string", length=45)
     */
    private $sf;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Skillarea", inversedBy="skills")
     * @ORM\JoinColumn(nullable=false)
     */
    private $skillarea;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\CharacterHasSkills", mappedBy="skillid", orphanRemoval=true)
     */
    private $hasCharacters;


    public function __construct()
    {
        $this->characterSkills = new ArrayCollection();
        $this->hasCharacters = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getName(): ?string
    {
        return $this->name;
    }

    public function setName(string $name): self
    {
        $this->name = $name;

        return $this;
    }

    public function getProof(): ?string
    {
        return $this->proof;
    }

    public function setProof(string $proof): self
    {
        $this->proof = $proof;

        return $this;
    }

    public function getBe(): ?string
    {
        return $this->be;
    }

    public function setBe(string $be): self
    {
        $this->be = $be;

        return $this;
    }

    public function getSf(): ?string
    {
        return $this->sf;
    }

    public function setSf(string $sf): self
    {
        $this->sf = $sf;

        return $this;
    }

    public function getSkillarea(): ?Skillarea
    {
        return $this->skillarea;
    }

    public function setSkillarea(?Skillarea $skillarea): self
    {
        $this->skillarea = $skillarea;

        return $this;
    }

    /**
     * @return Collection|CharacterHasSkills[]
     */
    public function getHasCharacters(): Collection
    {
        return $this->hasCharacters;
    }

    public function addHasCharacter(CharacterHasSkills $hasCharacter): self
    {
        if (!$this->hasCharacters->contains($hasCharacter)) {
            $this->hasCharacters[] = $hasCharacter;
            $hasCharacter->setSkillid($this);
        }

        return $this;
    }

    public function removeHasCharacter(CharacterHasSkills $hasCharacter): self
    {
        if ($this->hasCharacters->contains($hasCharacter)) {
            $this->hasCharacters->removeElement($hasCharacter);
            // set the owning side to null (unless already changed)
            if ($hasCharacter->getSkillid() === $this) {
                $hasCharacter->setSkillid(null);
            }
        }

        return $this;
    }

}
