<?php

namespace App\Controller\Front;

use App\Entity\Movie;
use App\Entity\Review;
use App\Form\ReviewType;
use App\Model\Movies;
use App\Repository\MovieRepository;
use App\Repository\ReviewRepository;
use DateTimeImmutable;
use Doctrine\ORM\EntityManager;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

/**
 *
 * @Route("/movie", name="movie_")
 */
class MovieController extends AbstractController
{
    /**
     * Page de liste
     *
     * @Route("/list", name="list", methods={"GET"})
     */
    public function list()
    {
        return $this->render('front/movie/list.html.twig');
    }

    /**
     * Page de détail d'un film
     *
     * @Route("/{id}", name="show", methods={"GET"})
     */
    public function show(int $id, MovieRepository $movieRepository, ReviewRepository $reviewRepository)
    {
        // // Je recupere le film que je veux en fonction de son $id 
        // $movie = Movies::getMovieById($id);
        // Je recupere le film que je veux depuis la bdd en fonction de son $id 
        // $movie = $movieRepository->find($id);
        $movie = $movieRepository->findWithAssociatedData($id);

        // todo et si le movie n'existe pas ? 

        // lorsque j'essaye d'accéder à une valeur 
        // alors doctrine va faire la requête associée
        // $movie->getCastings()[0]->getCreditOrder();
        // $movie->getGenres()[0]->getName();
        // dump($movie);
        // dd($movie);
        // on check si le film existe
        if ($movie === null) {
            /*
                Symfony engloble l'appel des controleurs dans un try catch
                si il attrape l'exception NotFoundHttpException
                alors il affiche une page 404 avec le message d'erreur
            */
            
            throw $this->createNotFoundException('Film non trouvé !');
        }

        $reviewList = $reviewRepository->findBy(['movie' => $movie]);
        return $this->render('front/movie/show.html.twig', [
            'movie' => $movie,
            'reviewList' => $reviewList
        ]);
    }

    /**
     * Page de détail d'un film
     *
     * @Route("/{id}/review/add", name="review_add", methods={"GET", "POST"}, requirements={"id"="\d+"})
     */
    public function addReview(Movie $movie, Request $request, EntityManagerInterface $entityManager)
    {
        // créer le formulaire
        $review = new Review();

        $review->setMovie($movie);
        // $review->setWatchedAt(new DateTimeImmutable());

        $form = $this->createForm(ReviewType::class, $review);

        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid())
        {
            // comme on a mis le champ watchedAt en non mappé, 
            // le composant form n'a pas rempli la propriété avec la valeur
            // il faut qu'on le fasse "a la mano"

            // récupère la valeur saisie dans le formulaire
            // qui est déjà un objet DateTimeImmutable
            $watchedAt = $form->get('watchedAt')->getData();
            // on finit d'hydrater notre objet
            $review->setWatchedAt($watchedAt);

            $entityManager->persist($review);
            $entityManager->flush();

            // ajouter un flash message
            $this->addFlash('success', 'Commentaire ajouté');

            return $this->redirectToRoute('movie_show', ["id" => $movie->getId()]);
        }

        // afficher le formulaire
        return $this->renderForm('front/movie/review_add.html.twig', [
            'reviewForm' => $form,
            'movie' => $movie,
        ]);
    }
}