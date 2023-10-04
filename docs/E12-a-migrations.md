E12
Parfois, une migration va générer une erreur.

Les différents cas possibles
aucune migration commise / ou je travaille seul(e) sur mon projet
En cas de soucis dans ce cas, on peut :

supprimer tous les fichiers de Migrations
supprimer le BDD
recréer la BDD
relancer un make:migrations
appliquer les migrations
recharger les luminaires
rm migrations/*
bin/console doctrine:database:drop --force
bin/console doctrine:database:create
bin/console make:migration
bin/console doctrine:migrations:migrate
bin/console doctrine:fixtures:load
migration déjà commit et push sur github
Dans ce cas on ne peut pas se permettre de supprimer nos fichiers de migrations

supprimer la dernière migration en erreur ( qui n'a pas été commit )
supprimer le BDD
recréer la BDD
appliquer les migrations
relancer un make:migrations
appliquer les migrations
recharger les luminaires
# supprimer la derniere migration "à la main"
bin/console doctrine:database:drop --force
bin/console doctrine:database:create
bin/console doctrine:migrations:migrate
bin/console make:migration
bin/console doctrine:migrations:migrate
bin/console doctrine:fixtures:load
migration déjà commit et push sur github
Lorsque l'application finale est déjà en production, on ne peut pas se permettre de supprimer nos données pour qu'une migration puisse s'appliquer correctement

La il va falloir modifier la migration pour qu'elle conserve les données de production !

vérifier quelle demande pose problème ( erreur SQL de contrainte de clef étrangère ) dans la migration
trouver comment éviter ce problème
ajouter les requêtes dans le fichier de migration
annuler ce qui a été fait en BDD
à partir de la demande en erreur; remonter les requêtes et annuler leur application avec administrateur ( par exemple create table => supprimer la table; add column => supprimer la colonne )
relancer la migration
recommencer en 1 s'il y a encore une erreur