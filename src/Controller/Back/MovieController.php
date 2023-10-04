<?php

namespace App\Controller\Back;

use App\Entity\Genre;
use App\Entity\Movie;
use App\Form\Back\MovieType;
use App\Repository\GenreRepository;
use App\Repository\MovieRepository;
use DateTime;
use DateTimeImmutable;
use Doctrine\ORM\EntityManagerInterface;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\IsGranted;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/back/movie", name="app_back_movie_")
 * @IsGranted("ROLE_MANAGER")
 */
class MovieController extends AbstractController
{
    /**
     * @Route("/", name="browse")
     */
    public function browse(MovieRepository $movieRepository): Response
    {
        $this->denyAccessUnlessGranted('OINEKB', ['toto', 'tata']);
        // $this->denyAccessUnlessGranted('ROLE_ADMIN');
        // 1. préparation des données
        $movieList = $movieRepository->findAll();


        // 2. affichage du template
        return $this->render('back/movie/browse.html.twig', [
            'movieList' => $movieList,
        ]);
    }

    // todo faire le read

    
    /**
     * @Route("/add", name="add", methods={"GET","POST"})
     */
    public function add(MovieRepository $movieRepository, Request $request, EntityManagerInterface $em): Response
    {
        $this->denyAccessUnlessGranted('ROLE_ADMIN');
        $movie = new Movie();
        // $movie->setReleaseDate(new DateTimeImmutable());

        $form = $this->createForm(MovieType::class, $movie);

        // todo vérifier pourquoi la note n'est pas enregistrée
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid())
        {

            $releaseDate = $form->get('release_date')->getData();
            // on finit d'hydrater notre objet
            $movie->setReleaseDate($releaseDate);

            $em->persist($movie);
            $em->flush();
            // todo ajouter un message flash

            return $this->redirectToRoute('app_back_movie_browse');

        }

        return $this->renderForm('back/movie/add.html.twig', [
            'form' => $form
        ]);
    }


    /**
     * @Route("/{id}/edit", name="edit", methods={"GET","POST"})
     */
    public function edit(Movie $movie, MovieRepository $movieRepository, GenreRepository $genreRepository, Request $request, EntityManagerInterface $em): Response
    {
        $form = $this->createForm(MovieType::class, $movie);

        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid())
        {
            $releaseDate = $form->get('release_date')->getData();
            // on finit d'hydrater notre objet
            $movie->setReleaseDate($releaseDate);

            $allGenres = $genreRepository->findAll();
            foreach ($allGenres as $currentGenre)
            {
                $currentGenre->removeMovie($movie);
            }
            foreach($form->get('genres')->getData() as $currentGenre)
            {
                // on modifie les relations entre movie et genre
                $currentGenre->addMovie($movie);
            }

            $em->persist($movie);
            $em->flush();
            // todo ajouter un message flash

            return $this->redirectToRoute('app_back_movie_browse');

        }

        return $this->renderForm('back/movie/edit.html.twig', [
            'form' => $form,
            'movie' => $movie,
        ]);
    }

    /**
     * @Route("/{id}/delete", name="delete", methods={"POST"}, requirements={"id"="\d+"})
     */
    public function delete(Request $request, Movie $movie, MovieRepository $movieRepository): Response
    {
        if ($this->isCsrfTokenValid('delete-movie-' . $movie->getId(), $request->request->get('_token'))) {
            $movieRepository->remove($movie, true);
            $this->addFlash('success', 'Film supprimé');
        }

        return $this->redirectToRoute('app_back_movie_browse', [], Response::HTTP_SEE_OTHER);
    }

}