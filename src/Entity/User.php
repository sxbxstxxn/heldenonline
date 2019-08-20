<?php


namespace App\Entity;


use Doctrine\ORM\Mapping as ORM;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;
use Symfony\Component\Security\Core\User\UserInterface;

/**
 * @ORM\Entity
 * @ORM\Table(name="users")
 *
 * @UniqueEntity("email")
 * @UniqueEntity("username")
 */
class User implements UserInterface
{
    /**
     * @ORM\Column(type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     * @Groups({"profile","list"})
     */
    private $id;

    /**
     * @ORM\Column(unique=true)
     * @Assert\NotBlank
     * @Groups({"profile","list"})
     */
    private $username = '';

    /**
     * @ORM\Column
     * @Assert\NotBlank
     * @Groups("profile")
     */
    private $fullname = '';

    /**
     * @ORM\Column(unique=true)
     * @Assert\Email
     * @Assert\NotBlank
     * @Groups("profile")
     */
    private $email = '';

    /**
     * @ORM\Column(type="date")
     * @Assert\LessThanOrEqual("-18 years")
     * @Groups("profile")
     */
    private $dateOfBirth;

    /**
     * @ORM\Column
     * @Assert\Length(min=4)
     * @Assert\NotBlank
     */
    private $password = '';

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getUsername(): string
    {
        return $this->username;
    }

    public function setUsername(string $username): void
    {
        $this->username = $username;
    }

    public function getFullname(): string
    {
        return $this->fullname;
    }

    public function setFullname(string $fullname): void
    {
        $this->fullname = $fullname;
    }

    public function getEmail(): string
    {
        return $this->email;
    }

    public function setEmail(string $email): void
    {
        $this->email = $email;
    }

    public function getDateOfBirth(): ?\DateTimeImmutable
    {
        if ($this->dateOfBirth instanceof \DateTime) {
            $this->dateOfBirth = \DateTimeImmutable::createFromMutable($this->dateOfBirth);
        }

        return $this->dateOfBirth;
    }

    public function setDateOfBirth(\DateTimeInterface $dateOfBirth): void
    {
        $this->dateOfBirth = $dateOfBirth;
    }

    public function getPassword(): ?string
    {
        return $this->password;
    }

    public function setPassword($password): void
    {
        $this->password = $password;
    }

    public function getRoles(): array
    {
        return ['ROLE_USER'];
    }

    public function getSalt(): void
    {
    }

    public function eraseCredentials(): void
    {
    }
}