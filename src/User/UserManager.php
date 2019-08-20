<?php


namespace App\User;


use App\Entity\User;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;

class UserManager
{
    private $userPasswordEncoder;
    private $entityManager;

    public function __construct(UserPasswordEncoderInterface $userPasswordEncoder, EntityManagerInterface $entityManager)
    {
        $this->userPasswordEncoder = $userPasswordEncoder;
        $this->entityManager = $entityManager;
    }

    public function register(User $user): void
    {
        $plainPassword = $user->getPassword();
        $encodedPassword = $this->userPasswordEncoder->encodePassword($user, $plainPassword);
        $user->setPassword($encodedPassword);

        $this->entityManager->persist($user);
        $this->entityManager->flush();
    }
}