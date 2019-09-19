<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class DefaultController extends AbstractController
{
    /**
     * @Route("/", name="index", methods={"GET"})
     */
     public function index(): Response
     {
         return $this->render('index.html.twig');
     }

    /**
     * @Route("/kontakt", name="kontakt", methods={"GET"})
     */
    public function kontakt(): Response
    {
        return $this->render('kontakt.html.twig');
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