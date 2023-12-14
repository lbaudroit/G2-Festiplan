<!DOCTYPE html>
<html lang="fr">

<head>
    <title>Accueil - Festiplan</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css"
        integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous"
        rel="stylesheet">
    <link rel="stylesheet" href="../css/Inscription.css" > 
    <link rel="stylesheet" href="../css/style.css">
</head>
<body>
    <header class="row fondbleu text-center">
            <div class="col-1 titre">
                <h3>Festiplan</h3>
            </div>
    </header>
    <div class="container">
        <div class="row">
            <div class="col-md-12 page">
				<div class="offset-2 col-8 offset-sm-2 col-sm-8 offset-md-4 col-md-4 cadre">
					<img src="../images/compte_utilisateur_ombre.png">
					<form>
						<div class="offset-2 col-8 offset-sm-2 col-sm-6 offset-md-2 col-md-6 formulaire">
							<label for="nom">nom:</label><br>
							<input type="text" id="nom" name="nom"><br>
							<label for="nom">prenom:</label><br>
							<input type="text" id="prenom" name="prenom"><br>
							<label for="identifiant">identifiant:</label><br>
							<input type="text" id="identifiant" name="identifiant"><br>
							<label for="motdepasse">mot de passe:</label><br>
							<input type="text" id="motdepasse" name="motdepasse"><br>
							<label for="email">email:</label><br>
							<input type="text" id="email" name="email">
						</div><br>
						<div class="offset-3 col-6 offset-sm-3 col-sm-6 offset-md-3 col-md-6">
							<button type="button" class="btn btn-primary btn-block"> Valider <i class="fa-solid fa-envelope"></i></button>
							<a href="authentification.php" class="texte_lien">Se connecter</a><br>
						</div>
					</form>		
				</div>
			</div>
        </div>
    </div>
    <footer class ="row fondbleu">
            <div class="offset-10">
				<!--- Logo et lien IUT -->
				Réalisé par <br/><a href="http://www.iut-rodez.fr" target="_blank"><img src="../images/logo-iut.png" class ="image" id="logoIUT" alt="Logo IUT" /></a>
		    </div>
    </footer>
</body>
</html>