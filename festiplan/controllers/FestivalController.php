<?php
namespace controllers;

use Exception;
use PDOException;
use services\CategoriesService;
use services\FestivalsService;
use services\TaillesService;
use yasmf\HttpHelper;
use yasmf\View;

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

        /*
        if (isset($user)) {
            header("Location: ./index.php");
            exit();
        }*/

        // création de la vue commune aux différents cas
        $view = new View("views/creerFestival");
        $view->setVar("categories", $this->categoriesService->getList($pdo));

        $aAjouter = (boolean) HttpHelper::getParam("ajouter");
        if ($aAjouter) {
            try {
                $pdo->beginTransaction();
                // Création de la grij
                $grij_deb = HttpHelper::getParam("grij_deb");
                $grij_fin = HttpHelper::getParam("grij_fin");
                $grij_delai = HttpHelper::getParam("grij_delai");
                $id_grij = $this->festivalsService->addGrij($pdo, $grij_deb, $grij_fin, $grij_delai);

                // Création des champs simples
                $titre = HttpHelper::getParam("titre");
                $desc = HttpHelper::getParam("desc");
                $cat = HttpHelper::getParam("cat");
                $deb = HttpHelper::getParam("deb");
                $fin = HttpHelper::getParam("fin");

                $img = $_FILES["img_fest"];
                $ext = $this->extractExtension($img);

                // Création des associations avec scènes et des organisateurs
                // Le créateur est automatiquement ajouté avec un trigger
                // TODO Pas disponibles lors de la création mais disponible après dans l'interface de modification

                $id = $this->festivalsService->addFestival($pdo, $titre, $desc, $deb, $fin, $id_grij, $user, $cat, $ext);
                $view->setVar("titre", $titre);
                $view->setVar("desc", $desc);
                $view->setVar("cat", $cat);
                $view->setVar("deb", $deb);
                $view->setVar("fin", $fin);

                // Récupère l'image et la stocke
                $size = $this->ajouterImage($id, $img, $ext);
                $pdo->commit();
            } catch (Exception $e) {
                $pdo->rollback();
            }

        }
        // variables vides pour afficher une première fois
        $view->setVar("scenes", array());
        $view->setVar("organisateurs", array());
        return $view;
    }

    public function ajouterImage(int $id_fest, array $img, string $ext)
    {
        // Vérification du type de fichier
        $accepted_types = [".png", ".gif", ".jpg"];
        if (!in_array($ext, $accepted_types)) {
            throw new Exception("Le type du fichier est invalide.");
        }
        $target_dir = "./images/festival/";
        $target_file = $target_dir . "f" . $id_fest . $ext;
        $check = getimagesize($img["tmp_name"]);
        if ($check == false || $check[0] > 800 || $check[1] > 600) {
            throw new Exception("Les dimensions du fichier sont invalides.");
        }
        return move_uploaded_file($img["tmp_name"], $target_file);
    }

    /**
     * Récupère l'extension du fichier depuis son tableau extrait de $_FILES.
     */
    public function extractExtension(array $img): string
    {
        $extraction_regex = "/\.[^\.]{3}$/";
        $extension = array();
        preg_match($extraction_regex, $img["name"], $extension);
        return $extension[0];
    }

    public function modify($pdo): View
    {
        $fest = (int) HttpHelper::getParam("festival");
        $cat = $this->categoriesService->getList($pdo);
        $sc = $this->festivalsService->getScenesOfFestival($pdo, $fest);
        $org = $this->festivalsService->getOrganisateursOfFestival($pdo, $fest);
        $tailles = TaillesService::getList($pdo);
        $info = $this->festivalsService->getInfo($pdo, $fest);

        $view = new View("views/creerFestival");
        $view->setVar("fest", $fest);
        $view->setVar("categories", $cat);
        $view->setVar("scenes", $sc);
        $view->setVar("organisateurs", $org);
        $view->setVar("tailles", $tailles);
        $view->setVar("ext", $info["lien_img"]);
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

    public function deleteScene($pdo): View
    {
        // TODO suppression d'une scène
        $view = new View("views/not_done");
        return $view;
    }

    public function addOrg($pdo): View
    {
        // TODO ajout d'un organisateur
        $view = new View("views/not_done");
        return $view;
    }

    public function removeOrg($pdo): View
    {
        // TODO retrait d'un organisateur
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


