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

    /**
     * @ORM\Column(type="integer")
     */
    private $attributeMu;

    /**
     * @ORM\Column(type="integer")
     */
    private $attributeKl;

    /**
     * @ORM\Column(type="integer")
     */
    private $attributeIn;

    /**
     * @ORM\Column(type="integer")
     */
    private $attributeCh;

    /**
     * @ORM\Column(type="integer")
     */
    private $attributeFf;

    /**
     * @ORM\Column(type="integer")
     */
    private $attributeGe;

    /**
     * @ORM\Column(type="integer")
     */
    private $attributeKo;

    /**
     * @ORM\Column(type="integer")
     */
    private $attributeKk;
    

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

    public function getAttributeMu(): ?int
    {
        return $this->attributeMu;
    }

    public function setAttributeMu(int $attributeMu): self
    {
        $this->attributeMu = $attributeMu;

        return $this;
    }

    public function getAttributeKl(): ?int
    {
        return $this->attributeKl;
    }

    public function setAttributeKl(int $attributeKl): self
    {
        $this->attributeKl = $attributeKl;

        return $this;
    }

    public function getAttributeIn(): ?int
    {
        return $this->attributeIn;
    }

    public function setAttributeIn(int $attributeIn): self
    {
        $this->attributeIn = $attributeIn;

        return $this;
    }

    public function getAttributeCh(): ?int
    {
        return $this->attributeCh;
    }

    public function setAttributeCh(int $attributeCh): self
    {
        $this->attributeCh = $attributeCh;

        return $this;
    }

    public function getAttributeFf(): ?int
    {
        return $this->attributeFf;
    }

    public function setAttributeFf(int $attributeFf): self
    {
        $this->attributeFf = $attributeFf;

        return $this;
    }

    public function getAttributeGe(): ?int
    {
        return $this->attributeGe;
    }

    public function setAttributeGe(int $attributeGe): self
    {
        $this->attributeGe = $attributeGe;

        return $this;
    }

    public function getAttributeKo(): ?int
    {
        return $this->attributeKo;
    }

    public function setAttributeKo(int $attributeKo): self
    {
        $this->attributeKo = $attributeKo;

        return $this;
    }

    public function getAttributeKk(): ?int
    {
        return $this->attributeKk;
    }

    public function setAttributeKk(int $attributeKk): self
    {
        $this->attributeKk = $attributeKk;

        return $this;
    }

}
