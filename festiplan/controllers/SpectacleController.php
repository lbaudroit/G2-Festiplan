<?php
namespace controllers;

use services\SpectaclesService;
use yasmf\View;

class HomeController
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


