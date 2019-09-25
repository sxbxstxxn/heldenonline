<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;
use Symfony\Component\Security\Core\User\UserInterface;
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
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=180, unique=true)
     * @Assert\NotBlank
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
     */
    private $email = '';

    /**
     * @ORM\Column(type="date", nullable=true)
     */
    private $dateofbirth;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $picture;

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
     */
    protected $lastActivityAt;

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


}
