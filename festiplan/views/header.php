<?php
if (isset($_SESSION["user"])) { ?>
    <header>
        <div class="container-fluid">
            <div class="row">
                <div class="col-6">
                    <a href="./index.php?controller=Dashboard" class="titre text-decoration-none text-black">Festiplan</a>
                </div>
                <div class="col-6 contenue_droite">
                    <i class="fa-solid fa-user fa-4x"></i>
                    <span class="secondTitre">Mon Compte</span>
                </div>
            </div>
    </header>
    <?php
} else {
    ?>
    <header>
        <a href="./index.php" class="titre text-decoration-none text-black">Festiplan</a>
    </header>
    <?php
}
?>