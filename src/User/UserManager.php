<?php


namespace App\User;


use App\Entity\User;
use App\Repository\UserRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;
use Symfony\Component\Serializer\SerializerInterface;


class UserManager
{
    private $userPasswordEncoder;
    private $entityManager;

    public function __construct(UserPasswordEncoderInterface $userPasswordEncoder, EntityManagerInterface $entityManager, UserRepository $userrepository, SerializerInterface $serializer)
    {
        $this->userPasswordEncoder = $userPasswordEncoder;
        $this->entityManager = $entityManager;
        $this->userRepository = $userrepository;
        $this->serializer = $serializer;
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

    public function setHash($username, $hash)
    {
        $user = $this->userRepository->loadUserByUsername($username);
        $user->setRegistrationHash($hash);
        $this->entityManager->persist($user);
        $this->entityManager->flush();
    }

    public function delete($username): void
    {
        $user = $this->userRepository->loadUserByUsername($username);
        $this->entityManager->remove($user);
        $this->entityManager->flush();
    }

    public function setLastActivity($username, $time)
    {
        $user = $this->userRepository->loadUserByUsername($username);
        $user->setLastActivityAt($time);
        $this->entityManager->persist($user);
        $this->entityManager->flush();
    }

    public function setNewPassword($user, $formPW)
    {
        //$plainPassword = $user->getPassword();
        $plainPassword = $formPW['password'];
        $encodedPassword = $this->userPasswordEncoder->encodePassword($user, $plainPassword);
        $user->setPassword($encodedPassword);

        $this->entityManager->persist($user);
        $this->entityManager->flush();
    }

    public function editUser(User $user, $formEdit, $picture = NULL)
    {
        //var_dump($formEdit);exit;
        //$user->setPicture = $formEdit['picture'];
        if (isset($picture)) {
            $user->setPicture($picture);
        }
        $user->setDateofbirth($formEdit['dateofbirth']);

        $this->entityManager->persist($user);
        $this->entityManager->flush();
    }

}