<!DOCTYPE HTML>
<html lang="fr">
    <head>
        <meta charset="utf-8">
		<title>FESTIPLAN - Création de Scène</title>
		
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
        <div class = "contenue container">
            <div class="col-12">
                <form method="post" class="formulaire">
                    <div class ="row">
                        <u class ="text-center textFormulaire"><hspan class="titre">
                            Ajout d'une scène
                        </span></u>
                        <u class ="offset-2 col-4"><h5>
                            Nom de la scène :
                        </h5></u>
                        <input type="text" id="nomScene" name="nomScene" class="offset-1 col-3 textFormulaire" placeholder="Entrer le nom de la scène (35 caractères max.)" <?php
                            if (isset($_POST['nomScene']) && strlen($nomScene < 35)) {
                                echo 'value="'. $_POST['nomScene'] .'"';
                            }?>
                        />
                    </div>
                    <div class ="row textFormulaire">
                        <u class ="offset-2 col-4"><h5>
                            Coordonnées GPS :
                        </h5></u>
                        <input type="text" id="coordGPS" name="coordGPS" class ="textFormulaire offset-1 col-3" <?php
                            if (isset($_POST['coordGPS'])) {
                                echo 'value="' . $_POST['coordGPS'] . '"';
                            }?>
                        />
                    </div>
                    <div class ="row">
                        <u class ="offset-2 col-4"><h5>
                            Nombre de specteteurs maximum :
                        </h5></u>
                        <input type="text" id="nbMaxSpec" name="nbMaxSpec" class ="textFormulaire offset-1 col-3" <?php
                            if (isset($_POST['nbMaxSpec'])) {
                                echo 'value="' . $_POST['nbMaxSpec'] . '"';
                            }?>
                        />
                    </div>
                    <div class ="row">
                        <u class ="offset-2 col-4"><h5>
                            Taille minimum requise :
                        </h5></u>
                        <select name="tailleScene" id="tailleSceneSelect" class ="textFormulaire text-center offset-1 col-3 ">
                            <option value="default">Choisir une taille de scène</option>
                            <option value="petite">Petite</option>
                            <option value="moyenne">Moyenne</option>
                            <option value="grande">Grande</option>
                        </select>
                    </div>
                    <div class ="row">
                        <button type="button" class="offset-2 col-3 btn btn-rouge">Annuler</button>
                        <button type="button" class="offset-2 col-3 btn btn-bleu">Ajouter la scène</button>
                    </div>
                </form>
            </div>
        </div>
        <footer>
            <div class="container-fluid">
                <div class="row">
                    <div class="col-6">
                        <form method="post" action="./index.php?controller=Deconnexion">
                            <button name="deconnexion" class="btn-deco d-none d-md-block d-sm-block my-auto">
                                <i class="fa-solid fa-power-off"></i>
                                Deconnexion
                            </button>
                            <button name="deconnexion" class="btn-deco-rond d-md-none d-sm-none">
                                <i class="fa-solid fa-power-off"></i>
                            </button>
                        </form>
                    </div>
                    <div class="col-6 contenue_droite">
                        <img src="images/logo-iut.png" class ="logo" id="logoIUT" alt="Logo IUT" href="http://www.iut-rodez.fr" target="_blank"/>
                    </div>
                </div>
            </div>
        </footer>
    </body>
</html>