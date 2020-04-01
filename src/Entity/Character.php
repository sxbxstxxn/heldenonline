<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;


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
     * @Assert\NotBlank
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

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Species", inversedBy="speciesname")
     * @ORM\JoinColumn(nullable=false)
     */
    private $species;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Culture", inversedBy="speciesname")
     * @ORM\JoinColumn(nullable=false)
     */
    private $culture;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Profession", inversedBy="professionname")
     * @ORM\JoinColumn(nullable=false)
     */
    private $profession;

    /**
     * @ORM\Column(type="string", length=11)
     */
    private $gender;

    /**
     * @ORM\Column(type="string", length=45, nullable=true)
     */
    private $birthplace;

    /**
     * @ORM\Column(type="string", length=45, nullable=true)
     */
    private $birthdate;

    /**
     * @ORM\Column(type="integer", nullable=true)
     */
    private $age;

    /**
     * @ORM\Column(type="string", length=45, nullable=true)
     */
    private $size;

    /**
     * @ORM\Column(type="string", length=45, nullable=true)
     */
    private $weight;

    /**
     * @ORM\Column(type="string", length=45, nullable=true)
     */
    private $haircolor;

    /**
     * @ORM\Column(type="string", length=45, nullable=true)
     */
    private $eyecolor;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $title;

    /**
     * @ORM\Column(type="integer")
     */
    private $socialstatus;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $family;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $characteristics;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $further;


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

    public function getSpecies(): ?Species
    {
        return $this->species;
    }

    public function setSpecies(?Species $species): self
    {
        $this->species = $species;

        return $this;
    }

    public function getCulture(): ?Culture
    {
        return $this->culture;
    }

    public function setCulture(?Culture $culture): self
    {
        $this->culture = $culture;

        return $this;
    }

    public function getProfession(): ?Profession
    {
        return $this->profession;
    }

    public function setProfession(?Profession $profession): self
    {
        $this->profession = $profession;

        return $this;
    }

    public function getGender(): ?string
    {
        return $this->gender;
    }

    public function setGender(string $gender): self
    {
        $this->gender = $gender;

        return $this;
    }

    public function getBirthplace(): ?string
    {
        return $this->birthplace;
    }

    public function setBirthplace(?string $birthplace): self
    {
        $this->birthplace = $birthplace;

        return $this;
    }

    public function getBirthdate(): ?string
    {
        return $this->birthdate;
    }

    public function setBirthdate(?string $birthdate): self
    {
        $this->birthdate = $birthdate;

        return $this;
    }

    public function getAge(): ?int
    {
        return $this->age;
    }

    public function setAge(int $age): self
    {
        $this->age = $age;

        return $this;
    }

    public function getSize(): ?string
    {
        return $this->size;
    }

    public function setSize(?string $size): self
    {
        $this->size = $size;

        return $this;
    }

    public function getWeight(): ?string
    {
        return $this->weight;
    }

    public function setWeight(?string $weight): self
    {
        $this->weight = $weight;

        return $this;
    }

    public function getHaircolor(): ?string
    {
        return $this->haircolor;
    }

    public function setHaircolor(?string $haircolor): self
    {
        $this->haircolor = $haircolor;

        return $this;
    }

    public function getEyecolor(): ?string
    {
        return $this->eyecolor;
    }

    public function setEyecolor(?string $eyecolor): self
    {
        $this->eyecolor = $eyecolor;

        return $this;
    }

    public function getTitle(): ?string
    {
        return $this->title;
    }

    public function setTitle(?string $title): self
    {
        $this->title = $title;

        return $this;
    }

    public function getSocialstatus(): ?int
    {
        return $this->socialstatus;
    }

    public function setSocialstatus(int $socialstatus): self
    {
        $this->socialstatus = $socialstatus;

        return $this;
    }

    public function getFamily(): ?string
    {
        return $this->family;
    }

    public function setFamily(?string $family): self
    {
        $this->family = $family;

        return $this;
    }

    public function getCharacteristics(): ?string
    {
        return $this->characteristics;
    }

    public function setCharacteristics(?string $characteristics): self
    {
        $this->characteristics = $characteristics;

        return $this;
    }

    public function getFurther(): ?string
    {
        return $this->further;
    }

    public function setFurther(?string $further): self
    {
        $this->further = $further;

        return $this;
    }
}
