<footer>
    <div class="container-fluid">
        <div class="row">
            <div class="col-6">
                <?php
                if (isset($_SESSION["user"])) { ?>
                    <form method="post" action="./index.php?controller=Deconnexion">
                        <button name="deconnexion" class="btn-deco d-none d-md-block d-sm-block">
                            <i class="fa-solid fa-power-off"></i>
                            Déconnexion
                        </button>
                        <button name="deconnexion" class="btn-deco-rond d-md-none d-sm-none">
                            <i class="fa-solid fa-power-off"></i>
                        </button>
                    </form>
                <?php } ?>
            </div>
            <div class="col-6 contenue_droite">
                <img src="./images/logo-iut.png" class="logo" id="logoIUT" alt="Logo IUT" href="http://www.iut-rodez.fr"
                    target="_blank" />
            </div>
        </div>
    </div>
</footer>