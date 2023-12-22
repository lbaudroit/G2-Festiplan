<!DOCTYPE HTML>
<html>

<head>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta charset="utf-8">
    <title>FESTIPLAN - Login</title>

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
    <link rel="stylesheet" href=".\css\style.css">
</head>

<body>
    <header>

        <span class="titre">Festiplan</span>

    </header>
    <div class="contenue">
        <div class="underline titre2 width-to-size">
            Planification du <?php echo $nomFestival?> 
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