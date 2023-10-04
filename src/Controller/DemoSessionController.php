<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Request;

class DemoSessionController extends AbstractController
{
    /**
     * @Route("/demo/session", name="app_demo_session")
     */
    public function index(Request $request)
    {
        // On va récupérer les données d'une session, et on les stock dans $session
        $session = $request->getSession();

        // On va récupérer la valeur associé a la clé 'username' dans la session
        $username = $session->get('username');
        // dump($session);
        // dump($username);

        return $this->render('demo_session/index.html.twig', [
            'username' => $username,
        ]);
    }

    /**
     * Create session element => ajoute $name dans la session
     *
     * @Route("/demo/session/add/{name}", name="app_demo_session_add")
     */
    public function add(Request $request, $name)
    {
        // on recupere la session
        $session = $request->getSession();

        // on ajoute une donnée dans la session
        // on ajoute a la clé 'username' la valeur de $name
        $session->set('username', $name);
        // on redirige l'utilisateur vers la route qui a pour name = app_demo_session => donc la methode index plus haut
        return $this->redirectToRoute('app_demo_session');
    }
}