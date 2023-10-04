<?php

namespace App\Controller\Front;

use App\Model\Movies;
use App\Repository\MovieRepository;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class MainController extends AbstractController
{
    /**
     * @Route("/", name="home", methods={"GET"})
     */
    public function home(MovieRepository $movieRepository)
    {
        // // On va chercher les données depuis le model Movies
        // $movies = Movies::getMovies();

        // On va chercher les données depuis la bdd grace au MovieRepository
        // $movies = $movieRepository->findAll();
        // on veut les ordonner de manière spécifique
        // 1. on peut utiliser la méthode find
        // $movies = $movieRepository->findBy([], ['title' => 'ASC']);
        // 2. on peut créer une méthode spécifique dans le repository
        $movies = $movieRepository->findOrderedByTitle(5);

        dump($movies);
        // dump($movies);

        // Afficher la template home.html.twig qui est dans le dossier templates/main
        // La methode render est dans le AbstractController et c'est la methode qui permet d'afficher la vue qui lui est passée en parametre
        // Le 2eme param c'est les données qu'on veut passer a la vue
        return $this->render('front/main/home.html.twig', [
            'movies' => $movies
        ]); 
    }

    /**
     * Page de favoris
     *
     * @Route("/favorites", name="favorites", methods={"GET"})
     */
    public function favorites()
    {
        return $this->render('front/main/favorites.html.twig'); 
    }
}