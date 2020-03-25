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

        $character = new Character();
        $user = $this->getUser();

        if ($form->isSubmitted()) {
            $character = $form->getData();
            $character->setUser($user);
            $this->entityManager->persist($character);
            $this->entityManager->flush();

            $this->addFlash('success', 'Char erstellt.');
            //doesn't work, don't know why. when redirect is active, the character ist not saved in database
            return $this->redirectToRoute('characters');
        }

        return $this->render('characters/create.html.twig', [
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/characters/show/{id}", name="character_show")
     */
    public function show(Character $character)
    {
        $user = $this->getUser();
        if (!$character) {
            throw $this->createNotFoundException(
                'Kein Charakter mit der ID '.$id.' vorhanden.'
            );
        }
        if ($user == $character->getUser()) {
            return $this->render(
                'characters/show.html.twig', [
                'character' => $character
            ]);
        }
        else {
            $this->addFlash('danger', 'Dies ist nicht Dein Char. Keine Berechtigung.');
            return $this->redirectToRoute('characters');
        }
    }

    /**
     * @Route("characters/edit/{id}", name="character_edit")
     */
    public function edit(Character $character, Request $request)
    {
        $user = $this->getUser();
        if ($user == $character->getUser()) {

            $form = $this->createForm(CharacterType::class);
            $form->handleRequest($request);

            if ($form->isSubmitted()) {
                $formData = $form->getData();

                $character->setCharname($formData->getCharname());
                $character->setAttributeMu($formData->getAttributeMu());
                $character->setAttributeKl($formData->getAttributeKl());
                $character->setAttributeIn($formData->getAttributeIn());
                $character->setAttributeCh($formData->getAttributeCh());
                $character->setAttributeFf($formData->getAttributeFf());
                $character->setAttributeGe($formData->getAttributeGe());
                $character->setAttributeKo($formData->getAttributeKo());
                $character->setAttributeKk($formData->getAttributeKk());

                $this->entityManager->flush();
                $this->addFlash('success', 'Änderungen an '.$character->getCharname().' gespeichtert.');
                return $this->redirectToRoute('characters');
            }
            return $this->render(
                'characters/edit.html.twig', [
                'character' => $character,
                'form' => $form->createView()
            ]);
        }
        else {
            $this->addFlash('danger', 'Dies ist nicht Dein Char. Keine Berechtigung.');
            return $this->redirectToRoute('characters');
        }
    }

    /**
     * @Route("characters/delete/{id}", name="character_delete")
     */
    public function delete(Character $character)
    {
        $user = $this->getUser();
        if ($user == $character->getUser()) {
            $this->entityManager->remove($character);
            $this->entityManager->flush();
            $this->addFlash('success', 'Char gelöscht.');
        }
        else {
            $this->addFlash('danger', 'Charakter wurde nicht gelöscht. Keine Berechtigung.');
        }
        return $this->redirectToRoute('characters');
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