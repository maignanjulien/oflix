<?php

namespace App\Controller;

use App\Entity\Genre;
use App\Entity\Movie;
use App\Entity\Season;
use App\Form\MovieType;
use App\Form\SeasonType;
use App\Repository\GenreRepository;
use App\Repository\MovieRepository;
use DateTime;
use DateTimeImmutable;
use Doctrine\ORM\EntityManagerInterface;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\IsGranted;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/test")
 */
class TestController extends AbstractController
{

    /**
     * @Route("/droits", name="app_test_droits")
     */
    public function droits(MovieRepository $movieRepository)
    {

        $movie = $movieRepository->findOneBy([]);
        $this->denyAccessUnlessGranted('MOVIE_REVIEW_ADD', $movie);
        dd(__FILE__);
    }

    /**
     * @Route("/bogue/doctrine/{title}", name="app_test_bogue")
     * @IsGranted()
     */
    public function doctrineBogueLeRetour(Movie $movie)
    {
        dd($movie);
    }
    
    /**
     * @Route("/relation/{id<\d+>}", name="app_test_relation")
     */
    public function doctrineBogue(Movie $movie, GenreRepository $genreRepository, Request $request, EntityManagerInterface $entityManager)
    {
        $form = $this->createForm(movieType::class, $movie);

        dump($movie->getGenres());
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {

            dd($movie->getGenres());
            // l'utilisateur a soumis un formulaire, on peut le traiter efficacement

            // dump($form->get('genres')->getData());
            // $entityManager->persist($movie);
            // on commence par supprimer tous les genres qui sont actuellement associés au movie

            // sélectionner tous les genres de la BDD
            // pour chaque genre on retire le film actuel
            $allGenres = $genreRepository->findAll();
            foreach ($allGenres as $currentGenre)
            {
                $currentGenre->removeMovie($movie);
            }
            // $movie->removeAllGenre();
            // on associe chaque genre sélectionné dans le formulaire au movie actuel
            // en effet dans ce code c'est l'entité Genre qui est propriétaire de la relation ManyToMany
            // Il faut donc faire les modifications directement sur le genre
            foreach($form->get('genres')->getData() as $currentGenre)
            {
                // on modifie les relations entre movie et genre
                $currentGenre->addMovie($movie);
            }

            // les requetes d'insert / maj sont exécutés
            $entityManager->flush();
            // dd();
            // une fois l'insertion faite, on redirige l'utilisateur vers la page de détail du film
            return $this->redirectToRoute('movie_show', ['id' => $movie->getId()]);
        }


        return $this->renderForm('test/doctrine_bogue.html.twig', [
            'form' => $form,
        ]);

    }

    /**
     * @Route("/form", name="app_test_form")
     */
    public function demoForm(Request $request, EntityManagerInterface $entityManager): Response
    {
        $season = new Season();
        // $season->setEpisodesNumber(25);
        // permet de créer le formulaire de la classe SeasonType
        $form = $this->createForm(SeasonType::class, $season);

        // ici il est possible de modifier encore la définition du formulaire
        // $form->add('movie', EntityType::class, [
            // 'class' => Movie::class,
            // 'label' => 'Série',
            // 'choice_label' => 'id',
        // ]);
        // 

        // Ici symfony va vérifier dans la requete
        // - si on est en méthode POST
        // - si le token csrf est valide
        // - faire d'autres validations 
        // si tout est ok il va remplir l'objet season
        // avec les informations
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            // l'utilisateur a soumis un formulaire, on peut le traiter efficacement
            $entityManager->persist($season);
            $entityManager->flush();
            // une fois l'insertion faite, on redirige l'utilisateur vers la page de détail du film
            return $this->redirectToRoute('movie_show', ['id' => $season->getMovie()->getId()]);
        }


