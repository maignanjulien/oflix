E14 - prestations
défi de correction
cf dépôt https://github.com/O-clock-Zinc/S03E13-symfo-challenge-faq-gregoclock

Prestations de service
Dans symfony les classes du dossier srcs'appellent des services.

https://symfony.com/doc/5.4/service_container.html

Conteneur de service
Il y a un composant "Service Container" ( Conteneur de service ) qui se charge de :

lister toutes les classes qui sont dans le dossier src en tant que service
injecter les dépendances d'un service dans le constructeur d'un autre service
instancier les objets lorsque l'on on en a besoin et de conserver l'objet créé pour une utilisation ultérieure ( par exemple l'objet Request est le meme qui a été créé par symfony à la réception de la requête et dans le controler Back\MovieController:add)
Configuration
La configuration du conteneur de service se fait dans les fichiersconfig/services.yaml