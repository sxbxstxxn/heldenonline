<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Response;

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
     * @Route("/profile", name="profile", methods={"GET"})
     */
    public function profile(): Response
    {
        return $this->render('index.html.twig');
    }
}