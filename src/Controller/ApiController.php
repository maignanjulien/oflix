<?php

namespace App\Controller;

use App\Model\Movies;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class ApiController extends AbstractController
{
    /**
     * Get movies collection
     *
     * @Route("/api/movies", name="api_movies_get", methods={"GET"})
     */
    public function moviesGet()
    {
        // on va chercher les données
        $movies = Movies::getMovies();

        // on retourne les movies ... en JSON car on est sur une api
        // grace a la methode json() on a jsonifier le tableau $movies
        return $this->json(['movies' => $movies]);
    }
}