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
                    <?php
                        
                            if (isset($_POST['nom'])) {
                                $nom = $_POST['nom'];
                                //var_dump($nomOK);
                                if (empty($nom) || ($nomOK == 0)) {
                                    echo '<span class="enRouge">Nom(vous devez entrer votre Nom) :</span>';
                                    echo '<input type="text" name="nom" placeholder="Entrez votre Nom" class="form-control" />';
                                } else {
                                    echo ' <span>Nom :</span><br/>';
                                    echo '<input type="text" name="nom" placeholder="Entrez votre Nom" class="form-control" value="'.$_POST['nom'].'"/>';
                                }
                            } else {
                                echo ' <span>Nom :</span><br/>';
                                echo '<input type="text" name="nom" placeholder="Entrez votre Nom" class="form-control"/>';
                            }
                        ?>
                    </div>
                    <div class="col-12">
                    <?php
                            if (isset($_POST['prenom'])) {
                                $prenom = $_POST['prenom'];
                                if (empty($prenom) || ($prenomOk == 0)) {
                                    echo '<span class="enRouge">Prenom(vous devez entrer votre Prenom) :</span>';
                                    echo '<input type="text" name="prenom" placeholder="Entrez votre Prenom" class="form-control" />';
                                } else {
                                    echo ' <span>Prenom :</span><br/>';
                                    echo '<input type="text" name="prenom" placeholder="Entrez votre Prenom" class="form-control" value="'.$_POST['prenom'].'"/>';
                                }
                            } else {
                                echo ' <span>Prenom :</span><br/>';
                                echo '<input type="text" name="prenom" placeholder="Entrez votre Prenom" class="form-control"/>';
                            }
                        ?>
                    </div>
                    <div class="col-12">
                    <?php
                            if (isset($_POST['email'])) {
                                $email = $_POST['email'];
                                if (empty($email) || ($emailOk == 0)) {
                                    echo '<span class="enRouge">Email(vous devez entrer votre Email) :</span>';
                                    echo '<input type="text" name="email" placeholder="Entrez votre email" class="form-control" />';
                                } else {
                                    echo ' <span>Email :</span><br/>';
                                    echo '<input type="text" name="email" placeholder="Entrez votre email" class="form-control" value="'.$_POST['email'].'"/>';
                                }
                            } else {
                                echo ' <span>Email :</span><br/>';
                                echo '<input type="text" name="email" placeholder="Entrez votre email" class="form-control"/>';
                            }
                        ?>
                    </div>
                    <div class="col-12">
                    <?php
                            if (isset($_POST['identifiant'])) {
                                $messageId = "";
                                $identifiant = $_POST['identifiant'];
                                if (empty($identifiant) || ($loginOk == 0)) {
                                    echo '<span class="enRouge">Identifiant(vous devez entrer votre Identifiant) '.$messageId.':</span>';
                                    echo '<input type="text" name="identifiant" placeholder="Entrez votre Identifiant" class="form-control" />';
                                } else {
                                    echo ' <span>Mot de passe :</span><br/>';
                                    echo '<input type="text" name="identifiant" placeholder="Entrez votre Identifiant" class="form-control" value="'.$_POST['identifiant'].'"/>';
                                }
                            } else {
                                echo ' <span>Identifiant :</span><br/>';
                                echo '<input type="text" name="identifiant" placeholder="Entrez votre Identifiant" class="form-control"/>';
                            }
                        ?>
                    </div>
                    <br/>
                    <div class="col-12">
                        <?php
                            if (isset($_POST['pswd'])) {
                                $pwd = $_POST['pswd'];
                                if (empty($pwd)) {
                                    echo '<span class="enRouge">Mot de passe(vous devez entrer votre Mot de passe) :</span>';
                                    echo '<input type="text" name="pswd" placeholder="Entrez votre Mot de passe" class="form-control" />';
                                } else if($mdpOk == 0) {
                                    echo '<span class="enRouge">Mot de passe. Votre mot de passe doit contenir au moins : <br/>
                                    Une lettre majuscule<br/>
                                    Une lettre miniscule<br/>
                                    Un chiffre<br/>
                                    Un caractère spécial</span>';
                                    echo '<input type="text" name="pswd" placeholder="Entrez votre Mot de passe" class="form-control" />';
                                } else {
                                    echo ' <span>Mot de passe :</span><br/>';
                                    echo '<input type="text" name="pswd" placeholder="Entrez votre Mot de passe" class="form-control"/>';
                                }
                            } else {
                                echo ' <span>Mot de passe :</span><br/>';
                                echo '<input type="password" name="pswd" placeholder="Entrez votre Mot de passe" class="form-control"/>';
                            }
                        ?>			
                    </div>
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