<?php

namespace App\Repository;

use App\Entity\Movie;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<Movie>
 *
 * @method Movie|null find($id, $lockMode = null, $lockVersion = null)
 * @method Movie|null findOneBy(array $criteria, array $orderBy = null)
 * @method Movie[]    findAll()
 * @method Movie[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class MovieRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Movie::class);
    }

    public function add(Movie $entity, bool $flush = false): void
    {
        $this->getEntityManager()->persist($entity);

        if ($flush) {
            $this->getEntityManager()->flush();
        }
    }

    public function remove(Movie $entity, bool $flush = false): void
    {
        $this->getEntityManager()->remove($entity);

        if ($flush) {
            $this->getEntityManager()->flush();
        }
    }

   /**
    * @return Movie[] Returns an array of Movie objects
    */
    public function findOrderedByTitle($limit = 2): array
    {
        $entityManager = $this->getEntityManager();

        // requete en DQL ( Doctrine Query Language )
        // SELECT movie.*
        // FROM movie
        // ORDER BY movie.duration DESC
        // LIMIT 2
        $query = $entityManager->createQuery(
        'SELECT m
        FROM App\Entity\Movie m
        ORDER BY m.duration DESC'
        )->setMaxResults($limit);

        // returns an array of Product objects
        return $query->getResult();
    }

    public function findWithAssociatedData($movieId): ?Movie
    {
        // l'entityManager fait le lien entre les objets en PHP et les lignes dans la BDD
        // lorsque l'on lance la méthode flush(), l'entityManager
        // - mettre à jour les entités que l'on a récupéré de la BDD uniquement si elles ont été modifiées par du code PHP
        // - insérer les entités créées en PHP et que l'on souhaite enregistrer en BDD ( grace à la méthode persist )
        $entityManager = $this->getEntityManager();
        /*
        SELECT movie.*
        FROM movie
        INNER JOIN genre_movie ON  movie.id = genre_movie.movie_id
        INNER JOIN genre ON genre.id = genre_movie.genre_id
        WHERE movie.id = :movieID
        */

        $query = $entityManager->createQuery(
        'SELECT m, g, c, p, s
        FROM App\Entity\Movie m
        LEFT JOIN m.genres g
        LEFT JOIN m.castings c
        LEFT JOIN c.person p
        LEFT JOIN m.seasons s
        WHERE m.id = :id
        ');
        $query->setParameter('id', $movieId);

        // returns an array of Product objects
        return $query->getOneOrNullResult();
    }
}