        return $this->renderForm('test/intro_form.html.twig', [
            'seasonForm' => $form,
        ]);
        // return $this->render('test/intro_form.html.twig', [
        //     'seasonForm' => $form->createView(),
        // ]);
    }

    /**
     * @Route("/", name="app_test_index", methods={"GET"})
     */
    public function index(MovieRepository $movieRepository): Response
    {
        return $this->render('test/index.html.twig', [
            'movies' => $movieRepository->findAll(),
        ]);
    }

    /**
     * @Route("/new", name="app_test_new", methods={"GET", "POST"})
     */
    public function new(Request $request, MovieRepository $movieRepository): Response
    {
        $movie = new Movie();
        $form = $this->createForm(MovieType::class, $movie);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $movieRepository->add($movie, true);

            return $this->redirectToRoute('app_test_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('test/new.html.twig', [
            'movie' => $movie,
            'form' => $form,
        ]);
    }

    /**
     * /test/populateDb
     * @Route("/{id<\d+>}", name="app_test_show", methods={"GET"})
     */
    public function show(Movie $movie): Response
    {
        return $this->render('test/show.html.twig', [
            'movie' => $movie,
        ]);
    }

    /**
     * @Route("/{id}/edit", name="app_test_edit", methods={"GET", "POST"})
     */
    public function edit(Request $request, Movie $movie, MovieRepository $movieRepository): Response
    {
        $form = $this->createForm(MovieType::class, $movie);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $movieRepository->add($movie, true);

            return $this->redirectToRoute('app_test_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('test/edit.html.twig', [
            'movie' => $movie,
            'form' => $form,
        ]);
    }

    /**
     * @Route("/{id}", name="app_test_delete", methods={"POST"}, requirements={"id"="\d+"})
     */
    public function delete(Request $request, Movie $movie, MovieRepository $movieRepository): Response
    {
        if ($this->isCsrfTokenValid('delete'.$movie->getId(), $request->request->get('_token'))) {
            $movieRepository->remove($movie, true);
        }

        return $this->redirectToRoute('app_test_index', [], Response::HTTP_SEE_OTHER);
    }


    /**
     * rempli la BDD avec des données des données de test
     * 
     * @Route("/populate_db", name="app_test_populate")
     */
    public function populateBd(EntityManagerInterface $entityManager): Response
    {
        // on peut préparer des données spécifiques
        $genreNames = [];
        $genreNames[] = 'Action';
        $genreNames[] = 'Animation';
        $genreNames[] = 'Aventure';
        $genreNames[] = 'Comédie';
        $genreNames[] = 'Dessin animé';
        $genreNames[] = 'Documentaire';
        $genreNames[] = 'Drame';
        $genreNames[] = 'Espionnage';
        $genreNames[] = 'Famille';
        $genreNames[] = 'Fantastique';
        $genreNames[] = 'Historique';
        $genreNames[] = 'Policier';
        $genreNames[] = 'Romance';
        $genreNames[] = 'Science-fiction';
        $genreNames[] = 'Thriller';
        $genreNames[] = 'Western';
        
        $genreObjectList = [];
        foreach ($genreNames as $currentGenreName)
        {
            $genre = new Genre();
            $genre->setName($currentGenreName);

            $entityManager->persist($genre);
            $genreObjectList[] = $genre;
        }

        
        $movieType = ['Série', 'Film'];

        // on pourrait se baser sur une liste précise de films
        // plutot que de générer que des Lorem Ipsum
        // $movieList = [
        //     [
        //         'title' => 'Rocky',
        //         ''
        //     ]
        // ];
        for ($numeroMovie = 1; $numeroMovie <= 10; $numeroMovie++)
        {
            $movie = new Movie();

            $movie->setDuration(mt_rand(45, 180));
            // on veut générer un lien vers lorem picsum
            // https://picsum.photos/id/1/200/300
            $posterUrl = "https://picsum.photos/id/" . mt_rand(0, 1084) . "/200/300";
            $movie->setPoster($posterUrl);
            $movie->setRating(mt_rand(0, 50) / 10);
            $movie->setTitle('Titre du Movie ' . $numeroMovie);
            $movie->setType($movieType[mt_rand(0, 1)]);
            $movie->setSummary($numeroMovie . ' Summary - Lorem, ipsum dolor sit amet consectetur adipisicing elit. Et consequatur modi, reiciendis quo fuga nisi nihil accusamus numquam similique ullam.');
            $movie->setSynopsis($numeroMovie . ' Synopsis - Lorem, ipsum dolor sit amet consectetur adipisicing elit');
            $movie->setReleaseDate(new DateTimeImmutable());


            // association avec genre
            $nbGenreToAdd = mt_rand(1, 4);
            for( ; $nbGenreToAdd > 0; $nbGenreToAdd--)
            {
                $movie->addGenre($genreObjectList[mt_rand(0, count($genreObjectList) -1 )]);
            }

            $entityManager->persist($movie);
        }
        // genre
        // casting
        // seasons

        // $movieRepository->add($movie, true);


        $entityManager->flush();
        return $this->redirectToRoute('home');
    }
}