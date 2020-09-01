<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use phpDocumentor\Reflection\Types\Integer;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;
use Symfony\Component\Security\Core\User\UserInterface;
use Symfony\Component\Serializer\Annotation\Groups;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * @ORM\Entity(repositoryClass="App\Repository\UserRepository")
 * @ORM\Table(name="user")
 *
 * @UniqueEntity("username")
 * @UniqueEntity("email")
 */
class User implements UserInterface
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     * @Groups({"profile","list"})
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=180, unique=true)
     * @Assert\NotBlank
     * @Groups({"profile","list"})
     */
    private $username = '';

    /**
     * @ORM\Column
     * @Assert\Length(min=5)
     * @Assert\NotBlank
     */
    private $password = '';

    /**
     * @ORM\Column(type="string", length=255, unique=true)
     * @Assert\Email
     * @Assert\NotBlank
     * @Groups({"profile"})
     */
    private $email = '';

    /**
     * @ORM\Column(type="date", nullable=true)
     * @Groups({"profile","list"})
     */
    private $dateofbirth;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     * @Groups({"profile","list"})
     */
    private $picture;

    /**
     * @return int|null
     */
    public function getId(): ?int
    {
        return $this->id;
    }

    /**
     * @ORM\Column(type="integer")
     */
    private $registrationDate;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $registrationHash = '';

    /**
     * @ORM\Column(type="integer")
     */
    private $registrationConfirmed = 0;

    /**
     * @ORM\Column(name="last_activity_at", type="integer")
     * @Groups({"list"})
     */
    protected $lastActivityAt = 0;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\Character", mappedBy="user")
     */
    private $characters;

    public function __construct()
    {
        $this->characters = new ArrayCollection();
    }



    /**
     * A visual identifier that represents this user.
     *
     * @see UserInterface
     */
    public function getUsername(): string
    {
        return (string) $this->username;
    }

    public function setUsername(string $username): self
    {
        $this->username = $username;

        return $this;
    }

    /**
     * @see UserInterface
     */
    public function getRoles(): array
    {
        return ['ROLE_USER'];
    }


    /**
     * @see UserInterface
     */
    public function getPassword(): ?string
    {
        return $this->password;
    }

    public function setPassword(string $password): void
    {
        $this->password = $password;
    }

    /**
     * @see UserInterface
     */
    public function getSalt()
    {
        // not needed when using the "bcrypt" algorithm in security.yaml
    }

    /**
     * @see UserInterface
     */
    public function eraseCredentials()
    {
        // If you store any temporary, sensitive data on the user, clear it here
        // $this->plainPassword = null;
    }

    /**
     * @see UserInterface
     */
    public function getEmail(): ?string
    {
        return $this->email;
    }

    public function setEmail(string $email): self
    {
        $this->email = $email;

        return $this;
    }

    /**
     * @see UserInterface
     */
    public function getDateofbirth(): ?\DateTimeInterface
    {
        return $this->dateofbirth;
    }

    public function setDateofbirth(?\DateTimeInterface $dateofbirth): self
    {
        $this->dateofbirth = $dateofbirth;

        return $this;
    }

    /**
     * @see UserInterface
     */
    public function getPicture(): ?string
    {
        return $this->picture;
    }

    public function setPicture(?string $picture): self
    {
        $this->picture = $picture;

        return $this;
    }

    /**
     * @see UserInterface
     */
    public function getRegistrationDate(): ?int
    {
        return $this->registrationDate;
    }

    public function setRegistrationDate(?int $registrationDate): self
    {
        $this->registrationDate = $registrationDate;

        return $this;
    }

    /**
     * @see UserInterface
     */
    public function getRegistrationHash(): ?string
    {
        return $this->registrationHash;
    }

    public function setRegistrationHash(?string $registrationHash): self
    {
        $this->registrationHash = $registrationHash;

        return $this;
    }



    public function setRegistrationConfirmed(?int $registrationConfirmed): self
    {
        $this->registrationConfirmed = $registrationConfirmed;

        return $this;
    }

    public function isConfirmed(): ?bool
    {
        return $this->registrationConfirmed;
    }


    public function getLastActivityAt(): ?int
    {
        return $this->lastActivityAt;
    }

    public function setLastActivityAt(?int $lastActivityAt): self
    {
        $this->lastActivityAt = $lastActivityAt;

        return $this;
    }




    /**
     * @return Bool Whether the user is active or not
     */
    public function isActiveNow()
    {
        // Delay during wich the user will be considered as still active
        //$delay = new \DateTime('2 minutes ago');

        //return ( $this->getLastActivityAt() > $delay );
    }

    /**
     * @return Collection|Character[]
     *
     * @see UserInterface
     */
    public function getCharacters(): Collection
    {
        return $this->characters;
    }

    public function addCharacter(Character $character): self
    {
        if (!$this->characters->contains($character)) {
            $this->characters[] = $character;
            $character->setUser($this);
        }

        return $this;
    }

    public function removeCharacter(Character $character): self
    {
        if ($this->characters->contains($character)) {
            $this->characters->removeElement($character);
            // set the owning side to null (unless already changed)
            if ($character->getUser() === $this) {
                $character->setUser(null);
            }
        }

        return $this;
    }


}
