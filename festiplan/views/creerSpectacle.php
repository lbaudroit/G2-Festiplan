<!DOCTYPE HTML>
<html lang="fr">
    <head>
        <meta charset="utf-8">
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
        <div class = "contenue container">
            <div class="col-12">
                <form method="post" class="formulaire">
                    <div class = "row text-center textFormulaire bordure fondFormulaire">
                        <div class ="col-md-4 col-sm-5 col-12 bordure">
                            <i class="fa-regular fa-plus fa-4x"></i>
                            <br/>
                            Rajoutez une image (800x600 maximum) (optionnel)
                        </div>
                        <div class ="col-sm-7 d-none d-sm-block d-md-none my-auto">
                            <input type="text" name="nomSpectacleTab" placeholder="Tapez le titre (35 caractères max.)" class="form-control"/>
                        </div>        
                        <div class = "col-8">
                            <div class ="col-12 d-sm-none d-md-block">
                                <input type="text" name="nomSpectaclePCetTel" placeholder="Tapez le titre (35 caractères max.)" class="form-control"/>
                            </div>
                            <div class ="col-12 d-none d-md-block">
                                <label for="descSpectaclePC"></label>
                            <textarea id="descSpectaclePC" name="descSpectaclePC" placeholder="Tapez la description (1000 caractères max.)" class="form-control"></textarea>
                            </div>
                        </div>
                        <div class = "col-12 d-md-none">
                            <label for="descSpectacleTabetTel"></label>
                            <textarea id="descSpectacleTabetTel" name="descSpectacleTabetTel" placeholder="Tapez la description (1000 caractères max.)" class="form-control"></textarea>
                        </div>
                    </div>
                    <div class ="row text-center">
                        <div class="bordure col-md-3 col-sm-6 col-12">
                            <u>
                                Durée du Spectacle :    
                            </u>
                            <br/>
                            <input type="text" name="HeureSpectacle" class=" text-center col-3" placeholder="HH" class="form-control"/>
                            :
                            <input type="text" name="MinuteSpectacle" class="text-center col-3" placeholder="MM" class="form-control"/>
                        </div>
                        <div class="bordure col-md-3 col-sm-6 col-12">
                            <label for="tailleSceneSelect">
                                <u>
                                Surface de la scène requise :
                                </u>
                            </label>
                            <select name="tailleScene" id="tailleSceneSelect">
                                <option value="default">Choisir une taille de scène</option>
                                <option value="petite">Petite</option>
                                <option value="moyenne">Moyenne</option>
                                <option value="grande">Grande</option>
                            </select>
                        </div>
                        <div class="bordure col-md-6 col-12">
                            <u>
                                Categories :
                            </u> 
                            <br/>
                            <input type="radio" id="btnMusique" name="btnMusique" value="musique"/>
                            <label for="btnMusique">Musique</label>

                            <input type="radio" id="btnTheatre" name="btnTheatre" value="theatre"/>
                            <label for="btnTheatre">Théâtre</label>

                            <input type="radio" id="btnCirque" name="btnCirque" value="cirque"/>
                            <label for="btnCirque">Cirque</label>

                            <input type="radio" id="btnDanse" name="btnDanse" value="danse"/>
                            <label for="btnDanse">Danse</label>
                            
                            <input type="radio" id="btnProjFilm" name="btnProjFilm" value="projFilm"/>
                            <label for="btnProjFilm">Projection de film</label>
                        </div>
                    </div>
                    <div class = "row">
                        <div class="text-center col-md-6 bordure">
                            <u>
                                Listes des intervenants sur scène :
                            </u>
                        </div>
                        <div class="text-center col-md-6 bordure">
                            <u>
                                Listes des intervenants hors scène :
                            </u>
                        </div> 
                    </div>
                    <div class="row">
                        <div class="col-md-6 bordure">
                            <div class="row">
                                <div class = "col-6">
                                    <h4>Intervenant 1</h4>
                                </div>
                                <div class ="col-6 contenue_droite">
                                    <i class="fa-solid fa-trash-can fa-2x"></i>
                                    <input class="btn btn-bleu" type="submit" value="Modifier">
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6 bordure">
                            <div class="row">
                                <div class = "col-6">
                                    <h4>Intervenant 1</h4>
                                </div>
                                <div class ="col-6 contenue_droite">
                                    <i class="fa-solid fa-trash-can fa-2x"></i>
                                    <input class="btn btn-bleu" type="submit" value="Modifier">
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6 bordure">
                            <div class="row">
                                <div class = "col-6">
                                    <h4>Intervenant 2</h4>
                                </div>
                                <div class ="col-6 contenue_droite">
                                    <i class="fa-solid fa-trash-can fa-2x"></i>
                                    <input class="btn btn-bleu" type="submit" value="Modifier">
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6 bordure">
                            <div class="row">
                                <div class = "col-6">
                                    <h4>Intervenant 2</h4>
                                </div>
                                <div class ="col-6 contenue_droite">
                                    <i class="fa-solid fa-trash-can fa-2x"></i>
                                    <input class="btn btn-bleu" type="submit" value="Modifier">
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class ="row">
                        <div class="col-md-6 bordure text-center">
                                <i class="fa-regular fa-plus fa-2x"></i>                         
                        </div>
                        <div class="col-md-6 bordure text-center">
                                <i class="fa-regular fa-plus fa-2x"></i>                     
                        </div>
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