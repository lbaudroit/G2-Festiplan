<!DOCTYPE HTML>
<html>
    <head>
        <meta charset="utf-8">
		<title>FESTIPLAN - authentification</title>
		
        <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css"
        integrity="sha512-DTOQO9RWCH3ppGqcWaEA1BIZOC6xxalwEsw9c2QQeAIftl+Vegovlnee1c9QX4TctnWMn13TZye+giMm8e2LwA=="
        crossorigin="anonymous" referrerpolicy="no-referrer" rel="stylesheet" />
    
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css"
        integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous"
        rel="stylesheet">
    
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL"
        crossorigin="anonymous"></script>
        <link rel="icon" href="favicon.ico" />
        <link rel="stylesheet" href="css\style.css">
    </head>
    <body>
        <header>
            <hspan class="titre">Festiplan</span>
        </header>

        <div class = "contenue container">
            <div class="text-center col-12">
                <h1>Bienvenue sur le site Festiplan</h1><br/>
                <h2>Connectez-vous pour reprendre la planification de vos féstivals ou spectacle.<br/>
                Ou inscrivez-vous pour commencer à créer !</h2>
            </div>
            <form method="post" class="bordure formulaire">
                <div class ="col-12 text-center">
                    <i class="fa-solid fa-user fa-4x"></i>
                </div>
                <div class="row textFormulaire">
                    <div class="col-12">
                        Identifiant : 
                        <br/>    
                        <input type="text" name="identifiant" placeholder="Entrez votre Identifiant" class="form-control"/>
                    </div>
                    <br/>
                    <div class="col-12">
                        Mot de passe : 
                        <br/>
                        <input type="text" name="pswd" placeholder="Tapez votre mot de passe" class="form-control"/>					
                    </div>
                    <br/>
                    <div class="col-12 text-center">
                        <input class="btn bordure" type="submit" value="Se connecter">
                    </div>
                    <div class="col-12 text-center">
                        <a href = "creerCompte.php">Créer un compte</a>
                    </div>
                </div>
            </form>
        </div>
        <footer>
            <div class="container-fluid">
                <div class="row">
                    <div class="col-6">
                        <! ICI ON MET LE BOUTON DE DECONEXION>
                    </div>
                    <div class="col-6 contenue_droite">
                        <img src="images/logo-iut.png" class ="logo" id="logoIUT" alt="Logo IUT" href="http://www.iut-rodez.fr" target="_blank"/>
                    </div>
                </div>
            </div>
        </footer>
    </body>
</html>