Création d'un service TimeConverter
Objectif
Créez un service qui convertit une durée en minute en affichage en heure minute secondes.

Voila quelques exemples qu'il faudra gérer :

durée en minutes (float)	résultat attendu (string)
60	'1h'
.5	'30'
1	'1 minute'
1,5	'1min 30s'
61,5	'1h 1min 30s'
60,5	'1h 0min 30s'
1440	'1j'
10080	'1sem'
10081	'1 sem 0j 0h 1min'
11520	'1sem 1j'
Étapes
Créer une classe TimeConverter ( choisissez le nom du dossier que vous voulez Helper, Utilitypar exemple)
ajouter une méthode convertir qui attend un float en paramètre et qui renvoie une chaîne de caractère
coder la fonction qui va gérer les différents cas
Vous n'êtes pas obligé de coder tous les cas ( les 5 premiers c'est déjà pas mal )
astuce facultative, codez le 1er cas puis le second, n'essayez pas de tout faire d'un coup
astuce facultative, faire peut être une route dans un contrôleur qui testera toutes les valeurs et qui vous affichera si c'est ok ou pas
Utiliser le service dans la méthode show d'un Movie pour
convertir la durée avec le service
fournir cette valeur au modèle
cette valeur afficher dans le modèle
Prime
Regarder dans la documentation comment faire pour pouvoir utiliser le service depuis twig
Coder le maximum du cas du tableaux