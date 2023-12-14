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

    public function showDashboard(PDO $pdo)
    {
        $user = HttpHelper::getParam("user");
        $listFestivals = $this->festivalsService->getListOfUser($pdo, $user);
        $listSpectacles = $this->spectaclesService->getListOfUser($pdo, $user);
        $vue = new View("/views/dashboard");
        $vue->setVar("listeFestivals", $listFestivals);
        $vue->setVar("listeSpectacles", $listSpectacles);
        return $vue;
    }

}