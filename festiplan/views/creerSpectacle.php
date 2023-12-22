<!DOCTYPE HTML>
<html lang="fr">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>FESTIPLAN - Création de Spectacle</title>

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
        <div class="container-fluid">
            <div class="row">
                <div class="col-6">
                    <hspan class="titre">Festiplan</span>
                </div>
                <div class="col-6 contenue_droite">
                    <i class="fa-solid fa-user fa-4x"></i>
                    <hspan class="secondTitre">Mon Compte </hspan>
                </div>
            </div>
        </div>
    </header>
    <div class="contenue container">
        <div class="text-center col-12">
            <form method="post" class="formulaire bordure">
                <div class="row fondFormulaire textFormulaire">
                    <div class="col-md-4 col-sm-5 col-12">
                        <i class="fa-regular fa-plus fa-4x"></i>
                        Rajoutez une image (800x600 maximum) (optionnel)
                    </div>
                    <div class="col-8">
                        <div class="col-12">
                            <input type="text" name="nomSpectacle" placeholder="Tapez le titre (35 caractères max.)"
                                class="form-control" />
                        </div>
                        <br />
                        <div class="col-12 d-none d-md-block">
                            <input type="text" name="descSpectaclePC"
                                placeholder="Tapez la description (1000 caractères max.)" class="form-control" />
                        </div>
                    </div>
                    <div class="col-12 d-md-none">
                        <input type="text" name="descSpectacleTabletTel"
                            placeholder="Tapez la description (1000 caractères max.)" class="form-control" />
                    </div>
                </div>
            </form>
        </div>
    </div>
    <footer>
        <div class="container-fluid">
            <div class="row">
                <div class="col-6">
                    <! ICI ON MET LE BOUTON DE DECONEXION>
                </div>
                <div class="col-6 contenue_droite">
                    <img src="images/logo-iut.png" class="logo" id="logoIUT" alt="Logo IUT"
                        href="http://www.iut-rodez.fr" target="_blank" />
                </div>
            </div>
        </div>
    </footer>
</body>

</html>