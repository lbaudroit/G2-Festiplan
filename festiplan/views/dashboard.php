<!DOCTYPE html>
<html lang=fr">

<head>
    <title>Dashboard - Festiplan</title>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="./css/style.css">

    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css"
        integrity="sha512-DTOQO9RWCH3ppGqcWaEA1BIZOC6xxalwEsw9c2QQeAIftl+Vegovlnee1c9QX4TctnWMn13TZye+giMm8e2LwA=="
        crossorigin="anonymous" referrerpolicy="no-referrer" rel="stylesheet" />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css"
        integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous"
        rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL"
        crossorigin="anonymous"></script>
</head>

<body>
    <header>

        <span class="titre">Festiplan</span>

    </header>
    <div class="container contenue">
        <?php if (isset($listeFestivals)) { ?>
            <div class="row">
                <div class="col-12">Mes Festivals : </div>
                <?php

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
                        <div class="bordure">
                            <div class="row p-2"> <!--Entete-->
                                <div class="col-10">
                                    <?php echo "&nbsp" . $fest['titre']; ?>
                                </div>
                                <div class="col-2 text-center"><i class="fas fa-trash-alt"></i></div>
                            </div>
                            <div class="col-12">
                                <?php
                                echo "<img  alt='Image du festival " . htmlspecialchars($fest['titre']) . "' 
                                    src='images/festival/" . $fest['lien_img'] . "'
                                    class='img-fluid'>";
                                ?>
                            </div>
                        </div>
                    </div>
                    <?php
                }
                ?>
                <div class="col-12 col-sm-6 col-md-3 h-25">
                    Voir plus de festivals...
                </div>
            <?php } ?>
        </div>

        <footer>
            <div class="container-fluid">
                <div class="row">
                    <div class="col-6">
                        <! ICI ON MET LE BOUTON DE DECONEXION>
                    </div>
                    <div class="col-6 contenue_droite">
                        <img src="../images/logo-iut.png" class="logo" id="logoIUT" alt="Logo IUT"
                            href="http://www.iut-rodez.fr" target="_blank" />
                    </div>
                </div>
            </div>
        </footer>
</body>

</html>