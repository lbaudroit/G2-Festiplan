<?php
namespace controllers;

use services\FestivalsService;
use services\SpectaclesService;
use yasmf\HttpHelper;
use yasmf\View;

use PDO;

class DashboardController
{

    private FestivalsService $festivalsService;

    private SpectaclesService $spectaclesService;

    /**
     * Create a new default controller
     */
    public function __construct(FestivalsService $festService, SpectaclesService $specService)
    {
        $this->festivalsService = $festService;
        $this->spectaclesService = $specService;
    }

    public function index(PDO $pdo)
    {
        $user = $_SESSION['user']['id_login'];
        $listFestivals = $this->festivalsService->getListThatUserOrganizes($pdo, $user);
        $listSpectacles = $this->spectaclesService->getListOfUser($pdo, $user);
        $vue = new View("/views/dashboard");
        $vue->setVar("listeFestivals", $listFestivals);
        $vue->setVar("listeSpectacles", $listSpectacles);
        return $vue;
    }

}