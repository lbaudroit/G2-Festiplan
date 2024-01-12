<?php
namespace controllers;

use services\CategoriesService;
use services\SpectaclesService;
use services\TaillesService;
use services\ImageService;
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
        $this->setInfo($view, $titre, $desc, $taille, $cat, $duree_h, $duree_m);
        $view->setVar("mode", "ajout");

        // Champs immuables
        $categories = CategoriesService::getList($pdo);
        $tailles = TaillesService::getList($pdo);
        $view->setVar("categories", $categories);
        $view->setVar("taillescenes", $tailles);

        // Vérification des champs
        if ($this->checkInfo($titre, $desc, $duree_h, $duree_m, $taille, $cat)) {
            $img = $_FILES["img"];
            if (isset($img)) {
                $ext = ImageService::extractExtension($img);
            }
            $id = $this->spectaclesService->createSpectacle(
                $pdo,
                $titre,
                $desc,
                "$duree_h:$duree_m:00",
                $taille,
                $cat,
                $user,
                $ext
            );
            if ($ext != null) {
                ImageService::ajouterImage($id, "spectacle", $img, $ext);
                $view->setVar("ext", $ext);
            }
            $view->setVar("spectacle", $id);
            $sur_scene = $this->spectaclesService->getIntervenantsSurScene($pdo, $id);
            $hors_scene = $this->spectaclesService->getIntervenantsHorsScene($pdo, $id);
            $view->setVar("sur_scene", $sur_scene);
            $view->setVar("hors_scene", $hors_scene);
            $view->setVar("mode", "modif");
        } else {
            $view->setVar("error", "Tous les champs n'ont pas été correctement remplis.");
            $view->setVar("mode", "ajout");
        }
        return $view;
    }

    public function setInfo(View $view, ?string $titre, ?string $desc, ?int $taille, ?int $cat, ?int $duree_h, ?int $duree_m)
    {
        $view->setVar("titre", $titre);
        $view->setVar("desc", $desc);
        $view->setVar("taille", $taille);
        $view->setVar("cat", $cat);
        $view->setVar("duree_h", $duree_h);
        $view->setVar("duree_m", $duree_m);
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
        $this->setInfo(
            $view,
            $info["titre"],
            $info["description_s"],
            $info["id_taille"],
            $info["id_cat"],
            $durees[0],
            $durees[1]
        );
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


    public function ajouterIntervenant($pdo): View
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


