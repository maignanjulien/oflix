<?php

namespace App\Controller;

use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class MainController
{
    /**
     * @Route("/", name="home")
     */
    public function home()
    {
        // Afficher je suis la home
        return new Response('Je suis la home');
    }
}