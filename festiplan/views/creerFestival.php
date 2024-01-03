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
    <header>
        <div class="container-fluid">
            <div class="row">
                <div class="col-6">
                    <span class="titre">Festiplan</span>
                </div>
                <div class="col-6 contenue_droite">
                    <i class="fa-solid fa-user fa-4x"></i>
                    <span class="secondTitre">Mon Compte </span>
                </div>
            </div>
        </div>
    </header>
    <div class="contenue container">
        <div class="col-12">
            <form method="post" action="./index.php" class="formulaire">
                <input hidden name="controller" value="festival">
                <input hidden name="action" value="create">
                <input hidden name="ajouter" value="true">
                <!--INFOS GENERALES-->
                <div class="text-center row textFormulaire bordure fondFormulaire">
                    <div class="col-md-4 col-sm-5 col-12">
                        <i class="fa-regular fa-plus fa-4x"></i>
                        <br />
                        <input type="file" id="img_fest" name="img_fest" accept="image/png, image/jpeg" />
                        <label for="image_uploads">
                            Rajoutez une image (PNG, 800x600 maximum) (optionnel)
                        </label>
                    </div>
                    <div class="col-sm-7 d-none d-sm-block d-md-none my-auto">
                        <input type="text" name="titre" placeholder="Tapez le titre (35 caractères max.)"
                            class="form-control" <?php if (isset($titre)) {
                                echo "value='$titre'";
                            } ?> />
                    </div>
                    <div class="col-8">
                        <div class="col-12 d-sm-none d-md-block">
                            <input type="text" name="titre" placeholder="Tapez le titre (35 caractères max.)"
                                class="form-control" <?php if (isset($titre)) {
                                    echo "value='$titre'";
                                } ?> />
                        </div>
                        <br />
                        <div class="col-12 d-none d-md-block">
                            <input type="text" name="desc" placeholder="Tapez la description (1000 caractères max.)"
                                class="form-control" <?php if (isset($desc)) {
                                    echo "value='$desc'";
                                } ?> />
                        </div>
                    </div>
                    <div class="col-12 d-md-none">
                        <input type="text" name="desc" placeholder="Tapez la description (1000 caractères max.)"
                            class="form-control" <?php if (isset($desc)) {
                                echo "value='$desc'";
                            } ?> />
                    </div>
                </div>
                <!--CATEGORIES-->
                <div class="m-0 text-center row textFormulaire">
                    <div class="bordure col-md-6 col-12">
                        <u class="aGauche">
                            Categories :
                        </u>
                        <br />
                        <?php
                        foreach ($categories as $cat) {
                            $name = ucfirst($cat["libelle"]);
                            $id = $cat["id_cat"];
                            echo
                                "<span class='me-3 width-to-size d-inline-block'>
                                    <input type='radio' id='btnCat$id' name='cat' value='$id' />
                                    <label for='btnCat$id'>$name </label>
                                </span>";
                        }
                        ?>
                    </div>
                    <div class="bordure col-md-3 col-sm-6 col-12">
                        <u class="aGauche">
                            Date de début du Festival :
                        </u>
                        <br />
                        <input type="date" id="deb" name="deb" <?php if (isset($deb)) {
                            echo "value='$deb'";
                        } ?> />
                    </div>
                    <div class="bordure col-md-3 col-sm-6 col-12">
                        <label for="tailleSceneSelect">
                            <u class="aGauche">
                                Date de fin du Festival :
                            </u>
                        </label>
                        <br />
                        <input type="date" id="fin" name="fin" <?php if (isset($fin)) {
                            echo "value='$fin'";
                        } ?> />
                    </div>
                </div>
                <!--SCENES ET ORGANISATEURS-->
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
                                            <div class="col-10 col-sm-5 col-md-4 order-1 py-2 text-left fs-3">
                                                Scène&nbsp
                                                <?php echo $i; ?>
                                            </div>
                                            <!--GPS-->
                                            <div class="col-8 col-sm-5 col-md-6 order-4 order-sm-2 py-2">
                                                <div class="d-flex">
                                                    <label class="my-auto">Coordonnées GPS&nbsp</label>
                                                    <input disabled class="form-control"
                                                        value="<?php echo round($lat, 3) . " : " . round($long, 3); ?>">
                                                </div>
                                            </div>
                                            <!--SUPPR-->
                                            <div class="col-2 col-2 order-2 order-sm-3 text-end py-2">
                                                <a href="./index.php?controller=festival&action=deleteScene&<?php echo "festival=$fest&scene=" . $sc["id_scene"]; ?>"
                                                    <i class="fas fa-trash-alt text-black"></i>
                                                </a>
                                            </div>
                                            <!--TAILLE-->
                                            <div class="col-4 col-md-4 order-5 my-auto py-2">
                                                <select disabled>
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
                                            <div class="col-12 col-md-6 order-3 my-auto py-2">
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
                            <tr>
                                <td>
                                    <a href="index.php?controller=festival&action=addorg"
                                        class="btn fond-bleu-clair col-12 p-0">
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
                                <tr>
                                    <td>
                                        <a href="index.php?controller=festival&action=addorg"
                                            class="btn fond-bleu-clair col-12 p-0">
                                            <i class="fas fa-plus texte-bleu"></i>
                                        </a>
                                    </td>
                                </tr>
                            </table>
                        </div>
                    </div>
                </div>
                <!--GRIJ-->
                <div class="m-0 text-center row textFormulaire">
                    <div class="col-12 bordure">
                        Grille journalière contrainte
                    </div>
                    <div class="col-4 bordure">
                        <div class="underline">
                            Heure de début du festival
                        </div>
                        <input name="grij_deb" type="time">
                    </div>
                    <div class="col-4 bordure">
                        <div class="underline">
                            Heure de fin du festival
                        </div>
                        <input name="grij_fin" type="time">
                    </div>
                    <div class="col-4 bordure">
                        <div class="underline">
                            Durée minimale entre spectacles
                        </div>
                        <input name="grij_delai" type="time">
                    </div>
                </div>
                <!--BOUTONS-->
                <div class="text-left row row-gap-2">
                    <div class="col-3 p-0">
                        <a class="btn btn-bleu form-control" <?php
                        if (isset($fest)) {
                            echo "href='./index.php?controller=festival&action=seeSpectacles&festival=$fest'";
                        } else {
                            echo "disabled";
                        } ?>>
                    Gérer les spectacles
                        </a>
                    </div>
                    <div class="col-3 p-0 offset-6">
                        <a class="btn btn-rouge form-control"> <!--TODO-->
                            Annuler
                        </a>
                    </div>
                    <div class="col-3 p-0 offset-9">
                        <?php
                        if (isset($fest)) {
                            echo "<input type='hidden' name='festival' value='$fest'>";
                        }
                        ?>
                        <input class="btn btn-bleu form-control" type="submit" value="Créer">
                    </div>
                </div>
            </form>
        </div>
    </div>
    <footer>
        <div class="container-fluid">
            <div class="row">
                <div class="col-6">
                    <!-- ICI ON MET LE BOUTON DE DECONEXION-->
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