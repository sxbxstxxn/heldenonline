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
     * @ORM\Column(type="string", length=45, nullable=true)
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

    /**
     * @ORM\Column(type="integer")
     */
    private $aptotal;

    /**
     * @ORM\Column(type="integer")
     */
    private $apavailable;

    /**
     * @ORM\Column(type="integer")
     */
    private $apspent;

    /**
     * @ORM\Column(type="string", length=45)
     */
    private $experiencelevel;

    /**
     * @ORM\Column(type="integer", nullable=true)
     */
    private $lifeenergy;

    /**
     * @ORM\Column(type="integer", nullable=true)
     */
    private $lifeenergypurchase;

    /**
     * @ORM\Column(type="integer", nullable=true)
     */
    private $lifeenergymax;

    /**
     * @ORM\Column(type="integer", nullable=true)
     */
    private $lifeenergybonus;

    /**
     * @ORM\Column(type="integer", nullable=true)
     */
    private $astralenergy;

    /**
     * @ORM\Column(type="integer", nullable=true)
     */
    private $astralenergybonus;

    /**
     * @ORM\Column(type="integer", nullable=true)
     */
    private $astralenergypurchase;

    /**
     * @ORM\Column(type="integer", nullable=true)
     */
    private $astralenergymax;

    /**
     * @ORM\Column(type="integer", nullable=true)
     */
    private $karmaenergy;

    /**
     * @ORM\Column(type="integer", nullable=true)
     */
    private $karmaenergybonus;

    /**
     * @ORM\Column(type="integer", nullable=true)
     */
    private $karmaenergypurchase;

    /**
     * @ORM\Column(type="integer", nullable=true)
     */
    private $karmaenergymax;

    /**
     * @ORM\Column(type="integer", nullable=true)
     */
    private $soulpower;

    /**
     * @ORM\Column(type="integer", nullable=true)
     */
    private $toughness;

    /**
     * @ORM\Column(type="integer", nullable=true)
     */
    private $dodge;

    /**
     * @ORM\Column(type="integer", nullable=true)
     */
    private $initiative;

    /**
     * @ORM\Column(type="integer", nullable=true)
     */
    private $speed;

    /**
     * @ORM\Column(type="integer", nullable=true)
     */
    private $fatepoints;

    /**
     * @ORM\Column(type="integer", nullable=true)
     */
    private $soulpowerbonus;

    /**
     * @ORM\Column(type="integer", nullable=true)
     */
    private $soulpowermax;

    /**
     * @ORM\Column(type="integer", nullable=true)
     */
    private $toughnessbonus;

    /**
     * @ORM\Column(type="integer", nullable=true)
     */
    private $toughnessmax;

    /**
     * @ORM\Column(type="integer", nullable=true)
     */
    private $dodgebonus;

    /**
     * @ORM\Column(type="integer", nullable=true)
     */
    private $dodgemax;

    /**
     * @ORM\Column(type="integer", nullable=true)
     */
    private $initiativebonus;

    /**
     * @ORM\Column(type="integer", nullable=true)
     */
    private $initiativemax;

    /**
     * @ORM\Column(type="integer", nullable=true)
     */
    private $speedbonus;

    /**
     * @ORM\Column(type="integer", nullable=true)
     */
    private $speedmax;

    /**
     * @ORM\Column(type="integer", nullable=true)
     */
    private $fatepointsbonus;

    /**
     * @ORM\Column(type="integer", nullable=true)
     */
    private $fatepointsmax;

    /**
     * @ORM\Column(type="integer", nullable=true)
     */
    private $fatepointscurrent;


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

    public function getSocialstatus(): ?string
    {
        return $this->socialstatus;
    }

    public function setSocialstatus(?string $socialstatus): self
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

    public function getAptotal(): ?int
    {
        return $this->aptotal;
    }

    public function setAptotal(int $aptotal): self
    {
        $this->aptotal = $aptotal;

        return $this;
    }

    public function getApavailable(): ?int
    {
        return $this->apavailable;
    }

    public function setApavailable(int $apavailable): self
    {
        $this->apavailable = $apavailable;

        return $this;
    }

    public function getApspent(): ?int
    {
        return $this->apspent;
    }

    public function setApspent(int $apspent): self
    {
        $this->apspent = $apspent;

        return $this;
    }

    public function getExperiencelevel(): ?string
    {
        return $this->experiencelevel;
    }

    public function setExperiencelevel(string $experiencelevel): self
    {
        $this->experiencelevel = $experiencelevel;

        return $this;
    }

    public function getLifeenergy(): ?int
    {
        return $this->lifeenergy;
    }

    public function setLifeenergy(?int $lifeenergy): self
    {
        $this->lifeenergy = $lifeenergy;

        return $this;
    }

    public function getLifeenergypurchase(): ?int
    {
        return $this->lifeenergypurchase;
    }

    public function setLifeenergypurchase(?int $lifeenergypurchase): self
    {
        $this->lifeenergypurchase = $lifeenergypurchase;

        return $this;
    }

    public function getLifeenergymax(): ?int
    {
        return $this->lifeenergymax;
    }

    public function setLifeenergymax(?int $lifeenergymax): self
    {
        $this->lifeenergymax = $lifeenergymax;

        return $this;
    }

    public function getLifeenergybonus(): ?int
    {
        return $this->lifeenergybonus;
    }

    public function setLifeenergybonus(?int $lifeenergybonus): self
    {
        $this->lifeenergybonus = $lifeenergybonus;

        return $this;
    }

    public function getAstralenergy(): ?int
    {
        return $this->astralenergy;
    }

    public function setAstralenergy(?int $astralenergy): self
    {
        $this->astralenergy = $astralenergy;

        return $this;
    }

    public function getAstralenergybonus(): ?int
    {
        return $this->astralenergybonus;
    }

    public function setAstralenergybonus(?int $astralenergybonus): self
    {
        $this->astralenergybonus = $astralenergybonus;

        return $this;
    }

    public function getAstralenergypurchase(): ?int
    {
        return $this->astralenergypurchase;
    }

    public function setAstralenergypurchase(?int $astralenergypurchase): self
    {
        $this->astralenergypurchase = $astralenergypurchase;

        return $this;
    }

    public function getAstralenergymax(): ?int
    {
        return $this->astralenergymax;
    }

    public function setAstralenergymax(?int $astralenergymax): self
    {
        $this->astralenergymax = $astralenergymax;

        return $this;
    }

    public function getKarmaenergy(): ?int
    {
        return $this->karmaenergy;
    }

    public function setKarmaenergy(?int $karmaenergy): self
    {
        $this->karmaenergy = $karmaenergy;

        return $this;
    }

    public function getKarmaenergybonus(): ?int
    {
        return $this->karmaenergybonus;
    }

    public function setKarmaenergybonus(?int $karmaenergybonus): self
    {
        $this->karmaenergybonus = $karmaenergybonus;

        return $this;
    }

    public function getKarmaenergypurchase(): ?int
    {
        return $this->karmaenergypurchase;
    }

    public function setKarmaenergypurchase(?int $karmaenergypurchase): self
    {
        $this->karmaenergypurchase = $karmaenergypurchase;

        return $this;
    }

    public function getKarmaenergymax(): ?int
    {
        return $this->karmaenergymax;
    }

    public function setKarmaenergymax(?int $karmaenergymax): self
    {
        $this->karmaenergymax = $karmaenergymax;

        return $this;
    }

    public function getSoulpower(): ?int
    {
        return $this->soulpower;
    }

    public function setSoulpower(?int $soulpower): self
    {
        $this->soulpower = $soulpower;

        return $this;
    }

    public function getToughness(): ?int
    {
        return $this->toughness;
    }

    public function setToughness(?int $toughness): self
    {
        $this->toughness = $toughness;

        return $this;
    }

    public function getDodge(): ?int
    {
        return $this->dodge;
    }

    public function setDodge(?int $dodge): self
    {
        $this->dodge = $dodge;

        return $this;
    }

    public function getInitiative(): ?int
    {
        return $this->initiative;
    }

    public function setInitiative(?int $initiative): self
    {
        $this->initiative = $initiative;

        return $this;
    }

    public function getSpeed(): ?int
    {
        return $this->speed;
    }

    public function setSpeed(?int $speed): self
    {
        $this->speed = $speed;

        return $this;
    }

    public function getFatepoints(): ?int
    {
        return $this->fatepoints;
    }

    public function setFatepoints(?int $fatepoints): self
    {
        $this->fatepoints = $fatepoints;

        return $this;
    }

    public function getSoulpowerbonus(): ?int
    {
        return $this->soulpowerbonus;
    }

    public function setSoulpowerbonus(?int $soulpowerbonus): self
    {
        $this->soulpowerbonus = $soulpowerbonus;

        return $this;
    }

    public function getSoulpowermax(): ?int
    {
        return $this->soulpowermax;
    }

    public function setSoulpowermax(?int $soulpowermax): self
    {
        $this->soulpowermax = $soulpowermax;

        return $this;
    }

    public function getToughnessbonus(): ?int
    {
        return $this->toughnessbonus;
    }

    public function setToughnessbonus(?int $toughnessbonus): self
    {
        $this->toughnessbonus = $toughnessbonus;

        return $this;
    }

    public function getToughnessmax(): ?int
    {
        return $this->toughnessmax;
    }

    public function setToughnessmax(?int $toughnessmax): self
    {
        $this->toughnessmax = $toughnessmax;

        return $this;
    }

    public function getDodgebonus(): ?int
    {
        return $this->dodgebonus;
    }

    public function setDodgebonus(?int $dodgebonus): self
    {
        $this->dodgebonus = $dodgebonus;

        return $this;
    }

    public function getDodgemax(): ?int
    {
        return $this->dodgemax;
    }

    public function setDodgemax(?int $dodgemax): self
    {
        $this->dodgemax = $dodgemax;

        return $this;
    }

    public function getInitiativebonus(): ?int
    {
        return $this->initiativebonus;
    }

    public function setInitiativebonus(?int $initiativebonus): self
    {
        $this->initiativebonus = $initiativebonus;

        return $this;
    }

    public function getInitiativemax(): ?int
    {
        return $this->initiativemax;
    }

    public function setInitiativemax(?int $initiativemax): self
    {
        $this->initiativemax = $initiativemax;

        return $this;
    }

    public function getSpeedbonus(): ?int
    {
        return $this->speedbonus;
    }

    public function setSpeedbonus(?int $speedbonus): self
    {
        $this->speedbonus = $speedbonus;

        return $this;
    }

    public function getSpeedmax(): ?int
    {
        return $this->speedmax;
    }

    public function setSpeedmax(?int $speedmax): self
    {
        $this->speedmax = $speedmax;

        return $this;
    }

    public function getFatepointsbonus(): ?int
    {
        return $this->fatepointsbonus;
    }

    public function setFatepointsbonus(?int $fatepointsbonus): self
    {
        $this->fatepointsbonus = $fatepointsbonus;

        return $this;
    }

    public function getFatepointsmax(): ?int
    {
        return $this->fatepointsmax;
    }

    public function setFatepointsmax(?int $fatepointsmax): self
    {
        $this->fatepointsmax = $fatepointsmax;

        return $this;
    }

    public function getFatepointscurrent(): ?int
    {
        return $this->fatepointscurrent;
    }

    public function setFatepointscurrent(?int $fatepointscurrent): self
    {
        $this->fatepointscurrent = $fatepointscurrent;

        return $this;
    }
}
