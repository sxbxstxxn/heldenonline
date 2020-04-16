<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\GeneralspecialskillRepository")
 */
class Generalspecialskill
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
    private $skillname;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getSkillname(): ?string
    {
        return $this->skillname;
    }

    public function setSkillname(string $skillname): self
    {
        $this->skillname = $skillname;

        return $this;
    }
}
