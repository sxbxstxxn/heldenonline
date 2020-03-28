<?php


namespace App\Controller;


use App\Entity\User;
use App\Repository\UserRepository;
use App\User\UserManager;
use Doctrine\ORM\EntityManagerInterface;
use http\Env\Request;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;
use Symfony\Component\Security\Core\User\UserInterface;
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


    /**
     * @Route("/users/list", name="userlist", methods={"GET"})
     */
    public function list(): Response
    {
        $userlist = $this->entityManager->getRepository(User::class)->findBy(
            array('registrationConfirmed' => 1)
        );
        return $this->render('users/list.html.twig', [
            'userlist' => $userlist
        ]);
    }
/*
    public function listBirthdays(): Response
    {
        //added beberlein doctrine extension for using floor and other functions, see https://github.com/beberlei/DoctrineExtensions/
        $dql = 'SELECT 
                    user.username, 
                    user.dateofbirth,
                    FLOOR(DATEDIFF(CURRENT_TIMESTAMP(), user.dateofbirth) / 365.25) + 1 AS nextage,
                    DATEADD(user.dateofbirth,(FLOOR(DATEDIFF(CURRENT_TIMESTAMP(), user.dateofbirth) / 365.25)+1),\'YEAR\') AS nextbirthday,
                    -DATEDIFF(CURRENT_TIMESTAMP(),DATEADD(user.dateofbirth,(FLOOR(DATEDIFF(CURRENT_TIMESTAMP(), user.dateofbirth) / 365.25)+1),\'YEAR\')) AS daysuntilbirthday                   
                FROM 
                    App\Entity\User user  
                WHERE
                    -DATEDIFF(CURRENT_TIMESTAMP(),DATEADD(user.dateofbirth,(FLOOR(DATEDIFF(CURRENT_TIMESTAMP(), user.dateofbirth) / 365.25)+1),\'YEAR\')) < 30                                        
                ORDER BY
                    nextbirthday ASC                                     
                 ';
        $query = $this->entityManager->createQuery($dql);
        $allUsers = $query->execute();

        return $this->render(
            'cardboxes/birthdaylist.html.twig', [
            'userlist' => $allUsers
        ]);
    }
*/
    /**
     * @Route("/user/show/{id}", name="user_show", methods={"GET","POST"})
     */
    public function show(User $user)
    {
        return $this->render(
            'users/show.html.twig', [
            'user' => $user
        ]);
    }
}