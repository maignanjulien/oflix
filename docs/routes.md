En Symfony, il est possible de définir les routes de notre application via :

- le fichier `routes.yaml` qui se situe dans le dossier `config`
- les annotations directement dans les méthodes de nos contrôleurs

> 💡 **Symfony recommande l'utilisation des annotations** pour la définition des routes, car il est plus approprié de mettre les routes et les contrôleurs au même endroit.

## Les annotations

### Installation du composant `annotations`

Pour cette partie, nous aurons besoin du composant `annotations` de Symfony. Pour l'installer il nous faudra taper cette ligne de commande à la racine de notre projet `composer require annotations`.

Une fois que c'est fait, nous pouvons accéder à la liste de nos routes en tapant cette commande `php bin/console debug:router`.

👀 Si nous tapons cette dernière commande, alors nous verrons que, pour l'instant, il y a beaucoup de routes en lien avec le Profiler, mais nous n'allons pas y prêter attention pour le moment (ces routes commencent par `_`).

### C'est par où chef ?

Les annotations, nous permettant de mettre en place nos routes, sont chacune rattachées à la méthode appropriée d'un contrôleur... de ce fait, nous allons devoir commencer par nous créer un contrôleur.

Imaginons que nous ayons créé un fichier `HomeController.php` dans notre dossier `src/Controller`, contenant une classe `HomeController` ayant une méthode `index` dont le but est d'afficher "Bonjour" en page d'accueil, autrement dit sur la route `/` de notre projet.

```php
<?php

namespace App\Controller;

use Symfony\Component\HttpFoundation\Response;
// Doc Symfo : https://symfony.com/doc/current/routing.html#creating-routes
use Symfony\Component\Routing\Annotation\Route;

class HomeController
{
    /**
     * Page d'accueil disant "Bonjour"
     * 
     * @Route("/")
     *
     * @return Reponse
     */
    public function index(): Response
    {
        // Symfony attend toujours un return de type Response
        // C'est pourquoi un echo('Bonjour'); produirait une erreur
        return new Response('Bonjour');
    }
}
```