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

        if (!isset($user)) {
            header("Location: ./index.php");
            exit();
        }

        // création de la vue commune aux différents cas
        $view = new View("views/creerFestival");
        $view->setVar("categories", $this->categoriesService->getList($pdo));

        $mode = HttpHelper::getParam("mode");

        // cas où le formulaire a déjà été affiché et rempli
        if ($mode == "ajout") {
            try {
                $erreur = false;
                $pdo->beginTransaction();
                // Création de la grij
                $grij_deb = HttpHelper::getParam("grij_deb");
                $grij_fin = HttpHelper::getParam("grij_fin");
                $grij_delai = HttpHelper::getParam("grij_delai");

                // Création des champs simples
                $titre = HttpHelper::getParam("titre");
                $desc = HttpHelper::getParam("desc");
                $cat = HttpHelper::getParam("cat");
                $deb = HttpHelper::getParam("deb");
                $fin = HttpHelper::getParam("fin");

                // Récupération de l'extension de fichier
                $img = $_FILES["img_fest"];
                if (isset($img)) {
                    $ext = $this->extractExtension($img);
                }

                if (!isset($grij_deb, $grij_fin, $grij_delai)) {
                    $erreur = "On est rentré dans la boucle";
                    throw new Exception("La GriJ n'est pas entièrement remplie.");
                }
                $id_grij = $this->festivalsService->addGrij($pdo, $grij_deb, $grij_fin, $grij_delai);

                // Le créateur est automatiquement ajouté avec un trigger
                // Pas disponibles lors de la création mais disponible après dans l'interface de modification
                if (!isset($titre, $desc, $cat, $deb, $fin)) {
                    throw new Exception("Les champs du festivals ne sont pas saisis correctement.");
                }
                $id = $this->festivalsService->addFestival($pdo, $titre, $desc, $deb, $fin, $id_grij, $user, $cat);

                // Récupère l'image et la stocke
                if ($ext) {
                    $this->ajouterImage($id, $img, $ext);
                }
                $pdo->commit();
                $view->setVar("fest", $id);
                $view->setVar("ext", $ext);
                $view->setVar("mode", "modif");
                $view->setVar("organisateurs", $this->festivalsService->getOrganisateursOfFestival($pdo, $id));
            } catch (Exception $e) {
                $pdo->rollback();
                $view->setVar("mode", "ajout");
                $view->setVar("organisateurs", array());
                $view->setVar("erreur", $e->getMessage());
            }
            $this->setChampsGeneraux($view, $titre, $desc, $cat, $deb, $fin);
            $this->setGrij($view, $grij_deb, $grij_fin, $grij_delai);
        } else {
            $view->setVar("mode", "ajout");
            $view->setVar("organisateurs", array());
        }
        // variables vides pour afficher une première fois le formulaire
        $view->setVar("scenes", array());
        return $view;
    }

    /**
     * Récupère l'image telle que passée dans $_FILES et son extension pour la renommer
     * et la rajouter dans le dossier des images
     * @param int $id_fest l'identifiant du spectacle auquel on ajoute une image
     * @param array $img l'image telle que passée dans $_FILES
     * @param string $ext l'extension sous la forme ".png" par exemple
     * Lance une exception si le format ou les dimensions sont invalides ou si le fichier 
     * ne peut être créé.
     */
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
        if (!move_uploaded_file($img["tmp_name"], $target_file)) {
            throw new Exception("Impossible d'uploader l'image.");
        }
    }

    /**
     * Récupère l'extension du fichier depuis son tableau extrait de $_FILES.
     */
    public function extractExtension(array $img): string|null
    {
        $extraction_regex = "/\.[^\.]{3}$/";
        $extension = array();
        preg_match($extraction_regex, $img["name"], $extension);
        if (isset($extension)) {
            return $extension[0];
        }
        return null;

    }

    public function setChampsGeneraux(View $view, ?string $titre, ?string $desc, ?int $cat, ?string $deb, ?string $fin)
    {
        $view->setVar("titre", $titre);
        $view->setVar("desc", $desc);
        $view->setVar("cat", $cat);
        $view->setVar("deb", $deb);
        $view->setVar("fin", $fin);
    }

    public function setGrij(View $view, ?string $heure_deb, ?string $heure_fin, ?string $delai)
    {
        $view->setVar("grij_deb", $heure_deb);
        $view->setVar("grij_fin", $heure_fin);
        $view->setVar("grij_delai", $delai);
    }

    public function modify($pdo): View
    {
        $aModifier = HttpHelper::getParam("mode") == "modif"; // n'existe que si le formulaire a été validé
        if ($aModifier) {
            return new View("views/not_done");
        }
        $fest = (int) HttpHelper::getParam("festival");
        $cat = $this->categoriesService->getList($pdo);
        $sc = $this->festivalsService->getScenesOfFestival($pdo, $fest);
        $org = $this->festivalsService->getOrganisateursOfFestival($pdo, $fest);
        $tailles = TaillesService::getList($pdo);
        $info = $this->festivalsService->getInfo($pdo, $fest);

        $view = new View("views/creerFestival");
        $this->setChampsGeneraux(
            $view,
            $info["titre"],
            $info["description_f"],
            $info["id_cat"],
            $info["date_deb"],
            $info["date_fin"]
        );
        $this->setGrij(
            $view,
            $info["heure_deb"],
            $info["heure_fin"],
            $info["temps_pause"]
        );
        $view->setVar("fest", $fest);
        $view->setVar("categories", $cat);
        $view->setVar("scenes", $sc);
        $view->setVar("organisateurs", $org);
        $view->setVar("tailles", $tailles);
        $view->setVar("ext", $info["lien_img"]);
        $view->setVar("mode", "modif");
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

    public function modifyScene($pdo): View
    {
        // TODO voir la liste des spectacles
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


