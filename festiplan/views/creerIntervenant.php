<?php
/*
Variables utilisées
- mode
- fest (identifiant)
- scenes
- organisateurs
- titre
- desc
- grij_debut
- grij_fin
- grij_delai
- ext (extension de fichier)
- categories
- cat
- deb
- fin
- tailles
*/
?>

<!DOCTYPE HTML>
<html lang="fr">

<head>
    <meta charset="utf-8">
    <title>FESTIPLAN - Création de Festival</title>

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
    <?php include("./views/header.php"); ?>
    <div class="contenue container mb-2">
        <form method="post" class="bordure formulaire leFormulaire">
            <div class="col-12 text-center">
                <i class="fa-solid fa-user fa-4x"></i>
            </div>
            <div class="row textFormulaire">
                <div class="col-12">
                    <?php

                    if (isset($_POST['nom'])) {
                        $nom = $_POST['nom'];
                        if (empty($nom) || ($nomOK == 0)) {
                            echo '<span class="enRouge">Nom(vous devez entrer votre Nom) :</span>';
                            echo '<input type="text" name="nom" placeholder="Entrez votre Nom" class="form-control" />';
                        } else {
                            echo ' <span>Nom :</span><br/>';
                            echo '<input type="text" name="nom" placeholder="Entrez votre Nom" class="form-control" value="' . $_POST['nom'] . '"/>';
                        }
                    } else {
                        echo ' <span>Nom :</span><br/>';
                        echo '<input type="text" name="nom" placeholder="Entrez votre Nom" class="form-control" value=""/>';
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
                            echo '<input type="text" name="prenom" placeholder="Entrez votre Prenom" class="form-control" value="' . $_POST['prenom'] . '"/>';
                        }
                    } else {
                        echo ' <span>Prenom :</span><br/>';
                        echo '<input type="text" name="prenom" placeholder="Entrez votre Prenom" class="form-control" value=""/>';
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
                            echo '<input type="text" name="email" placeholder="Entrez votre email" class="form-control" value="' . $_POST['email'] . '"/>';
                        }
                    } else {
                        echo ' <span>Email :</span><br/>';
                        echo '<input type="text" name="email" placeholder="Entrez votre email" class="form-control" value=""/>';
                    }
                    ?>
                </div>
                <div class="col-12 text-center">
                    <input class="btn-blanc btn-modif" type="submit" value="Ajouter">
                </div>
            </div>
        </form>
    </div>
    <?php include("./views/footer.php"); ?>
</body>
<script src="./js/common.js" defer></script>
<script src="./js/creerFestival.js" defer></script>

</html>