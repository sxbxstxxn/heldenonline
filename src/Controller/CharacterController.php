<?php


namespace App\Controller;

use App\Entity\Character;
use App\Repository\CharacterRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
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

    public function listCharacters(): Response
    {
        $allCharacters = $this->characterRepository->findAll();

        return $this->render(
            'characters/list.html.twig', [
            'characters' => $allCharacters
        ]);
    }



}