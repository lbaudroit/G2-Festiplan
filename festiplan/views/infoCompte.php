<!DOCTYPE HTML>
<html>
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
		<title>FESTIPLAN - Information</title>
		
        <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css"
        integrity="sha512-DTOQO9RWCH3ppGqcWaEA1BIZOC6xxalwEsw9c2QQeAIftl+Vegovlnee1c9QX4TctnWMn13TZye+giMm8e2LwA=="
        crossorigin="anonymous" referrerpolicy="no-referrer" rel="stylesheet" />
    
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css"
        integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous"
        rel="stylesheet">
    
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL"
        crossorigin="anonymous"></script>

        <link rel="stylesheet" href="..\css\style.css">
    </head>
    <body>
        <header>
            
                <hspan class="titre">Festiplan</span>
            
        </header>
        <div class="container contenue">
            <div class="row">
                <h3>Information du compte</h3>
            </div>
            <form method="post">
                <div class="row">
                    <div class="col-md-5 col-12 part_form">
                        Nom:</br>
                        <input type="text" class="form-control">
                    </div>
                    <div class="col-md-5 offset-md-2 col-12 part_form">
                        Prenom:</br>
                        <input type="text" class="form-control">
                    </div>
                    <div class="col-md-5 col-12 part_form">
                        email:</br>
                        <input type="text" class="form-control">
                    </div>
                    <div class="col-md-5 offset-md-2 col-12 part_form">
                        Mot de passe:</br>
                        <input type="text" class="form-control">
                    </div>
                </div>
                <div class="row">
                    <div class="offset-md-2 col-md-4 col-sm-6 col-12 part_form bloc-centrer">
                        <button type="submit" class="btn-modif btn-rouge">Supprimer compte</button>
                    </div>
                    <div class="col-md-4 col-sm-6 col-12 part_form bloc-centrer">
                        <button type="submit" class="btn-bleu btn-modif">Sauvegarder changements</button>
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
                        <img src="../images/logo-iut.png" class ="logo" id="logoIUT" alt="Logo IUT" href="http://www.iut-rodez.fr" target="_blank"/>
                    </div>
                </div>
            </div>
        </footer>
    </body>
</html>