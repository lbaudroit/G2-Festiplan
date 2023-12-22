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
        $user = $_SESSION["user"]["id_login"];
        $aAjouter = (boolean) HttpHelper::getParam("ajouter");
        if ($aAjouter && isset($user)) {
            $grij_deb = HttpHelper::getParam("grij_deb");
            $grij_fin = HttpHelper::getParam("grij_fin");
            $grij_delai = HttpHelper::getParam("grij_delai");
            $id_grij = $this->festivalsService->addGrij($pdo, $grij_deb, $grij_fin, $grij_delai);


            $titre = HttpHelper::getParam("titre");
            $desc = HttpHelper::getParam("desc");
            $contenu_img = HttpHelper::getParam("img_fest");
            $cat = HttpHelper::getParam("cat");
            $deb = HttpHelper::getParam("deb");
            $fin = HttpHelper::getParam("fin");

            $id_fest = $this->festivalsService->addFestival($pdo, $titre, $desc, $contenu_img, $deb, $fin, $id_grij, $user, $cat);
        } else {

        }

        $listcat = $this->categoriesService->getList($pdo);
        $view = new View("views/creerFestival");
        $view->setVar("categories", $listcat);
        $view->setVar("scenes", array());
        $view->setVar("organisateurs", array());
        return $view;
    }

    private function ajouterFestival()
    {

    }

    public function modify($pdo): View
    {
        $fest = (int) HttpHelper::getParam("festival");
        $cat = $this->categoriesService->getList($pdo);
        $sc = $this->festivalsService->getScenesOfFestival($pdo, $fest);
        $org = $this->festivalsService->getOrganisateursOfFestival($pdo, $fest);
        $view = new View("views/creerFestival");
        $view->setVar("fest", $fest);
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
        // TODO création d'une scène
        $view = new View("views/not_done");
        return $view;
    }

    public function addOrg($pdo): View
    {
        // TODO ajout d'un organisateur
        $view = new View("views/not_done");
        return $view;
    }

    public function seeSpectacles($pdo): View
    {
        // TODO voir la liste des spectacles
        $view = new View("views/not_done");
        return $view;
    }

}


