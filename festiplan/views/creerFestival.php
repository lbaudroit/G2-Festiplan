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
        <div class="col-12">
            <form method="post" action="./index.php" class="formulaire" enctype="multipart/form-data">
                <input hidden name="controller" value="festival">
                <input hidden name="action" value="<?php echo $mode == "ajout" ? "create" : "modify"; ?>">
                <?php
                if (isset($fest)) {
                    echo "<input type='hidden' name='festival' value='$fest'>";
                }
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
                <!-- TITRE DESC ET IMAGE -->
                <div class="text-center row textFormulaire bordure fondFormulaire">
                    <div class="col-md-4 col-sm-5 col-12">
                        <input type="file" id="img_fest" name="img_fest" accept="image/png, image/jpeg, image/gif"
                            class="d-none" />
                        <label for="img_fest" class="m-1">
                            <?php
                            if (isset($fest)) {
                                $url = "images/festival/" . (isset($ext) ? "f$fest$ext" : "f0.jpg");
                                echo "<img src='$url' alt='Image du festival' class='img-fluid'>";
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
                    <div class="col-8">
                        <div class="col-12 d-sm-none d-md-block">
                            <input type="text" name="titre" placeholder="Tapez le titre (35 caractères max.)"
                                class="form-control" <?php if (isset($titre)) {
                                    echo "value='" . htmlspecialchars($titre) . "'";
                                } ?> />
                        </div>
                        <br />
                        <div class="col-12 d-none d-md-block">
                            <input type="text" name="desc" placeholder="Tapez la description (1000 caractères max.)"
                                class="form-control" <?php if (isset($desc)) {
                                    echo "value='" . htmlspecialchars($desc) . "'";
                                } ?> />
                        </div>
                    </div>
                    <div class="col-12 d-md-none">
                        <input type="text" name="desc" placeholder="Tapez la description (1000 caractères max.)"
                            class="form-control" <?php if (isset($desc)) {
                                echo "value='" . htmlspecialchars($desc) . "'";
                            } ?> />
                    </div>
                </div>
                <!--CATEGORIES & DATES-->
                <div class="m-0 text-center row textFormulaire">
                    <div class="bordure col-md-6 col-12">
                        <u class="aGauche">
                            Catégorie :
                        </u>
                        <br />
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
                    <div class="bordure col-md-3 col-sm-6 col-12">
                        <u class="aGauche">
                            Date de début du Festival&nbsp:
                        </u>
                        <br />
                        <input type="date" id="deb" name="deb" <?php if (isset($deb)) {
                            echo "value='$deb'";
                        } ?> />
                    </div>
                    <div class="bordure col-md-3 col-sm-6 col-12">
                        <label for="tailleSceneSelect">
                            <u class="aGauche">
                                Date de fin du Festival&nbsp:
                            </u>
                        </label>
                        <br />
                        <input type="date" id="fin" name="fin" <?php if (isset($fin)) {
                            echo "value='$fin'";
                        } ?> />
                    </div>
                </div>
                <!--SCENES ET ORGANISATEURS-->
                <?php
                if ($mode == "modif") {
                    ?>
                    <div class="m-0 text-center row textFormulaire">
                        <div class="col-12 col-md-6 bordure p-0">
                            <table class="table table-striped">
                                <div>Scènes</div>
                                <?php
                                if (!is_array($scenes)) {
                                    $i = 0;
                                    while ($sc = $scenes->fetch()) {
                                        $i++;
                                        $lat = (float) $sc["latitude"];
                                        $long = (float) $sc["longitude"];
                                        $cap = $sc['capacite']; ?>

                                        <tr>
                                            <td class="row m-0 w-100 text-start">
                                                <!--NOM-->
                                                <div
                                                    class="col-11 order-1     col-sm-4           col-md-4     py-2 px-1 text-left fs-3">
                                                    <a href="./index.php?controller=festival&action=modifyScene&<?php echo "festival=$fest&scene=" . $sc["id_scene"]; ?>"
                                                        class="text-decoration-none text-black">
                                                        <?php echo "Scène&nbsp$i"; ?>
                                                    </a>
                                                </div>
                                                <!--GPS-->
                                                <div class="col-8 order-4   col-sm-7 order-sm-2   col-md-7     py-2 px-1">
                                                    <div class="d-flex">
                                                        <label class="my-auto">GPS&nbsp</label>
                                                        <input disabled class="form-control"
                                                            value="<?php echo round($lat, 3) . " : " . round($long, 3); ?>">
                                                    </div>
                                                </div>
                                                <!--SUPPR-->
                                                <div class="col-1 order-2   order-sm-3            text-end     py-2 px-1">
                                                    <a
                                                        href="./index.php?controller=festival&action=deleteScene&<?php echo "festival=$fest&scene=" . $sc["id_scene"]; ?>">
                                                        <i class="fas fa-trash-alt text-black"></i>
                                                    </a>
                                                </div>
                                                <!--TAILLE-->
                                                <div class="col-4 order-5    col-sm-4 order-sm-4   col-md-5     my-auto py-2 px-1">
                                                    <select disabled class="form-select">
                                                        <?php
                                                        while ($taille = $tailles->fetch()) {
                                                            if ($taille["id_taille"] == $sc["id_taille"]) {
                                                                $selected = "selected";
                                                            } else {
                                                                $selected = "";
                                                            }
                                                            echo "<option $selected>" . $taille["libelle"] . "</option>";
                                                        }
                                                        ?>
                                                    </select>
                                                </div>
                                                <!--CAPACITE-->
                                                <div class="col-12 order-3   col-sm-8 order-sm-5   col-md-7     my-auto py-2 px-1">
                                                    <div class="d-flex">
                                                        <span class="my-auto">
                                                            <label class="form-label">Spectateurs max&nbsp</label>
                                                        </span>
                                                        <span class="flex-grow-1">
                                                            <input disabled type="number" value=<?php echo $cap; ?>
                                                                class="form-control">
                                                        </span>
                                                    </div>
                                                </div>
                                            </td>
                                        </tr>
                                        <?php
                                    }
                                }
                                ?>
                                <!--Bouton d'ajout de scène-->
                                <tr>
                                    <td>
                                        <a class="btn fond-bleu-clair col-12 p-0 not_now" <?php
                                        if ($mode == "modif") {
                                            echo "href='index.php?controller=festival&action=createScene&festival=$fest' ";
                                        }
                                        ?>>
                                            <i class="fas fa-plus texte-bleu"></i>
                                        </a>
                                    </td>
                                </tr>
                            </table>
                        </div>
                        <div class="col-12 col-md-6 bordure p-0">
                            <div>
                                <div>Organisateurs</div>
                                <table class="table table-striped">
                                    <?php
                                    if (!is_array($organisateurs)) {
                                        while ($org = $organisateurs->fetch()) {
                                            ?>

                                            <tr>
                                                <td class='row m-0 w-100'>
                                                    <?php
                                                    echo "<div class='col-10 text-start'>" . $org["nom"] . " " . $org["prenom"] . "</div>";
                                                    echo "<div class='col-2 text-end'>";
                                                    echo "<a href='./index.php?controller=festival&action=removeOrg&festival=$fest&org=" . $org["id_login"] . "'>";
                                                    echo "<i class='fas fa-trash-alt text-black'></i>";
                                                    echo "</a></div>";
                                                    ?>
                                                </td>
                                            </tr>
                                            <?php
                                        }
                                    }
                                    ?>
                                    <!--Bouton d'ajout d'organisateurs-->
                                    <tr>
                                        <td>
                                            <a class="btn fond-bleu-clair col-12 p-0 not_now" <?php
                                            if ($mode == "modif") {
                                                echo "href='index.php?controller=festival&action=addOrg&festival=$fest' ";
                                            }
                                            ?>>
                                                <i class="fas fa-plus texte-bleu"></i>
                                            </a>
                                        </td>
                                    </tr>
                                </table>
                            </div>
                        </div>
                    </div>
                    <?php
                }
                ?>
                <!--GRIJ-->
                <div class="m-0 text-center row textFormulaire">
                    <div class="col-12 bordure">
                        Grille journalière contrainte
                    </div>
                    <div class="col-4 bordure">
                        <div class="underline">
                            Heure de début du festival
                        </div>
                        <input name="grij_deb" type="time" <?php if (isset($grij_deb))
                            echo "value=" . $grij_deb; ?>>
                    </div>
                    <div class="col-4 bordure">
                        <div class="underline">
                            Heure de fin du festival
                        </div>
                        <input name="grij_fin" type="time" <?php if (isset($grij_fin))
                            echo "value=" . $grij_fin; ?>>
                    </div>
                    <div class="col-4 bordure">
                        <div class="underline">
                            Durée minimale entre spectacles
                        </div>
                        <input name="grij_delai" type="time" <?php if (isset($grij_delai))
                            echo "value=" . $grij_delai; ?>>
                    </div>
                </div>
                <!--BOUTONS-->
                <div class="text-left row row-gap-2">
                    <!--spectacles-->
                    <div
                        class="col-12 col-md-3 p-0 h-100 <?php echo $mode == "modif" ? "order-2 order-md-2 col-sm-6 order-sm-2" : "d-none"; ?>">
                        <a class="btn btn-bleu form-control text-wrap wrap" <?php
                        if (isset($fest)) {
                            echo "href='./index.php?controller=festival&action=seeSpectacles&festival=$fest'";
                        } ?>>
                            Gérer les spectacles
                        </a>
                    </div>
                    <!--supprimer-->
                    <div
                        class="col-12 col-md-3 p-0 <?php echo $mode == "modif" ? "order-3 offset-md-6 order-md-3 col-sm-6 order-sm-3" : "offset-sm-2 col-sm-4 offset-md-9"; ?>">
                        <?php
                        if ($mode == "ajout") {
                            echo "<a name='page_precedente' class='btn btn-rouge form-control'>Annuler</a>";
                        } else {
                            echo "<a href='index.php?controller=festival&action=delete&festival=$fest' class='btn btn-rouge form-control'>Supprimer</a>";
                        } ?>
                    </div>
                    <!--planif-->
                    <?php if ($mode == "modif") {
                        ?>
                        <div
                            class="col-12 col-md-3 p-0 <?php echo $mode == "modif" ? "order-1 offset-md-6 order-md-1 col-sm-6 order-sm-1" : "offset-md-9"; ?>">
                            <a class="btn btn-bleu form-control wrap text-wrap"
                                href="index.php?controller=planification&festival=<?php echo $fest ?>">
                                Consulter la planification
                            </a>
                        </div>
                        <?php
                    } ?>
                    <!--sauvegarder-->
                    <div
                        class="col-12 col-md-3 p-0 <?php echo $mode == "modif" ? "order-4 order-md-4 col-sm-6 order-sm-4" : "col-sm-4 offset-md-9"; ?>">
                        <input class="btn btn-bleu form-control wrap text-wrap" type="submit"
                        value="<?php echo $mode == "ajout" ? "Créer" : "Sauvegarder les changements"; ?>">
                    </div>
                </div>
            </form>
        </div>
    </div>
    <?php include("./views/footer.php"); ?>
</body>
<script src="./js/common.js" defer></script>
<script src="./js/creerFestival.js" defer></script>

</html>