<?php
namespace controllers;

session_start();

use services\FestivalsService;
use services\PlanificationService;
use yasmf\HttpHelper;
use yasmf\View;

use PDO;

class PlanificationController
{

    private PlanificationService $planificationService;
    private FestivalsService $festivalsService;

    /**
     * Create a new default controller
     */
    public function __construct($planifService, $festiService)
    {
        $this->planificationService = $planifService;
        $this->festivalsService = $festiService;
    }

    public function index(PDO $pdo)
    {
        $festival = "1";
        $listSpectacle = $this->festivalsService->getListOfSpectacle($pdo, $festival);
        $vue = new View("/views/planification");
        $vue->setVar("listeFestivals", $listSpectacle);
        $vue->setVar("nomFestival", $this->festivalsService->getNomFestivalByID($pdo,$festival));
        return $vue;
    }

}