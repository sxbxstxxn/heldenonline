<?php


namespace App\Controller;


use App\Form\UserType;
use App\User\UserManager;
use http\Client\Curl\User;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\File\Exception\FileException;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Routing\Generator\UrlGeneratorInterface;
use Symfony\Component\Security\Http\Authentication\AuthenticationUtils;

class SecurityController extends AbstractController
{

    /**
     * @Route("/register", name="register", methods={"GET","POST"})
     */
    public function register(Request $request, UserManager $manager, \Swift_Mailer $mailer): Response
    {
        $form = $this->createForm(UserType::class);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {

            // PICTURE FILE
            $pictureFile = $form['picture']->getData();
            $newFilename = NULL;
            if ($pictureFile) {
                $newFilename = 'profile-'.$form['username']->getData().'-'.uniqid().'.'.$pictureFile->guessExtension();
                try {
                    $pictureFile->move(
                        $this->getParameter('pictures_directory'),
                        $newFilename
                    );
                } catch (FileException $e) {
                    // ... handle exception if something happens during file upload
                }
            }

            $hashstring = hash('md5','hash'.strval(time()).$form['username']->getData());
            $hashurl = $this->generateUrl(
                'confirmregistration',
                array(
                    'user'=>$form['username']->getData(),
                    'hash'=>$hashstring,
                ),
                UrlGeneratorInterface::ABSOLUTE_URL
            );

            $removeurl = $this->generateUrl(
                'deleteregistration',
                array(
                    'user'=>$form['username']->getData(),
                    'hash'=>$hashstring,
                ),
                UrlGeneratorInterface::ABSOLUTE_URL
            );

            $manager->register($form->getData(),$newFilename, $hashstring);

            // MAIL
            $message = (new \Swift_Message('Deine Registrierung'))
                ->setFrom(array('registrierung@helden.online' => 'Helden Online'))
                ->setTo($form['email']->getData())
                ->setBody(
                    $this->renderView(
                    // templates/emails/registration.html.twig
                        'emails/registration.html.twig',
                        array(
                            'name' => $form['username'],
                            'hashurl' => $hashurl,
                            'removeurl' => $removeurl,
                        )
                    ),
                    'text/html'
                );
            ;
            $mailer->send($message);
            // END MAIL

            $this->addFlash('success', 'Du hast Dich erfolgreich registriert und bekommst jetzt eine Mail mit einem Bestätigungslink. Wenn Du Deine E-Mail Adresse bestätigst hast kannst Du Dich einloggen.');

            return $this->redirectToRoute('login');
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

        $error = $authUtils->getLastAuthenticationError();

        return $this->render('security/login.html.twig', [
            'error' => $error,
            'last_username' => $authUtils->getLastUsername(),
        ]);
    }

    /**
     * @Route("/logout", name="logout")
     */
    public function logout()
    {
    }

    /**
     * @Route("/confirmregistration", name="confirmregistration")
     */
    public function confirm(UserManager $manager, \Swift_Mailer $mailer) : Response
    {
        $hashstring = $_GET['hash'];
        $username = $_GET['user'];
        $hashindb = $manager->getHash($username);

        if (isset($hashstring) && isset($hashindb) && $hashindb == $hashstring) {
            $manager->confirm($username, $hashstring);
            return $this->render(
                'security/confirm_success.html.twig',
                array(
                    'user' => $username,
                )
            );
        }
        else {
            $errormessage = 'Bei der Bestätigung ist etwas schiefgelaufen. Bitte wenden Dich an einen Admin über das Kontaktformular.';
            return $this->render(
                'security/confirm_fail.html.twig',
                array(
                    'errormessage' => $errormessage,
                )
            );
        }
    }

    /**
     * @Route("/deleteregistration", name="deleteregistration")
     */
    public function delete(UserManager $manager, \Swift_Mailer $mailer) : Response
    {
        $hashstring = $_GET['hash'];
        $username = $_GET['user'];
        $hashindb = $manager->getHash($username);

        if ($hashindb == $hashstring) {
            $manager->delete($username);
            return $this->render(
                'security/delete_success.html.twig',
                array(
                    'message' => 'Deine Daten wurden erfolgreich gelöscht.',
                )
            );
        }
        else {
            $errormessage = 'Beim Löschen Deiner Registrierung ist etwas schiefgelaufen. Bitte wenden Dich an einen Admin über das Kontaktformular.';
            return $this->render(
                'security/confirm_fail.html.twig',
                array(
                    'errormessage' => $errormessage,
                )
            );
        }
    }
}