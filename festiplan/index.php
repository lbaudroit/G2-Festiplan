<!DOCTYPE html>
<html lang=fr">

<head>
    <title>Accueil - Festiplan</title>
    <link rel="stylesheet" href="./libs/twbs/bootstrap/dist/css/bootstrap.css">
    <link rel="stylesheet" href="./libs/twbs/fortawesome/dist/css/bootstrap.css">
</head>

<body>
    <div class=" container">
        <div class="row">
            <div class="col-12 text-center bg-success-subtle">
                <h1>Coucou <i class="fa-regular fa-thumbs-up"></i></h1>
                <?php
                foreach (scandir("./libs/fortawesome/font-awesome") as $libs) {
                    echo $libs . "<br>";
                } ?>
            </div>
        </div>
    </div>
</body>

</html>