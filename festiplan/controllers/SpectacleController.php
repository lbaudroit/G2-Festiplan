<?php
namespace controllers;

use services\CategoriesService;
use services\SpectaclesService;
use services\TaillesService;
use yasmf\HttpHelper;
use yasmf\View;

class SpectacleController
{

    private SpectaclesService $spectaclesService;

    /**
     * Create a new default controller
     */
    public function __construct(SpectaclesService $spectaclesService)
    {
        $this->spectaclesService = $spectaclesService;
    }


    public function index($pdo): View
    {
        $user = $_SESSION["user"]["id_login"];
        $view = new View("views/liste");
        $resultSet = $this->spectaclesService->getListOfUser($pdo, $user);
        $view->setVar("liste", $resultSet);
        $view->setVar("nom", "spectacle");

        return $view;
    }

    public function create($pdo): View
    {
        $view = new View("views/creerSpectacle");
        $user = $_SESSION["user"]["id_login"];

        // Récupération des valeurs
        $titre = HttpHelper::getParam("titre");
        $desc = HttpHelper::getParam("desc");
        $duree_h = (int) HttpHelper::getParam("duree_h");
        $duree_m = (int) HttpHelper::getParam("duree_m");
        $taille = (int) HttpHelper::getParam("taille");
        $cat = (int) HttpHelper::getParam("cat");

        // Réinsertion des champs
        $view->setVar("titre", $titre);
        $view->setVar("desc", $desc);
        $view->setVar("taille", $taille);
        $view->setVar("cat", $cat);
        $view->setVar("duree_h", $duree_h);
        $view->setVar("duree_m", $duree_m);
        $view->setVar("mode", "ajout");

        // Champs immuables
        $categories = CategoriesService::getList($pdo);
        $tailles = TaillesService::getList($pdo);
        $view->setVar("categories", $categories);
        $view->setVar("taillescenes", $tailles);

        // Vérification des champs
        if ($this->checkInfo($titre, $desc, $duree_h, $duree_m, $taille, $cat)) {
            $this->spectaclesService->createSpectacle($pdo, $titre, $desc, "$duree_h:$duree_m:00", $taille, $cat, $user);
            $view->setVar("mode", "modif");
        } else {
            $view->setVar("mode", "ajout");
        }
        return $view;
    }

    public function modify($pdo): View
    {
        $id = HttpHelper::getParam("spectacle");
        $info = $this->spectaclesService->getInfo($pdo, $id);
        $categories = CategoriesService::getList($pdo);
        $tailles = TaillesService::getList($pdo);
        $sur_scene = $this->spectaclesService->getIntervenantsSurScene($pdo, $id);
        $hors_scene = $this->spectaclesService->getIntervenantsHorsScene($pdo, $id);
        $durees = explode(":", $info["duree"]);

        $view = new View("views/creerSpectacle");
        $view->setVar("spectacle", $id);
        $view->setVar("mode", "modif");
        $view->setVar("ext", $info["lien_img"]);
        $view->setVar("titre", $info["titre"]);
        $view->setVar("desc", $info["description_s"]);
        $view->setVar("taille", $info["id_taille"]);
        $view->setVar("cat", $info["id_cat"]);
        $view->setVar("duree_h", $durees[0]);
        $view->setVar("duree_m", $durees[1]);
        $view->setVar("categories", $categories);
        $view->setVar("taillescenes", $tailles);
        $view->setVar("sur_scene", $sur_scene);
        $view->setVar("hors_scene", $hors_scene);
        return $view;
    }

    public function delete($pdo): View
    {
        // TODO
        $view = new View("views/not_done");
        return $view;
    }

    public function checkInfo(?string $titre, ?string $desc, ?int $duree_h, ?int $duree_m, ?int $taille, ?int $cat)
    {
        return isset($titre, $desc, $duree_h, $duree_m, $taille, $cat)
            && strlen($titre) > 0 && strlen($titre) < 100
            && (($duree_h >= 0 && $duree_h <= 23
                && $duree_m >= 0 && $duree_m <= 59) || ($duree_h == 24 && $duree_m == 00))
            && $taille >= 1 && $taille <= 3
            && $cat >= 1 && $cat <= 5;
    }

}


