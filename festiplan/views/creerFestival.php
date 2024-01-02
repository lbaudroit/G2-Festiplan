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
                <button hidden name="controller" value="festival"></button>
                <button hidden name="action" value="create"></button>
                <button hidden name="ajouter" value="true"></button>
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
                <div class="m-0 text-center row textFormulaire">
                    <div class="col-6 bordure">
                        <div>
                            <div>Scènes</div>
                            <?php
                            if (!is_array($scenes)) {
                                while ($sc = $scenes->fetch()) {
                                    $lat = (double) $sc["latitude"];
                                    $long = (double) $sc["longitude"];
                                    $gps = "[" . round($lat, 4) . " ; " . round($long, 4) . "]";
                                    $cap = $sc['capacite'];
                                    echo "<div class='col-12'>$gps - $cap personnes</div>";
                                }
                            }
                            ?>
                            <a href="index.php?controller=festival&action=createscene"
                                class="btn fond-bleu-clair col-12 p-0">
                                <i class="fas fa-plus texte-bleu"></i>
                            </a>
                        </div>
                    </div>
                    <div class="col-6 bordure">
                        <div>
                            <div>Organisateurs</div>
                            <?php
                            if (!is_array($organisateurs)) {
                                while ($org = $organisateurs->fetch()) {
                                    echo "<div class='col-12'>" . $org["nom"] . " " . $org["prenom"] . "</div>";
                                }
                            }
                            ?>
                            <a href="index.php?controller=festival&action=addorg"
                                class="btn fond-bleu-clair col-12 p-0">
                                <i class="fas fa-plus texte-bleu"></i>
                            </a>
                        </div>
                    </div>
                </div>
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
                        <input type="hidden" name="controller" value="festival">
                        <input type="hidden" name="action" value="create">
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