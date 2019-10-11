<?php


namespace App\Controller;


use App\Form\EditProfileType;
use App\Form\ResetPasswordType;
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
    public function edit(Request $request, UserManager $manager): Response
    {
        $user = $this->getUser();
        $username = $user->getUsername();

        $form = $this->createForm(EditProfileType::class);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {

            // PICTURE FILE
            $pictureFile = $form['picture']->getData();
            $newFilename = NULL;
            if ($pictureFile) {
                $newFilename = 'profile-'.$username.'-'.uniqid().'.'.$pictureFile->guessExtension();
                try {
                    $pictureFile->move(
                        $this->getParameter('pictures_directory'),
                        $newFilename
                    );
                } catch (FileException $e) {
                    // ... handle exception if something happens during file upload
                }
            }

            $manager->editUser($user, $form->getData(), $newFilename);
            $this->addFlash('success', 'Deine Änderungen wurden erfolgreich übernommen.');

        }

        return $this->render('security/edit.html.twig', [
            'form' => $form->createView(),
            'user' => $user
        ]);
    }

    /**
     * @Route("/forgotpw", name="forgotpw", methods={"GET","POST"})
     */
    public function forgotpassword(Request $request, ValidatorInterface $validator, UserRepository $userRepository, UserManager $manager, \Swift_Mailer $mailer): Response
    {

        $email = $request->get('_email');

        if ($email)
        {
            $emailConstraint = new Assert\Email();
            $emailConstraint->message = 'Dieser Wert ist keine gültige E-Mail-Adresse.';
            $errors = $validator->validate($email,$emailConstraint);



            if (0 === count($errors)) {

                $user = $userRepository->loadUserByEmail($email);
                $username = $user->getUsername();
                // ... this IS a valid email address, do something
                // check if mail is in DB
                $mailresult = $userRepository->findBy(['email' => $email]);
                if ($mailresult)
                {
                    $hashstring = hash('md5','hash'.strval(time()).$username);
                    $hashurl = $this->generateUrl(
                        'requestnewpw',
                        array(
                            'user'=>$username,
                            'hash'=>$hashstring,
                        ),
                        UrlGeneratorInterface::ABSOLUTE_URL
                    );

                    $manager->setHash($username, $hashstring);
                    // MAIL
                    $message = (new \Swift_Message('Passwort vergessen'))
                        ->setFrom(array('registrierung@helden.online' => 'Helden Online'))
                        ->setTo($email)
                        ->setBody(
                            $this->renderView(
                                'emails/forgotpw.html.twig',
                                array(
                                    'name' => $username,
                                    'hashurl' => $hashurl,
                                )
                            ),
                            'text/html'
                        );
                    ;
                    $mailer->send($message);
                    // END MAIL
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
    /**
     * @Route("/requestnewpw", name="requestnewpw", methods={"GET","POST"})
     */
    public function requestnewpassword(Request $request, UserRepository $userRepository, UserManager $manager): Response
    {
        $hashstring = '';
        $username = '';
        $user = '';
        if(isset($_GET['hash']) && !empty($_GET['hash'])) {
            $hashstring = $_GET['hash'];
        }
        if(isset($_GET['user']) && !empty($_GET['user'])) {
            $username = $_GET['user'];
            $user = $userRepository->loadUserByUsername($username);
            $hashindb = $manager->getHash($username);
        }


        if ($hashstring != '' && $user != '' && isset($hashindb) && $hashindb == $hashstring) {
            //$manager->confirm($username, $hashstring);
            $form = $this->createForm(ResetPasswordType::class);
            $form->handleRequest($request);
            if ($form->isSubmitted() && $form->isValid()) {

                //$manager->register($form->getData(),$newFilename, $hashstring);
                $manager->setNewPassword($user,$form->getData());
                $manager->setHash($username,NULL);
                $this->addFlash('success', 'Du hast erfolgreich Dein Passwort geändert und kannst Dich jetzt mit dem neuen Passwort einloggen.');
                return $this->redirectToRoute('login');
            }
            return $this->render('security/requestnewpw.html.twig', [
                'form' => $form->createView(),
                'username' => $username,
            ]);
        }
        else {
            $errormessage = 'Da ist etwas schiefgelaufen. Bitte wenden Dich an einen Admin über das Kontaktformular.';
            return $this->render(
                'security/confirm_fail.html.twig',
                array(
                    'errormessage' => $errormessage,
                )
            );
        }
    }
}