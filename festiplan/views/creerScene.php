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
                        <input type="hidden" name="festival" 
                        <?php
                            echo "value=$idFest";
                        ?>/>
                        <u class ="offset-md-2 offset-1 col-4"><h5>
                            Nom de la scène :
                        </h5></u>
                        <input type="text" id="nomScene" name="nomScene" class="offset-md-1 offset-2 col-3 textFormulaire" placeholder="Entrer le nom de la scène (35 caractères max.)"<?php
                        if (isset($_POST['nomScene'])) {
                                echo 'value="' . $_POST['nomScene'] . '"';
                        }?>/>
                    </div>
                    <div class ="row textFormulaire">
                        <u class ="offset-md-2 offset-1 col-4"><h5>
                            Coordonnées GPS :
                        </h5></u>
                        <input type="text" id="coordGPSLat" name="coordGPSLat" class ="textFormulaire offset-md-1 offset-2 col-3" placeholder="Entrez la latitude de la scène"<?php
                            if (isset($_POST['coordGPSLat'])) {
                                echo 'value="' . $_POST['coordGPSLat'] . '"';
                            }?>
                        />
                        <input type="text" id="coordGPSLong" name="coordGPSLong" class ="textFormulaire offset-7 col-3" placeholder="Entrez la longitude de la scène"<?php
                            if (isset($_POST['coordGPSLong'])) {
                                echo 'value="' . $_POST['coordGPSLong'] . '"';
                            }?>
                        />
                    </div>
                    <div class ="row">
                        <u class ="offset-md-2 offset-1 col-4"><h5>
                            Nombre de spectateurs maximum :
                        </h5></u>
                        <input type="text" id="nbMaxSpec" name="nbMaxSpec" class ="textFormulaire offset-md-1 offset-2 col-3" <?php
                            if (isset($_POST['nbMaxSpec'])){
                                echo 'value="' . $_POST['nbMaxSpec'] . '"';
                            }?>
                        />
                    </div>
                    <<div class ="row">
                        <u class ="offset-md-2 offset-1 col-4"><h5>
                            Taille minimum requise :
                        </h5></u>
                        <div class="offset-md-1 col-4">
                            <select class="text-center" name="tailleScene" id="taille">
                                <option value="default" disabled <?php if (!isset($taille))
                                    echo "selected"; ?>>
                                    Choisir une taille de scène
                                </option>
                                <?php
                                foreach ($taillescenes as $taillesc) {
                                    $name = ucfirst($taillesc["libelle"]);
                                    $id = $taillesc["id_taille"];
                                    $selected = isset($taille) && $taille === $id ? "checked" : "";
                                    echo "<option value='$id'>$name</option>";
                                }
                                ?>
                            </select>
                        </div>
                    </div>
                    <!--BOUTONS-->
                    <div class="text-left row row-gap-2">
                        <!--supprimer-->
                        <button type="button" name='page_precedente' class="offset-2 col-3 btn btn-rouge">Annuler</button>
                        <!--sauvegarder-->
                        <button type="button" class="offset-2 col-3 btn btn-bleu">Ajouter la scène</button>
                    </div>
                </form>
            </div>
        </div>
        <?php include("./views/footer.php"); ?>
        <script src="js/common.js"></script>
    </body>
</html>