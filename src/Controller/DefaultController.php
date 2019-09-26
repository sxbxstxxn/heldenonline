<?php

namespace App\Controller;

use App\User\UserManager;
use App\Form\ContactType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class DefaultController extends AbstractController
{
    public function __construct(UserManager $manager)
    {
        $this->manager = $manager;
    }

    /**
     * @Route("/", name="index", methods={"GET"})
     */
     public function index(): Response
     {
         return $this->render('index.html.twig');
     }

    /**
     * @Route("/kontakt", name="kontakt", methods={"GET","POST"})
     */
    public function kontakt(Request $request, \Swift_Mailer $mailer): Response
    {
        $form = $this->createForm(ContactType::class);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->addFlash('success', 'Deine E-Mail wurde verschickt. Wir versuchen Dir schnellstmöglich zu antworten.');

            $sender = $form['sender']->getData();
            $subject = 'Kontaktformular: '.$form['subject']->getData();
            $message = $form['message']->getData();

            $mailmessage = (new \Swift_Message($subject))
                ->setFrom(array($sender))
                ->setTo('admin@helden.online')
                ->setBody($message,'text/html');
            ;
            $mailer->send($mailmessage);

            return $this->redirectToRoute('index');
        }

        return $this->render('kontakt.html.twig', [
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/impressum", name="impressum")
     */
    public function impressum(): Response
    {
        return $this->render('impressum.html.twig');
    }

    /**
     * @Route("/datenschutz", name="datenschutz")
     */
    public function datenschutz(): Response
    {
        return $this->render('datenschutz.html.twig');
    }

    /**
     * @Route("/testmail", name="testmail")
     */
    public function testmail(\Swift_Mailer $mailer)
    {
        $message = (new \Swift_Message('Deine Registrierung'))
            ->setFrom(array('registrierung@helden.online' => 'Helden Online'))
            ->setTo('sxbxstxxn@googlemail.com')
            ->setBody(
                $this->renderView(
                // templates/emails/registration.html.twig
                    'emails/registration.html.twig',
                    ['name' => 'testname']
                ),
                'text/html'
            );
        ;

        $mailer->send($message);

        return $this->render('index.html.twig');
    }
}