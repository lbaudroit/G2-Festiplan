<!DOCTYPE HTML>

<html lang="fr">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
		<title>FESTIPLAN - Creation de compte</title>
		
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
        <link rel="stylesheet" href="css\authentification.css">
    </head>
    <body>
        <header>
            <hspan class="titre">Festiplan</span>
        </header>
        <div class = "contenue container">
            <form method="post" class="bordure formulaire leFormulaire" >
                <div class ="col-12 text-center">
                    <i class="fa-solid fa-user fa-4x"></i>
                </div>
                <div class="row textFormulaire">
                    <div class="col-12">
                        <span class="<?php
                            $formulaireValide = true;
                            $leBool=preg_match("/^.{1,35}$/", $_POST['nom'])==1;
                            
                            if (isset($_POST['nom']) && !$leBool){
                                echo "enRouge";
                                $formulaireValide = false;
                            }?>">Nom :<?php
                            if (isset($_POST['nom']) && !$leBool){
                                echo " <br/> le nom ne dois pas etre vide ou depasser 35 charactere";
                            }?>
                        </span> 
                        <br/>    
                        <input type="text" name="nom" placeholder="Entrez votre Nom" class="form-control" <?php
                        if (isset($_POST['nom'])){
                            echo 'value="'.$_POST['nom'].'"';
                        }
                        ?>/>
                    </div>
                    <div class="col-12">
                        <span class="<?php
                            $leBool=preg_match("/^.{1,35}$/", $_POST['prenom'])==1;
                            
                            if (isset($_POST['prenom']) && !$leBool){
                                $formulaireValide = false;
                                echo "enRouge";
                            }?>">Prenom :<?php
                            if (isset($_POST['prenom']) && !$leBool){
                                echo " <br/> le prenom ne dois pas etre vide ou depasser 35 charactere";
                            }?>
                        </span>  
                        <br/>    
                        <input type="text" name="prenom" placeholder="Entrez votre Prenom" class="form-control" <?php
                        if (isset($_POST['prenom'])){
                            echo 'value="'.$_POST['prenom'].'"';
                        }
                        ?>/>
                    </div>
                    <div class="col-12">
                        <span class="<?php
                            if (isset($_POST['email']) && !filter_var($_POST['email'], FILTER_VALIDATE_EMAIL)){
                                echo "enRouge";
                                $formulaireValide = false;
                            }?>">Email :<?php
                            if (isset($_POST['email']) && !filter_var($_POST['email'], FILTER_VALIDATE_EMAIL)){
                                echo " <br/> cet email est incorecte";
                            }?></span>
                        <br/>    
                        
                        <input type="text" name="email" placeholder="Entrez votre email" class="form-control" <?php
                            if (isset($_POST['email'])){
                                echo 'value="'.$_POST['email'].'"';
                            }
                        ?>/>
                    </div>
                    <div class="col-12">
                        <span class="<?php
                            $leBool=preg_match("/^.{1,35}$/", $_POST['identifiant'])==1;
                            
                            if (isset($_POST['identifiant']) && !$leBool){
                                echo "enRouge";
                                $formulaireValide = false;
                            }?>">Identifiant :<?php
                            if (isset($_POST['identifiant']) && !$leBool){
                                echo " <br/> l'identifiant ne dois pas etre vide ou depasser 35 charactere";
                            }?>
                        </span>  
                        <br/>    
                        <input type="text" name="identifiant" placeholder="Entrez votre Identifiant" class="form-control" <?php
                        if (isset($_POST['identifiant'])){
                            echo 'value="'.$_POST['identifiant'].'"';
                        }
                        ?>/>
                    </div>
                    <br/>
                    <div class="col-12">
                        <span class="<?php
                            $leBool=preg_match("/^.{1,255}$/", $_POST['pswd'])==1;
                            
                            if (isset($_POST['pswd']) && !$leBool){
                                echo "enRouge";
                                $formulaireValide = false;
                            }?>">Mot de passe :<?php
                            if (isset($_POST['pswd']) && !$leBool){
                                echo " <br/> le mot de passe ne dois pas etre vide ou depasser 255 charactere";
                            }?>
                        </span>
                        <br/>
                        <input type="password" name="pswd" placeholder="Tapez votre mot de passe" class="form-control"/>					
                    </div>
                    <?php 
                        if ($formulaireValide){
                            header('Location: ./index.php?controller=CreerUser&action=formulaireValide');
                            exit;
                        }
                    ?>
                    <br/>
                    <div class="col-12 text-center">
                        <input class="btn-blanc btn-modif" type="submit" value="S'inscrire">
                    </div>
                    <div class="col-12 text-center">
                        <a href="./index.php" class="text-decoration-none col-12 texte-bleu">Se connecter</a>
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