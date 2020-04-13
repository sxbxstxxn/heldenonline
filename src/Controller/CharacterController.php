<?php


namespace App\Controller;

use App\Entity\Character;
use App\Entity\Species;

use App\Entity\User;
use App\Form\CharacterType;
use App\Repository\CharacterRepository;
use Doctrine\ORM\EntityManagerInterface;
use PhpParser\Node\Stmt\Return_;
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

        if ($form->isSubmitted() && $form->isValid()) {
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

            if ($form->isSubmitted() && $form->isValid()) {
                $formData = $form->getData();



                $character->setCharname($formData->getCharname());
                $character->setAptotal($formData->getAptotal());
                $character->setApavailable($formData->getApavailable());
                $character->setApspent($formData->getApspent());
                $character->setExperiencelevel($formData->getExperiencelevel());
                $character->setAttributeMu($formData->getAttributeMu());
                $character->setAttributeKl($formData->getAttributeKl());
                $character->setAttributeIn($formData->getAttributeIn());
                $character->setAttributeCh($formData->getAttributeCh());
                $character->setAttributeFf($formData->getAttributeFf());
                $character->setAttributeGe($formData->getAttributeGe());
                $character->setAttributeKo($formData->getAttributeKo());
                $character->setAttributeKk($formData->getAttributeKk());
                $character->setSpecies($formData->getSpecies());
                $character->setCulture($formData->getCulture());
                $character->setProfession($formData->getProfession());
                $character->setGender($formData->getGender());
                $character->setBirthplace($formData->getBirthplace());
                $character->setBirthdate($formData->getBirthdate());
                $character->setAge($formData->getAge());
                $character->setSize($formData->getSize());
                $character->setWeight($formData->getWeight());
                $character->setHaircolor($formData->getHaircolor());
                $character->setEyecolor($formData->getEyecolor());
                $character->setTitle($formData->getTitle());
                $character->setSocialstatus($formData->getSocialstatus());
                $character->setFamily($formData->getFamily());
                $character->setCharacteristics($formData->getCharacteristics());
                $character->setFurther($formData->getFurther());
                $character->setLifeenergy($formData->getLifeenergy());
                $character->setLifeenergybonus($formData->getLifeenergybonus());
                $character->setLifeenergypurchase($formData->getLifeenergypurchase());
                $character->setLifeenergymax($formData->getLifeenergymax());
                $character->setAstralenergy($formData->getAstralenergy());
                $character->setAstralenergybonus($formData->getAstralenergybonus());
                $character->setAstralenergypurchase($formData->getAstralenergypurchase());
                $character->setAstralenergymax($formData->getAstralenergymax());
                $character->setKarmaenergy($formData->getKarmaenergy());
                $character->setKarmaenergybonus($formData->getKarmaenergybonus());
                $character->setKarmaenergypurchase($formData->getKarmaenergypurchase());
                $character->setKarmaenergymax($formData->getKarmaenergymax());
                $character->setSoulpower($formData->getSoulpower());
                $character->setSoulpowerbonus($formData->getSoulpowerbonus());
                $character->setSoulpowermax($formData->getSoulpowermax());
                $character->setToughness($formData->getToughness());
                $character->setToughnessbonus($formData->getToughnessbonus());
                $character->setToughnessmax($formData->getToughnessmax());
                $character->setDodge($formData->getDodge());
                $character->setDodgebonus($formData->getDodgebonus());
                $character->setDodgemax($formData->getDodgemax());
                $character->setInitiative($formData->getInitiative());
                $character->setInitiativebonus($formData->getInitiativebonus());
                $character->setInitiativemax($formData->getInitiativemax());
                $character->setSpeed($formData->getSpeed());
                $character->setSpeedbonus($formData->getSpeedbonus());
                $character->setSpeedmax($formData->getSpeedmax());
                $character->setFatepoints($formData->getFatepoints());
                $character->setFatepointsbonus($formData->getFatepointsbonus());
                $character->setFatepointsmax($formData->getFatepointsmax());
                $character->setFatepointscurrent($formData->getFatepointscurrent());



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

    /**
     * @Route("/test", name="test")
     */
    public function test() :Response
    {
        //$characterrepository $this->entityManager->getRepository(Character::class);
        $char = $this->characterRepository->find(2);
        $species = $char->getSpecies();
        $speciesname = $species->getSpeciesname();

        var_dump($speciesname);die;
    }

}