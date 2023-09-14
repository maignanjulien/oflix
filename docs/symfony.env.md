# Composants obligatoires
### Apache-pack
Sert a avoir le fichier .htaccess
```bash
composer require symfony/apache-pack
```
Puis répondre yes
Et on a maintenant le fichier .htaccess dans le dossier public

### Donner les droits sur les dossier var/log et var/cache
```bash
chmod -R 777 var/cache var/log
```
