<?php
/*
Liste Variables utilisées
- mode
- spectacle (identifiant)
- titre
- desc
- duree_h
- duree_m
- categories
- cat
- taillescenes
- taille
- img
- hors_scene
- sur_scene
- ext
- error
 */
?>
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
    <?php include("./views/header.php"); ?>
    <div class="contenue container mb-2">
        <?php echo isset($error) ? "<div class='col-12 bg-danger'>$error</div>" : "" ?>
        <div class="col-12">
            <form method="post" action="./index.php" class="formulaire" enctype="multipart/form-data">
                <input hidden name="controller" value="spectacle">
                <input hidden name="action" value="<?php echo $mode == "ajout" ? "create" : "modify"; ?>">
                <?php
                if (isset($spectacle)) {
                    echo "<input type='hidden' name='spectacle' value='$spectacle'>";
                }

                var_dump(get_defined_vars());
                ?>
                <!--Soit ajout, soit modif-->
                <input hidden name="mode" value="<?php echo $mode; ?>">
                <!--INFOS GENERALES-->
                <?php if (isset($erreur)) { ?>
                    <div class="text-center bordure fond-rouge">
                        <?php echo $erreur; ?>
                    </div>
                    <?php
                }
                ?>
                <div class="text-center row textFormulaire bordure fondFormulaire">
                    <div class="col-md-4 col-sm-5 col-12">
                        <input type="file" id="img" name="img" accept="image/png, image/jpeg, image/gif"
                            class="d-none" />
                        <label for="img" class="m-1">
                            <?php
                            if (isset($spectacle)) {
                                $url = "images/spectacle/" . (isset($ext) ? "s$spectacle$ext" : "s0.jpg");
                                echo "<img src='$url' alt='Image du spectacle' class='img-fluid'>";
                            } else {
                                ?>
                                <i class="fa-regular fa-plus fa-4x"></i><br>
                                Rajoutez une image (GIF, JPEG ou PNG, 800x600 maximum) (optionnel)
                                <?php
                            }
                            ?>
                        </label>
                    </div>
                    <div class="col-sm-7 d-none d-sm-block d-md-none my-auto">
                        <input type="text" name="titre" placeholder="Tapez le titre (35 caractères max.)"
                            class="form-control" <?php if (isset($titre)) {
                                echo "value='" . htmlspecialchars($titre) . "'";
                            } ?> />
                    </div>
                    <div class="col-12 col-md-8">
                        <div class="col-12 d-sm-none d-md-block">
                            <input type="text" name="titre" placeholder="Tapez le titre (35 caractères max.)"
                                class="form-control" <?php if (isset($titre)) {
                                    echo "value='" . htmlspecialchars($titre) . "'";
                                } ?> />
                        </div>
                        <br />
                        <div class="col-12 d-none d-md-block">
                            <textarea type="text" name="desc" placeholder="Tapez la description (1000 caractères max.)"
                                class="form-control"><?php
                                if (isset($desc))
                                    echo htmlspecialchars($desc);
                                ?></textarea>
                        </div>
                    </div>
                    <div class="col-12 d-md-none">
                        <textarea type="text" name="desc" placeholder="Tapez la description (1000 caractères max.)"
                            class="form-control"><?php
                            if (isset($desc))
                                echo htmlspecialchars($desc);
                            ?></textarea>
                    </div>
                </div>
                <!--CATEGORIES & DATES-->
                <div class="m-0 row textFormulaire">
                    <div class="bordure col-md-4 col-sm-6 col-12">
                        <u class="aGauche">
                            Durée du Spectacle :
                        </u>
                        <br />
                        <div class="text-center">
                            <input type="number" name="duree_h" class="text-center taille4em" class="form-control w-25"
                                min="0" max="24" step="1" value="<?php echo isset($duree_h) ? $duree_h : ""; ?>" /> h
                            <input type="number" name="duree_m" class="text-center taille4em" class="form-control w-25"
                                min="0" max="60" step="1" value="<?php echo isset($duree_m) ? $duree_m : ""; ?>" /> min
                        </div>
                    </div>
                    <div class="bordure col-md-4 col-sm-6 col-12">
                        <label for="taille">
                            <u class="aGauche">
                                Surface de la scène requise :
                            </u>
                        </label>
                        <br>
                        <div class="text-center">
                            <select class="" name="taille" id="taille">
                                <option value="default" disabled <?php if (!isset($taille))
                                    echo "selected"; ?>>
                                    Choisir une taille de scène
                                </option>
                                <?php
                                foreach ($taillescenes as $taillesc) {
                                    $name = ucfirst($taillesc["libelle"]);
                                    $id = $taillesc["id_taille"];
                                    $selected = isset($taille) && $taille === $id ? "checked" : "";
                                    echo "<option value='$id' $selected>$name</option>";
                                }
                                ?>
                            </select>
                        </div>
                    </div>
                    <div class="bordure col-md-4 col-12">
                        <u class="aGauche">
                            Catégories :
                        </u>
                        <br>
                        <div class="text-center">
                            <?php
                            foreach ($categories as $categ) {
                                $name = ucfirst($categ["libelle"]);
                                $id = $categ["id_cat"];
                                $selected = isset($cat) && $cat === $id ? "checked" : "";
                                echo
                                    "<span class='me-3 width-to-size d-inline-block'>
                                    <input type='radio' id='btnCat$id' name='cat' value='$id' $selected/>
                                    <label for='btnCat$id'>$name </label>
                                </span>";
                            }
                            ?>
                        </div>
                    </div>
                </div>

                <!-- INTERVENANTS -->
                <?php if ($mode == "modif") {
                    $intervenants = [$sur_scene, $hors_scene];
                    $titres = ["Liste des intervenants sur scène", "Liste des intervenants hors scène"];
                    echo "<div class='text-left row row-gap-2'>";
                    foreach ($intervenants as $i => $liste) { ?>

                        <div class="bordure col-12 col-md-6 p-0">
                            <div class="text-center fs-2">
                                <?php echo $titres[$i]; ?>
                            </div>
                            <table class="table table-striped mb-0">
                                <?php foreach ($liste as $inter) { ?>
                                    <tr>
                                        <td class="row m-0">
                                            <?php
                                            echo "<div class='col-8 my-auto'>" . $inter["nom"] . " " . $inter["prenom"] . "<br>" . $inter["email"] . "</div>";
                                            ?>
                                            <div class='col-4 text-end'>
                                                <!-- ICONE SUPPR -->
                                                <span>
                                                    <?php
                                                    echo "<a href='index.php?controller=spectacle&action=deleteIntervenantHorsScene&spectacle=$spectacle'>";
                                                    ?>
                                                    <i class='fas fa-trash-alt text-black m-2'></i></a>
                                                </span>
                                                <!-- ICONE MODIFIER -->
                                                <span class='ms-3'>
                                                    <?php
                                                    echo "<a class='p-2 btn fond-bleu-clair border-black' 
                                                     href='index.php?controller=spectacle&action=deleteIntervenantHorsScene&spectacle=$spectacle'>";
                                                    ?>
                                                    Modifier
                                                    </a>
                                                </span>
                                            </div>
                                        </td>
                                    </tr>
                                <?php } ?>
                                <tr>
                                    <td class="p-0">
                                        <a class="btn d-block fond-bleu-clair text-center m-0"
                                            href="index.php?controller=creerIntervenant&spectacle=<?php echo $spectacle; ?>&type=<?php echo $i?>">
                                            <i class="fa fa-2x texte-bleu fa-plus"></i>
                                        </a>
                                    </td>
                                </tr>
                            </table>
                        </div>
                    <?php }
                    echo "</div>"; ?>
                <?php } ?>

                <!--BOUTONS-->
                <div class="text-left row row-gap-2">
                    <!--supprimer-->
                    <div
                        class="col-12 col-sm-6 col-md-3 p-0 <?php echo $mode == "modif" ? "order-3 offset-md-6 order-md-3 col-sm-6 order-sm-3" : "offset-sm-2 col-sm-4 offset-md-9"; ?>">
                        <?php
                        if ($mode == "ajout") {
                            echo "<a name='page_precedente' class='btn btn-rouge form-control'>Annuler</a>";
                        } else {
                            echo "<a href='index.php?controller=spectacle&action=delete&spectacle=$spectacle' class='btn btn-rouge form-control'>Supprimer</a>";
                        } ?>
                    </div>
                    <!--sauvegarder-->
                    <div
                        class="col-12 col-sm-6 col-md-3 p-0 <?php echo $mode == "modif" ? "order-4 order-md-4 col-sm-6 order-sm-4" : "col-sm-4 offset-md-9"; ?>">
                        <input class="btn btn-bleu form-control wrap text-wrap" type="submit"
                            value="<?php echo $mode == "ajout" ? "Créer" : "Sauvegarder les changements"; ?>">
                    </div>
                </div>
            </form>
        </div>
    </div>
    <script src="js/creerFestival.js"></script>
    <?php include("./views/footer.php"); ?>
