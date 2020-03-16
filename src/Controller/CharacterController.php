<?php


namespace App\Controller;

use App\Entity\Character;
use App\Entity\User;
use App\Form\CharacterType;
use App\Repository\CharacterRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;


class CharacterController extends AbstractController
{
    /**
     * @var EntityManagerInterface
     */
    public function __construct(EntityManagerInterface $entityManager, CharacterRepository $characterRepository)
    {
        $this->entityManager = $entityManager;
        $this->characterRepository = $characterRepository;
    }

    /**
     * @Route("/characters", name="characters", methods={"GET"})
     */
    public function characters(): Response
    {
        return $this->render('characters/index.html.twig');
    }

    /**
     * @Route("/characters/create", name="create", methods={"GET","POST"})
     */
    public function create(Request $request): Response
    {
        $form = $this->createForm(CharacterType::class);
        $form->handleRequest($request);

        if ($form->isSubmitted()) {
            $this->addFlash('success', 'Char erstellt.');
        }

        return $this->render('characters/create.html.twig', [
            'form' => $form->createView(),
        ]);
    }

    public function listCharacters(): Response
    {

        //$allCharacters = $this->characterRepository->findAll();
        //$allCharacters = $this->characterRepository->findAll();

        $userid = $this->getUser()->getId();
        
        $allCharacters = $this->getDoctrine()
            ->getRepository(Character::class)
            ->findOneByIdJoinedToUser($userid);


        return $this->render(
            'characters/list.html.twig', [
            'characters' => $allCharacters
        ]);
    }



}