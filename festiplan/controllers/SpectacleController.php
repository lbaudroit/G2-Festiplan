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
        $categories = CategoriesService::getList($pdo);
        $tailles = TaillesService::getList($pdo);
        $view = new View("views/creerSpectacle");
        $view->setVar("mode", "ajout");
        $view->setVar("categories", $categories);
        $view->setVar("taillescenes", $tailles);
        return $view;
    }

    public function modify($pdo): View
    {
        $id = HttpHelper::getParam("spectacle");
        $categories = CategoriesService::getList($pdo);
        $tailles = TaillesService::getList($pdo);
        $sur_scene = $this->spectaclesService->getIntervenantsSurScene($pdo, $id);
        $hors_scene = $this->spectaclesService->getIntervenantsHorsScene($pdo, $id);

        $view = new View("views/creerSpectacle");
        $view->setVar("spectacle", $id);
        $view->setVar("mode", "modif");
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

}


