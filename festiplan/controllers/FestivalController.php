<?php
namespace controllers;

use services\CategoriesService;
use services\FestivalsService;
use yasmf\HttpHelper;
use yasmf\View;

session_start();

class FestivalController
{

    private FestivalsService $festivalsService;

    private CategoriesService $categoriesService;

    /**
     * Create a new default controller
     */
    public function __construct(FestivalsService $festivalsService, CategoriesService $categoriesService)
    {
        $this->festivalsService = $festivalsService;
        $this->categoriesService = $categoriesService;
    }


    public function index($pdo): View
    {
        $user = $_SESSION["user"]["id_login"];
        $view = new View("views/liste");
        $resultSet = $this->festivalsService->getListThatUserOrganizes($pdo, $user);
        $view->setVar("liste", $resultSet);
        $view->setVar("nom", "festival");
        $view->setVar("nom_pluriel", "festivals");

        return $view;
    }

    public function create($pdo): View
    {
        $view = new View("views/creerFestival");
        $cat = $this->categoriesService->getList($pdo);
        $view->setVar("categories", $cat);
        $view->setVar("scenes", array());
        $view->setVar("organisateurs", array());
        return $view;
    }

    public function modify($pdo): View
    {
        $fest = (int) HttpHelper::getParam("festival");
        $cat = $this->categoriesService->getList($pdo);
        $sc = $this->festivalsService->getScenesOfFestival($pdo, $fest);
        $org = $this->festivalsService->getOrganisateursOfFestival($pdo, $fest);
        $view = new View("views/creerFestival");
        $view->setVar("categories", $cat);
        $view->setVar("scenes", $sc);
        $view->setVar("organisateurs", $org);
        return $view;
    }

    public function delete($pdo): View
    {
        // TODO
        $view = new View("views/not_done");
        return $view;
    }

    public function createScene($pdo): View
    {
        // TODO
        $view = new View("views/not_done");
        return $view;
    }

}


