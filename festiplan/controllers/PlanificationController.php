<?php
namespace controllers;

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
        $festival =  HttpHelper::getParam("festival");
        $listSpectacle = $this->festivalsService->getListOfSpectacle($pdo, $festival);
        $vue = new View("/views/planification");
        $vue->setVar("listeFestivals", $listSpectacle);
        $vue->setVar("nomFestival", $this->festivalsService->getNomFestivalByID($pdo,$festival));
        $vue->setVar("GRIJ", $this->festivalsService->getInfo($pdo,$festival));
        $vue->setVar("spectacles", $this->festivalsService->getSpectaclesOfFestival($pdo,$festival));
        $vue->setVar("date",$this->festivalsService->getDateOfFestival($pdo,$festival));
        $vue->setVar("duree",$this->festivalsService->getDureeOfFestival($pdo,$festival));
        $vue->setVar("plannification",$this->planificationService->getPlannif($pdo,$festival));
        return $vue;
    }

}