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

    <link rel="stylesheet" href="./css/style.css">
</head>

<body>
    <?php include("./views/header.php"); ?>

    <?php
    $nom_pluriel = $nom . "s";
    $id = "id_" . $nom;
    $prefixe_img = $nom[0];
    ?>
    <!--LISTE DES FESTIVALS OU SPECTACLES-->
    <div class="container contenue">
        <div class="row mb-2">
            <!-- Titre -->
            <div class="underline titre2 width-to-size">
                Mes
                <?php echo $nom_pluriel; ?>&nbsp:
            </div>

        </div>
        <div class="row row-gap-2 mb-5">
            <?php // affichage des cartes  
            foreach ($liste as $i => $spec) {
                ?>
                <div class="col-6 col-sm-4 col-md-3 min-card">
                    <a href="<?php echo "./index.php?controller=" . $nom . "&action=modify&" . $nom . "=" . $spec[$id]; ?>"
                        class="text-decoration-none text-black">
                        <div class="bordure-basique d-flex flex-column justify-content-between h-100">
                            <div class="p-2 row">
                                <!-- TITRE -->
                                <a class="col-9 text-decoration-none text-black"
                                    href="<?php echo "./index.php?controller=" . $nom . "&action=modify&" . $nom . "=" . $spec[$id]; ?>">
                                    <?php echo $spec['titre']; ?>
                                </a>
                                <!-- ICONE POUBELLE -->
                                <a class="col-3 text-end text-decoration-none text-black my-auto"
                                    href="<?php echo "./index.php?controller=" . $nom . "&action=delete&" . $nom . "=" . $spec[$id]; ?>">
                                    <i class="fas fa-trash-alt"></i>
                                </a>
                            </div>
                            <!-- IMAGE -->
                            <a
                                href="<?php echo "./index.php?controller=" . $nom . "&action=modify&" . $nom . "=" . $spec[$id]; ?>">
                                <div class="">
                                    <?php
                                    $url = $prefixe_img . (isset($spec["lien_img"]) ? ($spec[$id] . $spec['lien_img']) : "0.jpg");
                                    echo "<img  alt='Image du " . $nom . htmlspecialchars($spec['titre']) . "' 
                                    src='images/$nom/" . $url . "'
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
                <a href="./index.php?controller=<?php echo $nom; ?>&action=create"
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

    <?php include("./views/footer.php"); ?>
</body>

</html>