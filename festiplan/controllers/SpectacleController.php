<?php
namespace controllers;

use services\SpectaclesService;
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
        // TODO
        $view = new View("views/creerSpectacle");
        return $view;
    }

    public function modify($pdo): View
    {
        // TODO
        $view = new View("views/not_done");
        return $view;
    }

    public function delete($pdo): View
    {
        // TODO
        $view = new View("views/not_done");
        return $view;
    }

}


