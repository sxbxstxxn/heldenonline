<?php


namespace App\Controller;


use App\Form\UserType;
use App\Repository\UserRepository;
use App\User\UserManager;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\File\Exception\FileException;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Routing\Generator\UrlGeneratorInterface;
use Symfony\Component\Validator\Constraints as Assert;
use Symfony\Component\Validator\Validator\ValidatorInterface;
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

    /**
     * @Route("/editprofile", name="editprofile", methods={"GET","POST"})
     */
    public function edit(): Response
    {
        $user = $this->getUser();
        return $this->render('security/edit.html.twig', [
            //'form' => $form->createView(),
            'user' => $user
        ]);
    }

    /**
     * @Route("/forgotpw", name="forgotpw", methods={"GET","POST"})
     */
    public function forgotpassword(Request $request, ValidatorInterface $validator, UserRepository $userRepository): Response
    {

        $email = $request->get('_email');

        if ($email)
        {
            $emailConstraint = new Assert\Email();
            $emailConstraint->message = 'Dieser Wert ist keine gültige E-Mail-Adresse.';
            $errors = $validator->validate($email,$emailConstraint);

            if (0 === count($errors)) {
                // ... this IS a valid email address, do something
                // check if mail is in DB
                $mailresult = $userRepository->findBy(['email' => $email]);
                if ($mailresult)
                {
                    // yes = send pw-change-mail
                    $this->addFlash('success', 'Du hast jetzt eine E-Mail mit den Informationen für ein neues Passwort erhalten.');
                    $errorMessage = '';
                }
                else {
                    // no = errormessage
                    $errorMessage = 'Die E-Mail Adresse wurde nicht gefunden. Du kannst Dich damit also neu registrieren.';
                }

            } else {
                // this is *not* a valid email address
                $errorMessage = $errors[0]->getMessage();
            }
        }
        else {
            $errorMessage = '';
        }



        return $this->render('security/forgotpw.html.twig', [
            'error' => $errorMessage
        ]);
    }

}