E13 - Injection de dépendance
Dans un Service
On utilise le constructeur des classes pour demander à Symfony les autres classes dont le service a besoin.

Ici AppUserFixturesun besoin de UserPasswordHasherInterface. On ajoute donc la méthode __constructavec une variable en paramètre

Ensuite on stocke la classe dans une propriété

On peut réutiliser cette classe partout dans notre se