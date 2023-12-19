<?php
session_start();

if ($user!=null){
    $_SESSION['user']=$user;
}
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
    <!--LISTE DES FESTIVALS-->
    <div class="container contenue">
        <div class="row mb-2">
            <!-- Titre -->
            <div class="underline titre2 width-to-size">Mes Festivals&nbsp:</div>

            <!-- Accéder à la page des festivals -->
            <div class="text-start my-auto width-to-size">
                <a href="./index?controller=festival&action=index" class="text-decoration-none col-12 texte-bleu">
                    Voir tous mes festivals...
                </a>
            </div>
        </div>
        <div class="row row-gap-2">
            <?php
            // affichage des cartes de festivals  
            foreach ($listeFestivals as $i => $fest) {
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
                    <a href="./index?controller=festival&action=modify&festival=<?php echo $fest["id_festival"]; ?>"
                        class="text-decoration-none text-black">
                        <div class="bordure-basique d-flex flex-column justify-content-between h-100">
                            <div class="p-2 row">
                                <!-- TITRE -->
                                <a class="col-9 text-decoration-none text-black"
                                    href="./index?controller=festival&action=modify&festival=<?php echo $fest["id_festival"]; ?>">
                                    <?php echo $fest['titre']; ?>
                                </a>
                                <!-- ICONE POUBELLE -->
                                <a class="col-3 text-end text-decoration-none text-black my-auto"
                                    href="./index?controller=festival&action=delete&festival=<?php echo $fest["id_festival"]; ?>">
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
            <!-- Créer un festival -->
            <div class="col-6 col-sm-4 col-md-3 min-card">
                <a href="./index?controller=festival&action=create" class="text-decoration-none texte-bleu">
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





        <div class="row mb-2">
            <!-- Titre -->
            <div class="underline titre2 width-to-size">Mes Spectacles&nbsp:</div>

            <!-- Accéder à la page des spectacles -->
            <div class="text-start my-auto width-to-size">
                <a href="./index?controller=spectacle&action=index" class="text-decoration-none col-12 texte-bleu">
                    Voir tous mes spectacles...
                </a>
            </div>
        </div>
        <div class="row row-gap-2">
            <?php
            // affichage des cartes de spectacle  
            foreach ($listeSpectacles as $i => $spec) {
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
                    <a href="./index?controller=spectacle&action=modify&spectacle=<?php echo $spec["id_spectacle"]; ?>"
                        class="text-decoration-none text-black">
                        <div class="bordure-basique d-flex flex-column justify-content-between h-100">
                            <div class="p-2 row">
                                <!-- TITRE -->
                                <a class="col-9 text-decoration-none text-black"
                                    href="./index?controller=spectacle&action=modify&spectacle=<?php echo $spec["id_spectacle"]; ?>">
                                    <?php echo $spec['titre']; ?>
                                </a>
                                <!-- ICONE POUBELLE -->
                                <a class="col-3 text-end text-decoration-none text-black my-auto"
                                    href="./index?controller=spectacle&action=delete&spectacle=<?php echo $spec["id_spectacle"]; ?>">
                                    <i class="fas fa-trash-alt"></i>
                                </a>
                            </div>
                            <!-- IMAGE -->
                            <div class="">
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
            <!-- Créer un festival -->
            <div class="col-6 col-sm-4 col-md-3 min-card">
                <a href="./index?controller=spectacle&action=create" class="text-decoration-none texte-bleu">
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