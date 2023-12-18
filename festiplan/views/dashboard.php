<!DOCTYPE html>
<html lang=fr">

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
            <div class="row mb-3 h-50">
                <!-- Titre -->
                <div class="col-12 col-sm-8 col-md-4 underline titre2">Mes Festivals&nbsp:</div>

                <!-- Accéder à la page des festivals -->
                <div class="col-12 col-sm-4 col-md-8 text-start my-auto">
                    <a href="./festiplan?controller=festivals&action=index" class="text-decoration-none col-12 texte-bleu">
                        Voir tous mes festivals...
                    </a>
                </div>
                <?php
                // affichage des cartes de festivals  
                foreach ($listeFestivals as $i => $fest) {
                    ?>
                    <div class="col-12 col-sm-6 col-md-3 h-25
                            <?php
                            if ($i == 1) {
                                echo "d-none d-sm-flex";
                            } else if ($i == 2) {
                                echo "d-none d-md-flex";
                            } else if ($i > 2) {
                                echo "d-none";
                            }
                            ?>">
                        <a href="./festiplan?controller=festivals&action=modify&festival=<?php echo $fest["id_festival"]; ?>"
                            class="text-decoration-none text-black">
                            <div class="bordure">
                                <div class="row p-2">
                                    <!-- TITRE -->
                                    <div class="col-9">
                                        <?php echo "&nbsp" . $fest['titre']; ?>
                                    </div>
                                    <!-- ICONE POUBELLE -->
                                    <div class="col-3 text-center">
                                        <a
                                            href="./festiplan?controller=festivals&action=delete&festival=<?php echo $fest["id_festival"]; ?>">
                                            <i class="fas fa-trash-alt"></i>
                                        </a>
                                    </div>
                                </div>
                                <!-- IMAGE -->
                                <div class="col-12">
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
            <div class="col-12 col-sm-6 col-md-3 fond-bleu-clair bordure text-center">
                <a href="./festiplan?controller=festivals&action=create" class="text-decoration-none col-12 texte-bleu">
                    <i class="fas fa-plus grande-icone"></i>
                </a>
            </div>
        </div>

        <!--LISTE DES SPECTACLES-->
        <?php if (isset($listeSpectacles)) { ?>
            <div class="row mb-3 h-50">
                <!-- Titre -->
                <div class="col-12 col-sm-8 underline titre2">Mes Spectacles&nbsp:</div>

                <!-- Accès à la carte des autres spectacles-->
                <div class="col-12 col-sm-4 text-start my-auto">
                    <a href="./festiplan?controller=spectacles&action=index"
                        class="col-12 texte-bleu text-decoration-none">Voir tous mes spectacles...</a>
                </div>

                <?php
                // AFFICHAGE DES CARTES DE SPECTACLE
                foreach ($listeSpectacles as $i => $spec) {
                    ?>
                    <div class="col-12 col-sm-6 col-md-3 h-25
                            <?php
                            if ($i == 1) {
                                echo "d-none d-sm-flex";
                            } else if ($i == 2) {
                                echo "d-none d-md-flex";
                            } else if ($i > 2) {
                                echo "d-none";
                            }
                            ?>">
                        <a href="./festiplan?controller=spectacles&action=modify&spectacle=<?php echo $spec["id_spectacle"]; ?>"
                            class="text-decoration-none text-black">
                            <div class="bordure">
                                <div class="row p-2">
                                    <div class="col-9">
                                        <!-- TITRE -->
                                        <?php echo "&nbsp" . $spec['titre']; ?>
                                    </div>
                                    <!-- ICONE POUBELLE -->
                                    <div class="col-3 text-center">
                                        <a
                                            href="./festiplan?controller=spectacles&action=delete&spectacle=<?php echo $spec["id_spectacle"]; ?>">
                                            <i class="fas fa-trash-alt"></i>
                                        </a>
                                    </div>
                                </div>
                                <!-- IMAGE -->
                                <div class="col-12">
                                    <?php
                                    echo "<img  alt='Image du spectacle " . htmlspecialchars($spec['titre']) . "' 
                                    src='images/spectacle/" . $spec['lien_img'] . "'
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
            <!-- Créer un spectacle -->
            <div class="col-12 col-sm-6 col-md-3 fond-bleu-clair text-center bordure">
                <div class="row">
                    <a href="./festiplan?controller=spectacles&action=create"
                        class="text-decoration-none col-12 texte-bleu">
                        <i class="fas fa-plus grande-icone"></i>
                    </a>
                </div>
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