</body>

<!-- 
<body>
    <?php include("./views/header.php"); ?>
    <div class="contenue container">
        <div class="text-center col-12">
            <form method="post" class="formulaire">
                <div class="row textFormulaire bordure fondFormulaire">
                    <div class="col-md-4 col-sm-5 col-12">
                        <i class="fa-regular fa-plus fa-4x"></i>
                        <br />
                        Rajoutez une image (800x600 maximum) (optionnel)
                    </div>
                    <div class="col-sm-7 d-none d-sm-block d-md-none my-auto">
                        <input type="text" name="nomSpectacleTab" placeholder="Tapez le titre (35 caractères max.)"
                            class="form-control" />
                    </div>
                    <div class="col-8">
                        <div class="col-12 d-sm-none d-md-block">
                            <input type="text" name="nomSpectaclePCetTel"
                                placeholder="Tapez le titre (35 caractères max.)" class="form-control" />
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
                    <div class="row">
                        <div class="col-md-6 bordure">
                            <div class="row">
                                <div class="col-6">
                                    <h5>Intervenant 1</h5>
                                </div>
                                <div class="col-6 contenue_droite">
                                    <i class="fa-solid fa-trash-can fa-2x"></i>
                                    <input class="btn btn-bleu" type="submit" value="Modifier">
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6 bordure">
                            <div class="row">
                                <div class="col-6">
                                    <h5>Intervenant 1</h5>
                                </div>
                                <div class="col-6 contenue_droite">
                                    <i class="fa-solid fa-trash-can fa-2x"></i>
                                    <input class="btn btn-bleu" type="submit" value="Modifier">
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6 bordure">
                            <div class="row">
                                <div class="col-6">
                                    <h5>Intervenant 2</h5>
                                </div>
                                <div class="col-6 contenue_droite">
                                    <i class="fa-solid fa-trash-can fa-2x"></i>
                                    <input class="btn btn-bleu" type="submit" value="Modifier">
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6 bordure">
                            <div class="row">
                                <div class="col-6">
                                    <h5>Intervenant 2</h5>
                                </div>
                                <div class="col-6 contenue_droite">
                                    <i class="fa-solid fa-trash-can fa-2x"></i>
                                    <input class="btn btn-bleu" type="submit" value="Modifier">
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6 bordure text-center">
                            <i class="fa-regular fa-plus fa-2x"></i>
                        </div>
                        <div class="col-md-6 bordure text-center">
                            <i class="fa-regular fa-plus fa-2x"></i>
                        </div>
                    </div>
                    <div class="row">
                        <div class=" offset-6 col-3 contenue_droite">
                            <button name="suppr" class="btn-rouge btn form-control">
                                Supprimer
                            </button>
                        </div>
                        <div class="col-3 contenue_droite">
                            <button name="save" class="btn-bleu btn form-control">
                                Sauvegarder les changements
                            </button>
                        </div>
                    </div>
            </form>
        </div>
    </div>
    <div class="contenue container">
        <div class="text-center col-12">
            <form method="post" class="formulaire bordure">
                <div class="row fondFormulaire textFormulaire">
                    <div class="col-md-4 col-sm-5 col-12">
                        <i class="fa-regular fa-plus fa-4x"></i>
                        Rajoutez une image (800x600 maximum) (optionnel)
                    </div>
                    <div class="col-6 contenue_droite">
                        <img src="images/logo-iut.png" class="logo" id="logoIUT" alt="Logo IUT"
                            href="http://www.iut-rodez.fr" target="_blank" />
                    </div>
                    <div class="col-12 d-md-none">
                        <input type="text" name="descSpectacleTabletTel"
                            placeholder="Tapez la description (1000 caractères max.)" class="form-control" />
                    </div>
                </div>
            </form>
        </div>
    </div>
    </div>
    <?php include("./views/footer.php"); ?>
</body>
                -->

</html>