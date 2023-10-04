Requêtes défi de correction SQL
Récupérer tous les films.
D'abord sélectionner la base de données cinéma, puis :

SELECT * FROM movie;
Récupérer les acteurs et leur(s) rôle(s) pour un film donné.
SELECT person.firstname, person.lastname, casting.role FROM person INNER JOIN casting ON person.id = casting.person_id WHERE casting.movie_id = 14;
Récupérer les genres associés à un film donné.
SELECT genre.name FROM genre INNER JOIN movie_genre ON genre.id = movie_genre.genre_id WHERE movie_genre.movie_id = 14;
Récupérer les saisons associées à un film/série donné.
SELECT * FROM season WHERE movie_id = 14;
Récupérer les critiques pour un film donné.
SELECT * FROM review WHERE movie_id = 14;
Récupérer les critiques pour un film donné, ainsi que le nom de l'utilisateur associé.
SELECT review.*, user.nickname FROM review INNER JOIN user ON review.user_id = user.id WHERE review.movie_id = 14;
Calculer, pour chaque film, la moyenne des critiques par film (en une seule requête).
SELECT movie.title, AVG(review.rating) as global_rating FROM movie INNER JOIN review ON review.movie_id = 18;
Récupérer tous les films pour une année de sortie donnée.
SELECT * FROM movie WHERE YEAR(release_date) = 2010;
-- OU
SELECT * FROM movie WHERE `release_date`  BETWEEN '2014-01-01' AND '2014-12-31';
Récupérer tous les films pour un pneu donné (par ex. 'Epic Movie').
SELECT * FROM movie WHERE title = 'Epic Movie';
Récupérer tous les films dont le titre contient une chaîne donnée.
SELECT * FROM movie WHERE title LIKE '%pirate%';
Récupérer la liste des films de la page 2 (grâce à LIMIT).
SELECT * FROM movie LIMIT 2,5;
