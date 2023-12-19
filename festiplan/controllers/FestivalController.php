<?php
namespace controllers;

use services\FestivalsService;
use yasmf\View;

session_start();

class FestivalController
{

    private FestivalsService $festivalsService;

    /**
     * Create a new default controller
     */
    public function __construct(FestivalsService $festivalsService)
    {
        $this->festivalsService = $festivalsService;
    }


    public function index($pdo): View
    {
        $user = $_SESSION["user"]["id_login"];
        $view = new View("views/liste");
        $resultSet = $this->festivalsService->getListOfUser($pdo, $user);
        $view->setVar("liste", $resultSet);
        $view->setVar("nom", "festival");
        $view->setVar("nom_pluriel", "festivals");

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


