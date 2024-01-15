<?php
namespace controllers;

use Exception;
use services\CategoriesService;
use services\FestivalsService;
use services\SpectaclesService;
use services\TaillesService;
use services\ImageService;
use yasmf\HttpHelper;
use yasmf\View;
use PDO;

class FestivalController
{

    private FestivalsService $festivalsService;

    private CategoriesService $categoriesService;

    private SpectaclesService $spectaclesService;

    /**
     * Create a new default controller
     */
    public function __construct(FestivalsService $festivalsService, CategoriesService $categoriesService, SpectaclesService $spectaclesService)
    {
        $this->festivalsService = $festivalsService;
        $this->categoriesService = $categoriesService;
        $this->spectaclesService = $spectaclesService;
    }

    /**
     * Redirige l'utilisateur 
     */
    private function badUser()
    {
        return new View("views/no_rights");
    }


    /**
     * Affiche la liste des festivals.
     * @param PDO $pdo la connexion à la bdd
     */
    public function index(PDO $pdo): View
    {
        $user = $_SESSION["user"]["id_login"];
        if (!isset($user)) {
            return $this->badUser();
        }

        $view = new View("views/liste");
        $resultSet = $this->festivalsService->getListThatUserOrganizes($pdo, $user);
        $view->setVar("liste", $resultSet);
        $view->setVar("nom", "festival");
        $view->setVar("nom_pluriel", "festivals");

        return $view;
    }

<<<<<<< HEAD
    /**
     * Création d'un festival
     * @param PDO $pdo la connexion à la bdd
     */
    public function create($pdo): View
    {
=======
    public function create($pdo): View {
>>>>>>> creerScene
        $user = $_SESSION["user"]["id_login"];

        if (!isset($user)) {
            return $this->badUser();
        }

        // création de la vue commune aux différents cas
        $view = new View("views/creerFestival");
        $view->setVar("categories", $this->categoriesService->getList($pdo));

        $mode = HttpHelper::getParam("mode");

        // cas où le formulaire a déjà été affiché et rempli
        if ($mode == "ajout") {
            try {
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
                    $ext = ImageService::extractExtension($img);
                }

                if (!$this->festivalsService->checkGrijData($grij_deb, $grij_fin, $grij_delai)) {
                    throw new Exception("La GriJ n'est pas correctement remplie.");
                }
                $id_grij = $this->festivalsService->addGrij($pdo, $grij_deb, $grij_fin, $grij_delai);

                // Le créateur est automatiquement ajouté avec un trigger
                // Pas disponibles lors de la création mais disponible après dans l'interface de modification
                if (!$this->festivalsService->checkInfo($titre, $desc, $cat, $deb, $fin)) {
                    throw new Exception("Les champs du festival ne sont pas saisis correctement.");
                }
                $id = $this->festivalsService->addFestival($pdo, $titre, $desc, $deb, $fin, $id_grij, $user, $cat);

                // Récupère l'image et la stocke
                if ($ext) {
                    ImageService::ajouterImage($id, "festival", $img, $ext);
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
     * Remplit les champs de "creerFestival"
     */
<<<<<<< HEAD
    private function setChampsGeneraux(View $view, ?string $titre, ?string $desc, ?int $cat, ?string $deb, ?string $fin)
    {
=======
    public function checkInfo(?string $titre, ?string $desc, ?int $cat, ?string $deb, ?string $fin)
    {
        $d_deb = date_create($deb);
        $d_fin = date_create($fin);
        return isset($titre, $desc, $cat, $deb, $fin)
            && strlen($titre) > 0 && strlen($titre) <= 100
            && $cat >= 1 && $cat <= 5
            && $d_deb != false && $d_fin != false
            && $d_fin >= $d_deb;
    }

    /**
     * Vérifie les informations de la Grij
     */
    public function checkGrijData(?string $deb, ?string $fin, ?string $delai)
    {
        $time_regex = "/^(\d{1,2}:\d{1,2}(:\d{1,2})?)$/";
        // Validation
        if (!preg_match($time_regex, $deb) || !preg_match($time_regex, $fin) || !preg_match($time_regex, $delai)) {
            return false;
        }
        $d_deb = explode(":", $deb);
        $d_fin = explode(":", $fin);
        return $d_deb[0] < $d_fin[0]
            && $d_deb[1] <= $d_fin[1]
            && $d_deb[2] <= $d_fin[2];
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
    public function extractExtension(array $img): string|null {
        $extraction_regex = "/\.[^\.]{3}$/";
        $extension = array();
        preg_match($extraction_regex, $img["name"], $extension);
        if (isset($extension)) {
            return $extension[0];
        }
        return null;
    }

    public function setChampsGeneraux(View $view, ?string $titre, ?string $desc, ?int $cat, ?string $deb, ?string $fin) {
>>>>>>> creerScene
        $view->setVar("titre", $titre);
        $view->setVar("desc", $desc);
        $view->setVar("cat", $cat);
        $view->setVar("deb", $deb);
        $view->setVar("fin", $fin);
    }

<<<<<<< HEAD
    /**
     * Remplit les champs de "creerFestival"
     */
    private function setGrij(View $view, ?string $heure_deb, ?string $heure_fin, ?string $delai)
    {
=======
    public function setGrij(View $view, ?string $heure_deb, ?string $heure_fin, ?string $delai) {
>>>>>>> creerScene
        $view->setVar("grij_deb", $heure_deb);
        $view->setVar("grij_fin", $heure_fin);
        $view->setVar("grij_delai", $delai);
    }

    /**
     * Page de modification d'un festival.
     * En lecture seulement.
     * @param PDO $pdo la connexion à la bdd
     */
    public function modify(PDO $pdo): View
    {
        $fest = (int) HttpHelper::getParam("festival");
        $user = $_SESSION["user"]["id_login"];

        if (!isset($user) || !$this->festivalsService->checkOrganisateur($pdo, $user, $fest)) {
            return $this->badUser();
        }

        $aModifier = HttpHelper::getParam("mode") == "modif"; // n'existe que si le formulaire a été validé
        if ($aModifier) {
            return new View("views/not_done");
        }
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

    public function delete($pdo): View {
        $id = HttpHelper::getParam("festival");
        $user = $_SESSION["user"]["id_login"];

        if (!isset($user) || !$this->festivalsService->checkOwner($pdo, $user, $id)) {
            return $this->badUser();
        }

        if ($this->festivalsService->delete($pdo, $id)) {
            header("Location: index.php?controller=Dashboard");
            exit();
        } else {
            header("Location: error.php");
            exit();
        }
    }

    public function createScene($pdo): View {
        $user = $_SESSION["user"]["id_login"];

        if (!isset($user)) {
            header("Location: ./index.php");
            exit();
        }

        $view = new View("views/creerScene");
        $mode = HttpHelper::getParam("mode");

        $nomScene = (string) HttpHelper::getParam("nomScene");
        $nombreSpec = (int) HttpHelper::getParam("nbSpecMax");
        $IDFest = (int) HttpHelper::getParam("festival");
        $tailles = TaillesService::getList($pdo);
        $taillescenes = (int) HttpHelper::getParam("tailleScene");
        $GPSLat = (float) HttpHelper::getParam("coordGPSLat");
        $GPSLong = (float) HttpHelper::getParam("coordGPSLong");

        $view->setVar("taillescenes", $tailles); 
        $view->setVar("IDFest", $IDFest);

        if ($this->festivalsService->verifScene($nomScene, $nombreSpec, $IDFest, $taillescenes, $GPSLat, $GPSLong)) {       
            try {
                $erreur = false;
                $pdo->beginTransaction();
                
                $idScene = $this->festivalsService->addScene($pdo, $nomScene, $nombreSpec, $IDFest, $taillescenes, $GPSLat, $GPSLong);

                $pdo->commit();
            } catch (Exception $e) {
                
                $pdo->rollback();
                $view->setVar("erreur", $e->getMessage());
            }
        }
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

    /**
     * Affiche la liste des spectacles et permet sa modification.
     * @param PDO pdo la connexion à la bdd
     */
    public function seeSpectacles(PDO $pdo): View
    {
        $id_fest = HttpHelper::getParam("festival");
        $user = $_SESSION["user"]["id_login"];

        if (!isset($user) || !$this->festivalsService->checkOrganisateur($pdo, $user, $id_fest)) {
            return $this->badUser();
        }

        $selection = HttpHelper::getParam("selection_fin");
        $view = new View("views/ajouterSpec");

        if (!empty($selection)) {
            $this->festivalsService->ajusterSpectacles($pdo, $id_fest, $selection);
        } // else premier passage

        $infos_fest = $this->festivalsService->getInfo($pdo, $id_fest);
        $tous_spec = $this->spectaclesService::getList($pdo);
        $select_spec = $this->festivalsService->getListOfSpectacle($pdo, $id_fest);

        $view->setVar("id_fest", $id_fest);
        $view->setVar("festival", $infos_fest);
        $view->setVar("spectacles", $tous_spec);
        $view->setVar("selection_debut", $select_spec);
        return $view;
    }

    public function deleteIntervenantHorsScene($pdo): View
    {
        // TODO supprimer intervenant
        $view = new View("views/not_done");
        return $view;
    }

    public function deleteIntervenantSurScene($pdo): View
    {
        // TODO supprimer intervenant
        $view = new View("views/not_done");
        return $view;
    }
}


