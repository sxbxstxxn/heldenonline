<?php


namespace App\Controller;


use App\Entity\User;
use App\Repository\UserRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;
use Symfony\Component\Serializer\SerializerInterface;
use Symfony\Component\Routing\Annotation\Route;

class UserController extends AbstractController
{


    /**
     * @var EntityManagerInterface
     */


    public function __construct(UserPasswordEncoderInterface $userPasswordEncoder, EntityManagerInterface $entityManager, UserRepository $userrepository, SerializerInterface $serializer)
    {
        $this->userPasswordEncoder = $userPasswordEncoder;
        $this->entityManager = $entityManager;
        $this->userRepository = $userrepository;
        $this->serializer = $serializer;
    }

    public function listUsers()
    {
        //$allUsers = $this->userRepository->findAll();
        $allUsers = $this->entityManager->getRepository(User::class)->findAll();
        $allSerializedUsers = $this->serializer->serialize($allUsers,'json', ['groups' => ['list']]);
        //$userlist = $this->serializer->deserialize($allSerializedUsers,User::class,'json');
        $userlist = json_decode($allSerializedUsers);

        return $this->render(
            'cardboxes/userlist.html.twig', [
            'userlist' => $allSerializedUsers
        ]);

        //return JsonResponse::fromJsonString(
        //    $serializer->serialize($allUsers, 'json', ['groups' => ['list']])
        //);
    }

    /**
     * @Route("/userlist", name="userlist", methods={"GET"})
     */
    public function userlist(): Response
    {
        //$allUsers = $this->entityManager->getRepository(User::class)->findAll();

        $allUsers = $this->entityManager->getRepository(User::class)->findBy(
            array('registrationConfirmed' => 1)
        );

        $allSerializedUsers = $this->serializer->serialize($allUsers,'json', ['groups' => ['list']]);
        $userlist = json_decode($allSerializedUsers);

        return $this->render('userlist.html.twig', [
            'userlist' => $userlist
        ]);
    }
}