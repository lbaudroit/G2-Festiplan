<?php
namespace controllers;

use services\FestivalsService;
use yasmf\View;

class HomeController
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
        // TODO
        $view = new View("accueil_festivals");
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


