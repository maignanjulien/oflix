Épisode 11
Rappel EntityManager / Référentiel / Entité
En résumé
Créer une nouvelle ligne en BDD
// 1. créer une instance de l'entité
$newGenre = new App\Entity\Genre();
// 2. hydrater l'entité
$newGenre->setName('PHP');
// 3. ajouter l'entité à l'em
$em->persist($newGenre);
// 4. lancer les requêtes d'insertion
$em->flush();
// 5. Tada j'ai une nouvelle ligne dans ma BDD ! good job
Modifier une ligne en BDD
Ici lors de la récupération de l'entité par le référentiel, ce dernier "se charge de faire" le $em->persist() de tous les éléments récupérés ( cf explications ci-dessous )

// 1. récupérer une entité depuis la BDD ( avec le repository ou le paramConverter si on est dans un controller )
$genre = $genreRepository->find(42);
// 2. modifier l'entité dans le code PHP
$genre->setName('Symfony');
// 3. lancer les requetes d'insertion
$em->flush();
Dans les détails
Ces 3 composants sont essentiels pour gérer les données de notre application.

Entité
L'entité nous sert à manipuler les données de notre application dans le code PHP. Avec une entité sur va :

modifier des valeurs ( avec les getter / setter )
modifier les relations ( /!\ attention au propriétaire pour les Many2Many /!\ )
Dépôt
Le référentiel sert à effectuer des requêtes de sélection dans la BDD.

Il existe 4 méthodes par défaut :

find($id) => qui récupère UN élément par son id
findOneBy() => qui récupère UN élément qui répond à une liste de critères ( le premier de la liste si plusieurs éléments correspondant aux critères )
findAll() => qui récupère UN TABLEAU de tous les éléments en BDD
findBy => qui récupère UN TABLEAU de tous les éléments qui répondent à une liste de critères
On peut également ajouter des requêtes personnalisées selon nos besoins. Pour cela on peut utiliser :

du DQL ( vu en cours )
le queryBuilder ( voir la doc )
du SQL classique ( voir la doc )
Gestionnaire d'entités
L'entityManager ( em pour lesflemmardsdev ) est en charge d'exécuter les requêtes de mises à jour / insertion dans la BDD. Pour cela il tient une liste des entités à "suivre".

/!\ L'orsque l'on fait une requête à l'aide d'un référentiel, le résultat de la requête est ajouté à la liste des éléments à suivre de l'em ! /!\

il y a deux fonctions importantes :

$em->persist($uneEntite) => qui va ajouter $uneEntiteà la liste des entités à suivre ( utile si on crée une entité dans notre code PHP et que l'on souhaite l'enregistrer en BDD )
$em->flush() => qui va constater les modifications réalisées dans les entités ( grâce au code PHP ) et faire les requêtes d'insertion / maj nécessaires
Back-office de correction
Création du fichier
Création du contrôleurbin/console make:controller Back\\Main
Film Création du Contrôleurbin/console make:controller Back\\Movie