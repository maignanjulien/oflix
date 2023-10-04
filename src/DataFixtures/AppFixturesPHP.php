<?php

namespace App\DataFixtures;

use App\Entity\Casting;
use App\Entity\Genre;
use App\Entity\Movie;
use App\Entity\Person;
use App\Entity\Season;
use DateTimeImmutable;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class AppFixturesPHP extends Fixture
{
    public function load(ObjectManager $manager): void
    {
        $faker = \Faker\Factory::create();
        $faker->addProvider(new \Xylis\FakerCinema\Provider\Movie($faker));
        $faker->addProvider(new \Xylis\FakerCinema\Provider\TvShow($faker));
        
        // generate data by calling methods
        mt_srand(42);
        /* Création des genres */
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

            $manager->persist($genre);
            $genreObjectList[] = $genre;
        }

        /* Création des personnes */
        $actorList = [
            [
                'firstName' => 'Grégory',
                'lastName' => 'Peck',
            ],
        ];
        $personObjectList = [];
        for($nbPersonToAdd = 1 ; $nbPersonToAdd <= 500; $nbPersonToAdd++)
        {
            $person = new Person();
            $person->setFirstname($faker->firstname());
            $person->setLastname($faker->lastname());

            $manager->persist($person);
            $personObjectList[] = $person;
        }

        /* Création des Movies */
        $movieType = ['Série', 'Film'];

        // on pourrait se baser sur une liste précise de films
        // plutot que de générer que des Lorem Ipsum
        // $movieList = [
        //     [
        //         'title' => 'Rocky',
        //         ''
        //     ]
        // ];
        for ($numeroMovie = 1; $numeroMovie <= 200; $numeroMovie++)
        {
            $movie = new Movie();

            // on veut générer un lien vers lorem picsum
            // https://picsum.photos/id/1/200/300
            $posterUrl = "https://picsum.photos/id/" . mt_rand(0, 1084) . "/200/300";
            // $posterUrl = $faker->imageUrl(200, 300, 'animals', true);
            $movie->setPoster($posterUrl);
            $movie->setDuration(mt_rand(45, 180));
            $movie->setRating($faker->randomFloat(1, 0, 5));
            $movie->setTitle($faker->movie());
            $movie->setType($movieType[mt_rand(0, 1)]);
            $movie->setSynopsis($faker->realTextBetween(160, 200));
            $movie->setSummary($faker->realText(50));
            $movie->setReleaseDate($faker->dateTimeThisCentury());

            // association avec genre
            $nbGenreToAdd = mt_rand(1, 4);
            $faker->unique(true)->randomElement($genreObjectList);
            for( ; $nbGenreToAdd > 0; $nbGenreToAdd--)
            {
                // $randomGenreIndex = mt_rand( 0, count($genreObjectList) -1 );
                // $randomGenre = $genreObjectList[$randomGenreIndex];

                $randomGenre = $faker->randomElement($genreObjectList);
                $movie->addGenre($randomGenre);
            }

            // ajout de saisons
            // si c'est une série
            if ($movie->getType() === 'Série')
            {

                $movie->setTitle($faker->tvShow());
                // alors ajouter un nombre de saisons aléatoire ( entre 1 et 8 )

                $nbSeasonToAdd = mt_rand(1, 8);
                for( ; $nbSeasonToAdd > 0; $nbSeasonToAdd--)
                {
                    $season = new Season();
                    $season->setEpisodesNumber(mt_rand(3, 10));
                    $season->setNumber($nbSeasonToAdd);
                    $season->setMovie($movie);
        
                    $manager->persist($season);
                }
            }

            // ajout des castings

            $nbCastingToAdd = mt_rand(5, 25);
            $faker->unique(true)->randomElement($personObjectList);
            for( ; $nbCastingToAdd > 0; $nbCastingToAdd--)
            {
                $casting = new Casting();
                $casting->setMovie($movie);
                // todo éventuellement choisir de temps en temps un métier ( $faker->jobTitle())
                $casting->setRole($faker->name());
                $casting->setCreditOrder($nbCastingToAdd);

                // $randomPersonIndex = mt_rand( 0, count($personObjectList) -1 );
                // $randomPerson = $personObjectList[$randomPersonIndex];

                $randomPerson = $faker->unique()->randomElement($personObjectList);
                $casting->setPerson($randomPerson);

                $manager->persist($casting);
            }

            $manager->persist($movie);
        }
        
        $manager->flush();
    }
}