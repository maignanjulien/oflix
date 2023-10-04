Épisode 09
Les formulaires
Dans symfony tout se passe avec ce composant

Les étapes pour utiliser un formulaire :

installer le composant
Créer un formulaire de composants avec le maker
bin/console make:form
Dans le formType créé configurer le formulaire
le type de champ
Dans un contrôleur utiliser la fonction createFormpour créer un formulaire
Toujours dans le contrôleur fournir ce formulaire à une vue twig
Attention, pensez à utiliser la bonne méthoderenderForm
Dans la vue utiliser les fonctions spécifiques de twig pour afficher le formulaire
Pensez à utiliser form_start et form_end pour pouvoir ajouter le bouton de validation par exemple
Traiter le formulaire