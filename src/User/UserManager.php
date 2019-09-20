<?php


namespace App\User;


use App\Entity\User;
use App\Repository\UserRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;

class UserManager
{
    private $userPasswordEncoder;
    private $entityManager;

    public function __construct(UserPasswordEncoderInterface $userPasswordEncoder, EntityManagerInterface $entityManager, UserRepository $userrepository)
    {
        $this->userPasswordEncoder = $userPasswordEncoder;
        $this->entityManager = $entityManager;
        $this->userRepository = $userrepository;
    }

    public function register(User $user, $picture = NULL, $hashstring): void
    {
        $plainPassword = $user->getPassword();
        $encodedPassword = $this->userPasswordEncoder->encodePassword($user, $plainPassword);
        $user->setPassword($encodedPassword);

        //PICTURE
        $user->setPicture($picture);

        //TIMESTAMP OF REGISTRATION
        $user->setRegistrationDate(time());

        $user->setRegistrationHash($hashstring);
        $user->setRegistrationConfirmed(0);

        $this->entityManager->persist($user);
        $this->entityManager->flush();
    }

    public function confirm($username): void
    {
        $user = $this->userRepository->loadUserByUsername($username);

        $user->setRegistrationConfirmed(1);
        $user->setRegistrationHash(NULL);
        $this->entityManager->persist($user);
        $this->entityManager->flush();
    }

    public function getHash($username)
    {
        $user = $this->userRepository->loadUserByUsername($username);
        return $user->getRegistrationHash();
    }

    public function delete($username): void
    {
        $user = $this->userRepository->loadUserByUsername($username);
        $this->entityManager->remove($user);
        $this->entityManager->flush();
    }
}