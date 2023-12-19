<?php
session_start();
?>
<!DOCTYPE html>
<html lang="fr">

<head>
    <title>Dashboard - Festiplan</title>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

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
    <link rel="stylesheet" href="./css/style.css">
</head>

<body>
    <header>
        <span class="titre">Festiplan</span>
    </header>

    <?php
    $aAfficher = [$listeFestivals, $listeSpectacles];
    $nom = ["festival", "spectacle"];
    $nom_pluriel = ["festivals", "spectacles"];
    foreach ($aAfficher as $e => $liste) {
        $id = "id_" . $nom[$e];
        ?>
        <!--LISTE DES FESTIVALS OU SPECTACLES-->
        <div class="container contenue">
            <div class="row mb-2">
                <!-- Titre -->
                <div class="underline titre2 width-to-size">
                    Mes
                    <?php echo $nom_pluriel[$e]; ?>&nbsp:
                </div>

                <!-- Accéder à la page globale des éléments -->
                <div class="text-start my-auto width-to-size">
                    <a href="<?php echo "./index.php?controller=" . $nom[$e] . "&action=index" ?>"
                        class="text-decoration-none col-12 texte-bleu">
                        Voir tous mes
                        <?php echo $nom_pluriel[$e] ?>...
                    </a>
                </div>
            </div>
            <div class="row row-gap-2">
                <?php // affichage des cartes  
                    foreach ($liste as $i => $elt) {
                        ?>
                    <div class="col-6 col-sm-4 col-md-3 min-card
                            <?php
                            if ($i == 1) {
                                echo "d-none d-sm-flex";
                            } else if ($i == 2) {
                                echo "d-none d-md-flex";
                            } else if ($i > 2) {
                                echo "d-none";
                            }
                            ?>">
                        <a href="<?php echo "./index.php?controller=" . $nom[$e] . "&action=modify&" . $nom[$e] . "=" . $elt[$id]; ?>"
                            class="text-decoration-none text-black">
                            <div class="bordure-basique d-flex flex-column justify-content-between h-100">
                                <div class="p-2 row">
                                    <!-- TITRE -->
                                    <a class="col-9 text-decoration-none text-black"
                                        href="<?php echo "./index.php?controller=" . $nom[$e] . "&action=modify&" . $nom[$e] . "=" . $elt[$id]; ?>">
                                        <?php echo $elt['titre']; ?>
                                    </a>
                                    <!-- ICONE POUBELLE -->
                                    <a class="col-3 text-end text-decoration-none text-black my-auto"
                                        href="<?php echo "./index.php?controller=" . $nom[$e] . "&action=delete&" . $nom[$e] . "=" . $elt[$id]; ?>">
                                        <i class="fas fa-trash-alt"></i>
                                    </a>
                                </div>
                                <!-- IMAGE -->
                                <a
                                    href="<?php echo "./index.php?controller=" . $nom[$e] . "&action=modify&" . $nom[$e] . "=" . $elt[$id]; ?>">
                                    <div class="">
                                        <?php
                                        echo "<img  alt='Image du " . $nom[$e] . htmlspecialchars($elt['titre']) . "' 
                                    src='images/" . $nom[$e] . "/" . $elt['lien_img'] . "'
                                    class='img-fluid'>";
                                        ?>
                                    </div>
                                </a>
                            </div>
                        </a>
                    </div>
                    <?php
                    }
                    ?>
                <!-- Créer un festival -->
                <div class="col-6 col-sm-4 col-md-3 min-card">
                    <a href="./index.php?controller=<?php echo $nom[$e] ?>&action=create"
                        class="text-decoration-none texte-bleu">
                        <div class="btn fond-bleu-clair bordure-basique h-100 d-flex justify-content-center">
                            <div class="row">
                                <span class="col-12 d-flex justify-content-center">
                                    <i class="fas fa-plus grande-icone col-12 my-auto texte-bleu"></i>
                                </span>
                            </div>
                        </div>
                    </a>
                </div>
            </div>
        </div>
        <?php
    }
    ?>

    <footer>
        <div class="container-fluid">
            <div class="row">
                <div class="col-6">
                    <form method="post" action="./index.php?controller=Deconnexion">
                        <button name="deconnexion" class="btn-deco d-none d-md-block d-sm-block">
                            <i class="fa-solid fa-power-off"></i>
                            Deconnexion
                        </button>
                        <button name="deconnexion" class="btn-deco-rond d-md-none d-sm-none">
                            <i class="fa-solid fa-power-off"></i>
                        </button>
                    </form>
                </div>
                <div class="col-6 contenue_droite">
                    <img src="./images/logo-iut.png" class="logo" id="logoIUT" alt="Logo IUT"
                        href="http://www.iut-rodez.fr" target="_blank" />
                </div>
            </div>
        </div>
    </footer>
</body>

</html>