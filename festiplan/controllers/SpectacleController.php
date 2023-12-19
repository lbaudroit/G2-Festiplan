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
        $user = HttpHelper::getParam("user");
        // TODO à changer en session
        $view = new View("views/liste");
        $resultSet = $this->spectaclesService->getListOfUser($pdo, $user);
        $view->setVar("liste", $resultSet);
        $view->setVar("nom", "spectacle");

        return $view;
    }

    public function create($pdo): View
    {
        // TODO
        $view = new View("accueil_festivals");
        return $view;
    }

    public function modify($pdo): View
    {
        // TODO
        $view = new View("accueil_festivals");
        return $view;
    }

    public function delete($pdo): View
    {
        // TODO
        $view = new View("accueil_festivals");
        return $view;
    }

}


