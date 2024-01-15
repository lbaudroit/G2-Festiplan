<?php
/*
Variables utilisées
- id_fest (identifiant)
- festival
- spectacles
- selection_debut
*/
?>

<!DOCTYPE HTML>
<html lang="fr">

<head>
    <meta charset="utf-8">
    <title>FESTIPLAN - Sélection des spectacles</title>

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
    <?php include("./views/header.php");

    if (isset($selection_debut)) {
        foreach ($selection_debut as $spec) {
            $selectionnes[] = $spec;
            $id_selectionnes[] = $spec["id_spectacle"];
        }
    }

    ?>
    <div class="contenue container mb-2">
        <div class="col-12">
            <form method="post" action="./index.php" class="formulaire" enctype="multipart/form-data">
                <input type="hidden" name="controller" value="festival">
                <input type="hidden" name="action" value="seeSpectacles">
                <input type="hidden" name="festival" value="<?php echo $id_fest ?>">
                <!--Sélectionnés-->
                <div class="row mb-2">
                    <div class="underline titre2 width-to-size">
                        <?php echo "Spectacles de " . $festival["titre"]; ?>&nbsp;:
                    </div>
                </div>
                <div id="parent-selected" class="row mb-2 row-gap-2">
                    <?php // affichage des cartes  
                    if (isset($selectionnes)) {
                        foreach ($selectionnes as $i => $spec) {
                            $url = "images/spectacle/s" . (isset($spec["lien_img"]) ? ($spec["id_spectacle"] . $spec['lien_img']) : "0.jpg");
                            // utilisation de classes selected et selectable 
                            ?>
                            <div id="<?php echo $spec["id_spectacle"]; ?>"
                                class="spectacle selected col-6 col-sm-4 col-md-3 min-card">
                                <a href="<?php echo "./index.php?controller=spectacle&action=modify&spectacle=" . $spec["id_spectacle"]; ?>"
                                    class="text-decoration-none text-black">
                                    <div class="bordure-basique d-flex flex-column justify-content-between h-100">
                                        <div class="p-2 row">
                                            <!-- TITRE -->
                                            <a class="col-9 text-decoration-none text-black">
                                                <?php echo $spec['titre']; ?>
                                            </a>
                                        </div>
                                        <!-- IMAGE -->
                                        <a>
                                            <div class="">
                                                <?php
                                                echo "<img  alt='Image du spectacle " . htmlspecialchars($spec['titre']) . "' 
                                                    src='$url'class='img-fluid'>";
                                                ?>
                                            </div>
                                        </a>
                                    </div>
                                </a>
                            </div>
                            <?php
                        }
                    }
                    ?><!-- FIN LISTE SPECTACLES-->
                </div>
                <!--Disponibles-->
                <div class="row mb-2">
                    <!--Titre-->
                    <div class="underline titre2 width-to-size">
                        Spectacles disponibles&nbsp;:
                    </div>
                </div>
                <div id="parent-dispo" class="row row-gap-2">
                    <?php // affichage des cartes
                    foreach ($spectacles as $i => $spec) {
                        if (!isset($id_selectionnes) || !in_array($spec["id_spectacle"], $id_selectionnes)) {
                            $url = "images/spectacle/s" . (isset($spec["lien_img"]) ? ($spec["id_spectacle"] . $spec['lien_img']) : "0.jpg");
                            ?>
                            <div id="<?php echo $spec["id_spectacle"]; ?>" class=" spectacle col-6 col-sm-4 col-md-3 min-card">
                                <a href="<?php echo "./index.php?controller=spectacle&action=modify&spectacle=" . $spec["id_spectacle"]; ?>"
                                    class="text-decoration-none text-black">
                                    <div class="bordure-basique d-flex flex-column justify-content-between h-100">
                                        <div class="p-2 row">
                                            <!-- TITRE -->
                                            <a class="col-9 text-decoration-none text-black">
                                                <?php echo $spec['titre']; ?>
                                            </a>
                                        </div>
                                        <!-- IMAGE -->
                                        <a>
                                            <div class="">
                                                <?php
                                                echo "<img  alt='Image du spectacle " . htmlspecialchars($spec['titre']) . "' 
                                                    src='$url'class='img-fluid'>";
                                                ?>
                                            </div>
                                        </a>
                                    </div>
                                </a>
                            </div>
                            <?php
                        }
                    }
                    ?><!-- FIN LISTE SPECTACLES-->
                    <input id="liste_a_envoyer" type="hidden" name="selection_fin">
                </div>
                <!-- BOUTONS -->
                <div class="row mb-2">
                    <a id="send"
                        class="btn col-12 offset-sm-6 col-sm-6 offset-md-9 col-md-3 mb-5 bordure fond-bleu-clair">
                        Sauvegarder
                    </a>
                </div>
            </form>
        </div>
    </div>
    <?php include("./views/footer.php"); ?>
</body>
<script src="./js/common.js" defer></script>
<script src="./js/ajoutSpec.js" defer></script>

</html>