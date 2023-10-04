E12 - Sécurité
La Sécurisation ( en général )
On retrouve toujours ces 4 étapes lorsque l'on veut sécuriser un système

Enregistrement dans le système
Authentification
Identification
Se souvenir que l'utilisateur s'est authentifié
Session
Autorisation
Les rôles
autoriser certaines à certains utilisateurs ( ACL )
Mise en place dans Symfony
'input' => 'datetime', Tout se passe ici : https://symfony.com/doc/5.4/security.html

Enregistrement dans le système
Installer le composantcomposer require symfony/security-bundle
Créer une entité qui va nous servir de base pour l'authentificationbin/console make:user
Pour générer un mot de passebin/console security:hash-password
Authentification
Créer un contrôleur et le configurer comme indiqué dans la documentation

manette
fichier security.yaml
vue