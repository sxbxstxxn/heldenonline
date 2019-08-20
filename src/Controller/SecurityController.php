<?php


namespace App\Controller;


use App\Form\UserType;
use App\User\UserManager;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Http\Authentication\AuthenticationUtils;

class SecurityController extends AbstractController
{

    /**
     * @Route("/register", name="register", methods={"GET","POST"})
     */
    public function register(Request $request, UserManager $manager): Response
    {
        $form = $this->createForm(UserType::class);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $manager->register($form->getData());
            $this->addFlash('success', 'erfolgreich registriert');

            return $this->redirectToRoute('index');
        }

        return $this->render('security/register.html.twig', [
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/login", name="login")
     */
    public function login(AuthenticationUtils $authUtils): Response
    {
        return $this->render('security/login.html.twig', [
            'error' => $authUtils->getLastAuthenticationError(),
            'last_username' => $authUtils->getLastUsername(),
        ]);
    }

    /**
     * @Route("/logout", name="logout")
     */
    public function logout()
    {
    }
}