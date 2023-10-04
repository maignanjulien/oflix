Épisode 10
FORMULAIRE - Les contraintes de validation
On peut ajouter des contraintes de validations des données saisies dans un formulaire ( la validation se fait lorsque l'on exécute $form->isValid()dans le contrôleur)

Pour les ajouter il y a deux facons de faire :

dans la classe de formulaire ( avec l'option constraints)
en annotation dans l'entité ( méthode conseillée car plus modulable )
Migrations de rappels
Toujours garder la cohérence entre les entités, les migrations et la BDD
S'assurer que la migration ne provoque pas de perte de données
Si nécessaire, on doit ajouter des requêtes de récupération de données
Ne pas supprimer les migrations que l'on a push
Les solutions en dev
Tant que l'on est en dev, on peut supprimer notre BDD et la récréer.

bin/console doctrine:database:drop --force
bin/console doctrine:database:create
bin/console doctrine:migrations:migrate
bin/console doctrine:fixtures:load
Rappel Essayer Attraper
un bloc try catch va tester le code qui est dans le try et récupérer les exceptions qui auront été lancées par ce code On peut alors exécuter du code qui va gérer cette exception

try {
   uneFonctionQuiEnvoieUneException();
}
catch (Exception $e)
{
   // afficher un log
   // envoyer un mail à l'admin
   // afficher un message à l'utilisateur
}

function uneFonctionQuiEnvoieUneException()
{
   throw new Exception('Ca ne fonctionne pas');
}
Symfony englobe l'appel des contrôleurs dans un try catch si il attrape l'exception NotFoundHttpException alors il affiche une page 404 avec le message d'erreur

Le champ DateTime du formulaire
Si l'utilisateur ne saisit pas de valeur, le composant formulaire essaie d'enregistrer la valeur NULL dans le champ watchAt

Pour éviter cela sur va :

demander au composant form de ne pas enregistrer la valeur saisie par l'utilisateur dans l'objet Review lors de l'appel à la fonction $form->handleRequest(mapped = false dans le formType )
valider les valeurs du formulaire
si les valeurs sont valides ( la date )
enregistrer la date dans l'objet Review