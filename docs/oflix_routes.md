Itinéraires
FrontOffice
URL	Verbe HTTP	Manette	Méthode	contrainte	commentaire
/	OBTENIR	Avant\Principal	maison		page d'accueil du front-office
/film/liste	OBTENIR	Avant\Film	liste		
/film/{id}	OBTENIR	Avant\Film	montrer	identifiant = \d+	
/movie/{id}/review/ajouter	OBTENIR	Avant\Film	ajouter un commentaire	identifiant = \d+	afficher le formulaire
/movie/{id}/review/ajouter	POSTE	Avant\Film	ajouter un commentaire	identifiant = \d+	gérer le formulaire
BackOffice
URL	Verbe HTTP	Manette	Méthode	contrainte	commentaire
/dos/	OBTENIR	Retour\Principal	maison		page d'accueil du back-office
/retour/film/	OBTENIR	Retour\Film	parcourir		parcourir un film
/retour/film/{id}	OBTENIR	Retour\Film	lire	identifiant = \d+	film lu
/retour/film/{id}/edit	OBTENIR	Retour\Film	modifier	identifiant = \d+	montage de film : formulaire d'affichage
/retour/film/{id}/edit	POSTE	Retour\Film	modifier	identifiant = \d+	montage de film : gérer le formulaire
/retour/film/ajouter	OBTENIR	Retour\Film	ajouter		ajout de film : formulaire d'affichage
/retour/film/ajouter	POSTE	Retour\Film	ajouter		ajout de film : formulaire de gestion
/retour/film/{id}/supprimer	OBTENIR	Retour\Film	supprimer	identifiant = \d+	film supprimer
/retour/saison/	OBTENIR	Retour\Saison	parcourir		parcourir la saison
/retour/saison/{id}	OBTENIR	Retour\Saison	lire	identifiant = \d+	lecture de saison
/retour/saison/{id}/edit	OBTENIR	Retour\Saison	modifier	identifiant = \d+	édition de la saison : formulaire d'affichage
/retour/saison/{id}/edit	POSTE	Retour\Saison	modifier	identifiant = \d+	édition de saison : gérer le formulaire
/retour/saison/ajouter	OBTENIR	Retour\Saison	ajouter		ajout de saison : formulaire d'affichage
/retour/saison/ajouter	POSTE	Retour\Saison	ajouter		ajout de saison : formulaire de gestion
/retour/saison/{id}/delete	OBTENIR	Retour\Saison	supprimer	identifiant = \d+	saison supprimer
/retour/casting/	OBTENIR	Retour\Casting	parcourir		casting parcourir
/retour/casting/{id}	OBTENIR	Retour\Casting	lire	identifiant = \d+	casting lire
/retour/casting/{id}/edit	OBTENIR	Retour\Casting	modifier	identifiant = \d+	casting edit : formulaire d'affichage
/retour/casting/{id}/edit	POSTE	Retour\Casting	modifier	identifiant = \d+	casting modifier : gérer le formulaire
/retour/casting/ajouter	OBTENIR	Retour\Casting	ajouter		casting add : formulaire d'affichage
/retour/casting/ajouter	POSTE	Retour\Casting	ajouter		casting add : gérer le formulaire
/retour/casting/{id}/delete	OBTENIR	Retour\Casting	supprimer	identifiant = \d+