E13
Autorisation
Une fois l'utilisateur connecté, il y a plusieurs facon d'empecher l'accès à une page

dans le security.yaml ( pratique pour protéger de grandes sections du site rapidement )
dans le contrôleur
par annotation ( sur la classe ou sur une route en particulier grâce à l'annotation IsGranted)
en PHP avec la fonction$this->denyAccessUnlessGranted()
dans la vue avecis_granted
Les électeurs
Dans le cas ou les règles de gestion ne sont pas "simples", on peut créer des électeurs personnalisés pour gérer les droits d'accès

bin/console make:voter
Dans la classe créée les méthodes supportset voteOnAttributedoivent renvoyer un booléen en fonction des paramètres fournis.

supportsrépond à la question : Veux tu voter ( pour cet attribut et cet objet ) ? voteOnAttributerépond à la question : Quel est ton vote ( pour cet attribut et cet objet et l'utilisateur courant ) ?