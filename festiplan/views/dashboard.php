<!DOCTYPE html>
<html lang="fr">

<head>
    <title>Dashboard - Festiplan</title>
    <meta charset="UTF-8">

    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css"
        integrity="sha512-DTOQO9RWCH3ppGqcWaEA1BIZOC6xxalwEsw9c2QQeAIftl+Vegovlnee1c9QX4TctnWMn13TZye+giMm8e2LwA=="
        crossorigin="anonymous" referrerpolicy="no-referrer" rel="stylesheet" />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css"
        integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous"
        rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL"
        crossorigin="anonymous"></script>

    <link rel="stylesheet" href="./css/style.css">
</head>

<body>
    <header>
        <span class="titre">Festiplan</span>
    </header>

    <!--LISTE DES FESTIVALS-->
    <div class="container contenue">
        <?php if (isset($listeFestivals)) { ?>
            <div class="row mb-3 h-25">
                <!-- Titre -->
                <div class="col-12 col-sm-8 col-md-3 underline titre2">Mes Festivals&nbsp:</div>

                <!-- Accéder à la page des festivals -->
                <div class="col-12 col-sm-4 col-md-9 text-start my-auto">
                    <a href="./index?controller=festivals&action=index" class="text-decoration-none col-12 texte-bleu">
                        Voir tous mes festivals...
                    </a>
                </div>
                <?php
                // affichage des cartes de festivals  
                foreach ($listeFestivals as $i => $fest) {
                    ?>
                    <div class="col-12 col-sm-6 col-md-3 mh-100 h-100
                            <?php
                            if ($i == 1) {
                                echo "d-none d-sm-flex";
                            } else if ($i == 2) {
                                echo "d-none d-md-flex";
                            } else if ($i > 2) {
                                echo "d-none";
                            }
                            ?>">
                        <a href="./index?controller=festivals&action=modify&festival=<?php echo $fest["id_festival"]; ?>"
                            class="text-decoration-none text-black">
                            <div class="bordure d-flex flex-column justify-content-between">
                                <div class="p-2 row">
                                    <!-- TITRE -->
                                    <a class="col-9 text-decoration-none text-black"
                                        href="./index?controller=festivals&action=modify&festival=<?php echo $fest["id_festival"]; ?>">
                                        <?php echo $fest['titre']; ?>
                                    </a>
                                    <!-- ICONE POUBELLE -->
                                    <a class="col-3 text-end text-decoration-none text-black"
                                        href="./index?controller=festivals&action=delete&festival=<?php echo $fest["id_festival"]; ?>">
                                        <i class="fas fa-trash-alt"></i>
                                    </a>
                                </div>
                                <!-- IMAGE -->
                                <div class="">
                                    <?php
                                    echo "<img  alt='Image du festival " . htmlspecialchars($fest['titre']) . "' 
                                    src='images/festival/" . $fest['lien_img'] . "'
                                    class='img-fluid'>";
                                    ?>
                                </div>
                            </div>
                        </a>
                    </div>
                    <?php
                }
                ?>
            <?php } ?>
            <!-- Créer un festival -->
            <div class="col-12 col-sm-6 col-md-3 fond-bleu-clair bordure text-center row">
                <a href="./index?controller=festivals&action=create"
                    class="text-decoration-none texte-bleu d-flex align-content-center">
                    <i class="fas fa-plus grande-icone col-12 my-auto"></i>
                </a>
            </div>
        </div>
    </div>

    <footer>
        <div class="container-fluid">
            <div class="row">
                <div class="col-6">
                    <! ICI ON MET LE BOUTON DE DECONEXION>
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