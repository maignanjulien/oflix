## Projet Symfony

### Créer un projet Symfony
Pour créer un projet Symfony, il faut deja des pré-requis :
- PHP => Oui car Symfony est un framework PHP
- Composer => Pour installer les librairies/dépendances du projet

Une fois qu'on a les pré-requis, on peut exécuter la commande :
```bash
composer create-project symfony/skeleton oflix
```
symfony/skeleton = c'est la version "squelette" de symfony, cad que c'est la version la plus minimale de symfony qui existe (avec le moi s de config possible).
oflix = c'est le no du projet

## Structure du dossier
### Le dossier bin
Le dossier ne contient qu'un fichier => console
Le fichier console sert à effectuer des commandes symfony => c'est le CLI de symfony (comme artisan avec Laravel).
### Le dossier config
Le dossier config est le dossier qui contient tous les fichiers de configuration de notre projet Symfony. On peut y retrouver des fichier .yaml et des fichiers .php.
### Le dossier public
Le dossier public est le dossier qui contient tous les fichiers statiques. Parmis eux, on va retrouver index.php, mais aussi tous les fichiers CSS, JS, les images, etc ...
### Le dossier src
Le dossier src est le dossier qui va contenir le code source de notre application.
Ce dossier va contenir nos modèles, nos contrôleurs, nos vues, nos entités, nos repositories, nos classes PHP personnalisées, etc ...
### Le dossier var
Le dossier var est le dossier qui va contenir tous les logs et le cache de notre projet. C'est la ou on a des fichiers temporaires avec les logs écrit dessus.
### Le dossier vendor
Le dossier vendor est le dossier qui va contenir toutes les dépendances installées de notre projet. C'est la ou sont installés les dépendances.
### Le fichier .env
C'est le fichier qui contient les variables d'environnement pour notre application. Il est utilisé pour stocker des configurations spécifiques à l'environnement (par exemple, les informations de la base de donnée).
### Le fichier .gitignore
C'est le fichier qui contient tous ce qu'on ne veut pas push sur le repo git distant. Tres important car permet de ne pas push ce qui est propre à notre repo local, comme par exemple :
- Le dossier var => contient des fichiers de logs donc propres à nos projet en local
- Le dossier vendor => toutes les dépendances sont installés dedans, on évite de push ce dossier car peut vite devenir trop lourd. (Pour installer les dépendances d'un projet, il suffit de les installer en local avec composer install)