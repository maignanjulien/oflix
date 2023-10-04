<?php

namespace App\Controller\Back;

use App\Entity\Genre;
use App\Form\Back\GenreType;
use App\Repository\GenreRepository;
use DateTime;
use DateTimeImmutable;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/back/genre", name="app_back_genre_")
 */
class GenreController extends AbstractController
{
    /**
     * @Route("/", name="browse")
     */
    public function browse(GenreRepository $genreRepository): Response
    {
        // 1. préparation des données
        $genreList = $genreRepository->findAll();


        // 2. affichage du template
        return $this->render('back/genre/browse.html.twig', [
            'genreList' => $genreList,
        ]);
    }

    // todo faire le read

    
    /**
     * @Route("/add", name="add", methods={"GET","POST"})
     */
    public function add(GenreRepository $genreRepository, Request $request, EntityManagerInterface $em): Response
    {
        $genre = new Genre();
        // $genre->setReleaseDate(new DateTimeImmutable());

        $form = $this->createForm(GenreType::class, $genre);

        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid())
        {
            $em->persist($genre);
            $em->flush();
            // todo ajouter un message flash
            $this->addFlash('success', 'genre ajouté !');

            return $this->redirectToRoute('app_back_genre_browse');

        }

        return $this->renderForm('back/genre/add.html.twig', [
            'form' => $form
        ]);
    }


    /**
     * @Route("/{id}/edit", name="edit", methods={"GET","POST"})
     */
    public function edit(Genre $genre, GenreRepository $genreRepository, Request $request, EntityManagerInterface $em): Response
    {
        $form = $this->createForm(GenreType::class, $genre);

        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid())
        {
            $em->persist($genre);
            $em->flush();
            // todo ajouter un message flash
            $this->addFlash('success', 'Genre modifié');

            return $this->redirectToRoute('app_back_genre_browse');
        }

        return $this->renderForm('back/genre/edit.html.twig', [
            'form' => $form,
            'genre' => $genre,
        ]);
    }

    /**
     * @Route("/{id}/delete", name="delete", methods={"POST"}, requirements={"id"="\d+"})
     */
    public function delete(Request $request, Genre $genre, GenreRepository $genreRepository): Response
    {
        if ($this->isCsrfTokenValid('delete-genre-' . $genre->getId(), $request->request->get('_token'))) {
            $genreRepository->remove($genre, true);
            $this->addFlash('success', 'Genre supprimé');
        }

        return $this->redirectToRoute('app_back_genre_browse', [], Response::HTTP_SEE_OTHER);
    }

}