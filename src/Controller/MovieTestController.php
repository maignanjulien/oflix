<?php

namespace App\Controller;

use DateTime;
use App\Entity\Genre;
use App\Entity\Movie;
use App\Repository\GenreRepository;
use App\Repository\MovieRepository;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class MovieTestController extends AbstractController
{
    /**
     * Ajoute un film en bdd
     *
     * @Route("/test/movie/add", name="add_movie_test")
     */
    public function add(MovieRepository $movieRepository, GenreRepository $genreRepository)
    {
        // On créer un genre
        $genre = new Genre();
        $genre->setName("Drama de daronnes");
        // On l'envoie en bdd
        $genreRepository->add($genre, true);
        // On créer un 2eme genre
        $genre2 = new Genre();
        $genre2->setName("Aventure");
        // On l'envoie en bdd
        $genreRepository->add($genre2, true);

        // On créer une instance de notre entité Movie
        $movie = new Movie();

        // On définit les propriétés de $movie
        $movie->setTitle("Stranger Things");
        $movie->setDuration(94);
        // DateTime => format de date
        $movie->setReleaseDate(new DateTime('2001-07-04'));
        $movie->setSummary("Wisteria Lane est un lieu paisible où les habitants semblent mener une vie heureuse..."); // ajout d'un sommaire
        $movie->setSynopsis("Wisteria Lane est un lieu paisible où les habitants semblent mener une vie heureuse... en apparence seulement ! Car en y regardant de plus près, on découvre bien vite, dans l'intimité de chacun, que le bonheur n'est pas toujours au rendez-vous. Et peu à peu, les secrets remontent inévitablement à la surface, risquant de faire voler en éclat le vernis lisse de leur tranquille existence..."); // ajout du synopsis
        $movie->setType("Série"); // ajout du type (film ou série)
        $movie->setPoster("https://fr.web.img4.acsta.net/pictures/18/10/29/17/57/1200682.jpg"); // ajout de l'image
        $movie->setRating(2.5); // ajout de la note moyenne

        // On va ajouter un genre a notre serie => Drame de daronne
        $movie->addGenre($genre);
        // On va ajouter un autre genre a notre serie => Aventure
        $movie->addGenre($genre2);

        dump($movie);
        $movieRepository->add($movie, true);

        return $this->render('movie_test/index.html.twig', [
            'movie' => $movie,
        ]);
    }

    /**
     * Affiche tous les film depuis la bdd
     *
     * @Route("/test/movie/list", name="list_movie_test")
     */
    public function list(MovieRepository $movieRepository)
    {
        // Je recupere la liste de TOUS les films depuis la bdd
        $movies = $movieRepository->findAll();
        return $this->render('movie_test/list.html.twig', [
            'movies' => $movies,
        ]);
    }

     /**
     * Affiche tous les film depuis la bdd
     *
     * @Route("/test/movie/show/{id}", name="show_test")
     */
    public function show($id, MovieRepository $movieRepository)
    {
        $movie = $movieRepository->find($id);
        // Je recupere la liste de TOUS les films depuis la bdd
        // $movies = $movieRepository->findAll();
        return $this->render('movie_test/show.html.twig', [
            'movie' => $movie,
        ]);
    }

    /**
     * Supprime un film grace a son id
     *
     * @Route("/test/movie/remove/{id}", name="remove_movie_test")
     */
    public function remove(MovieRepository $movieRepository, $id)
    {
        // On recupere l'entité qui a pour id = $id
        $movie = $movieRepository->find($id);
        // On supprime l'entité
        $movieRepository->remove($movie, true);
    }
}