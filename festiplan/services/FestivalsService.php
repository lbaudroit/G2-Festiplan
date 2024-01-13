<?php
namespace services;

use Exception;
use PDO;
use PDOException;
use PDOStatement;

/**
 * The users service class
 */
class FestivalsService
{
    /**
     * Liste les festivals.
     *
     * @param PDO $pdo the pdo object
     * @return PDOStatement the statement referencing the result set
     */
    public function getList(PDO $pdo): PDOStatement
    {
        $sql = "SELECT * FROM festivals";
        $searchStmt = $pdo->query($sql);
        return $searchStmt;
    }

    /**
     * Liste les festivals dont cet utilisateur est responsable.
     *
     * @param PDO $pdo the pdo object
     * @param string $user l'utilisateur dont on cherche les spectacles
     * @return PDOStatement the statement referencing the result set
     */
    public function getListOfUser(PDO $pdo, string $user): PDOStatement
    {
        $sql = "SELECT * 
            FROM festivals
            WHERE id_login = :login";
        $searchStmt = $pdo->prepare($sql);
        $searchStmt->bindParam(":login", $user);
        $searchStmt->execute();
        return $searchStmt;
    }

    /**
     * Liste les festivals de cet utilisateur.
     *
     * @param PDO $pdo the pdo object
     * @param string $user l'utilisateur dont on cherche les spectacles
     * @return PDOStatement the statement referencing the result set
     */
    public function getListThatUserOrganizes(PDO $pdo, string $user): PDOStatement
    {
        $sql = "
            SELECT * FROM festivals
            INNER JOIN `organise` 
            ON organise.id_festival = festivals.id_festival
            WHERE organise.id_login = :login;";
        $searchStmt = $pdo->prepare($sql);
        $searchStmt->bindParam(":login", $user);
        $searchStmt->execute();
        return $searchStmt;
    }

    /*
     * Trouve les spectacles liés à ce festival.
     *
     * @param PDO $pdo the pdo object
     * @param string $festival le festival dont on cherche les spectacles
     * @return PDOStatement the statement referencing the result set
     */
    public function getListOfSpectacle(PDO $pdo, string $festival): PDOStatement
    {
        $sql = "SELECT spectacles.* 
                FROM spectacles
                INNER JOIN contient
                ON spectacles.id_spectacle = contient.id_spectacle
                WHERE id_festival = :festival";
        $searchStmt = $pdo->prepare($sql);
        $searchStmt->bindParam(":festival", $festival);
        $searchStmt->execute();
        return $searchStmt;
    }

    /* *
     * Renvvoie le nom du festivale de l'ID
     * @param PDO $pdo the pdo object
     * @param string $festival l'ID du festival dont on cherche le nom
     * @return string the statement referencing the result set

     */
    public function getNomFestivalByID(PDO $pdo, string $festival): array
    {
        $sql = "SELECT titre
                FROM festivals
                WHERE id_festival = :festival";
        $searchStmt = $pdo->prepare($sql);
        $searchStmt->bindParam(":festival", $festival);
        $searchStmt->execute();
        $nom = $searchStmt->fetch();
        return $nom;
    }

    /**
     * Trouve les scènes liées à un festival.
     *
     * @param PDO $pdo the pdo object
     * @param string $id_fest l'id du festival que l'on recherche
     * @return PDOStatement the statement referencing the result set
     */
    public function getScenesOfFestival(PDO $pdo, int $id_fest): PDOStatement
    {
        $sql = "SELECT * 
            FROM scenes
            INNER JOIN taillescene
            ON scenes.id_taille = taillescene.id_taille
            WHERE id_festival = :fest";
        $searchStmt = $pdo->prepare($sql);
        $searchStmt->bindParam(":fest", $id_fest);
        $searchStmt->execute();
        return $searchStmt;
    }

    /**
     * Trouve les scènes liées à un festival.
     *
     * @param PDO $pdo the pdo object
     * @param string $id_fest l'id du festival que l'on recherche
     * @return PDOStatement the statement referencing the result set
     */
    public function getOrganisateursOfFestival(PDO $pdo, int $id_fest): PDOStatement
    {
        $sql = "SELECT * 
            FROM users
            INNER JOIN organise
            ON organise.id_login = users.id_login
            WHERE organise.id_festival = :fest";
        $searchStmt = $pdo->prepare($sql);
        $searchStmt->bindParam(":fest", $id_fest);
        $searchStmt->execute();
        return $searchStmt;
    }

    /**
     * Vérifie les informations de base du festival
     */
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
        $d_deb = explode(":", $deb);
        $d_fin = explode(":", $fin);

        /**
         * Il faut qu'au moins un facteur soit supérieur et que tous soient au moins égaux
         */
        $tousAuMoinsEgaux =
            $d_deb[0] <= $d_fin[0]
            && $d_deb[1] <= $d_fin[1];

        $auMoinsUnSuperieur =
            $d_deb[0] < $d_fin[0]
            || $d_deb[1] < $d_fin[1];

        return $this->isValidTime($d_deb) && $this->isValidTime($d_fin)
            && $tousAuMoinsEgaux
            && $auMoinsUnSuperieur;
    }

    /**
     * Vérifie qu'il s'agit d'une heure valide
     * @param array $time un tableau contenant les heures, puis les minutes, puis les secondes
     */
    public function isValidTime(array $time)
    {
        return count($time) == 2 &&
            $time[0] >= 0 && $time[0] < 24 // 24:00 date impossible
            && $time[1] >= 0 && $time[1] < 60;
    }

    /**
     * Crée une grij.
     *
     * @param PDO $pdo the pdo object
     * @param string $nom le nom du festival
     * @param string $nom la description du festival
     * @param string $nom le jour de début du festival
     * @param string $nom le jour de fin du festival
     * @param string $nom la catégorie du festival
     * @return int|null le numéro de la grij insérée ou null si le format était invalide
     */
    public function addGrij(PDO $pdo, string $heuredeb, string $heurefin, string $delai): int|null
    {
        $time_regex = "/^(\d{1,2}:\d{1,2}(:\d{1,2})?)$/";
        if (preg_match($time_regex, $heuredeb) && preg_match($time_regex, $heurefin) && preg_match($time_regex, $delai)) {
            $sql = "INSERT INTO grij (heure_deb, heure_fin, temps_pause) VALUES (:deb, :fin, :delai);";
            $insertStmt = $pdo->prepare($sql);
            $insertStmt->bindParam(":deb", $heuredeb);
            $insertStmt->bindParam(":fin", $heurefin);
            $insertStmt->bindParam(":delai", $delai);
            $insertStmt->execute();
            $id = $pdo->lastInsertId();
            return $id;
        }
        throw new Exception("La GriJ contient des valeurs invalides.");
    }

    /**
     * Crée le festival
     *
     * @param PDO $pdo the pdo object
     * @param string $nom le nom du festival
     * @param string $nom la description du festival
     * @param string $nom le jour de début du festival
     * @param string $nom le jour de fin du festival
     * @param string $nom la catégorie du festival
     * @return PDOStatement the statement referencing the result set
     */
    public function addFestival(
        PDO $pdo,
        string $nom,
        string $desc,
        string $debut,
        string $fin,
        int $grij,
        string $login,
        string $cat,
        string|null $ext = null
    ): int {
        $sql = "
        INSERT INTO festivals (titre, description_f, date_deb, date_fin, id_grij, id_login, id_cat, lien_img)
        VALUES 
        (:nom, :desc, :deb, :fin, :grij, :user, :cat, :img);";
        $searchStmt = $pdo->prepare($sql);
        $searchStmt->bindParam(":nom", $nom);
        $searchStmt->bindParam(":desc", $desc);
        $searchStmt->bindParam(":deb", $debut);
        $searchStmt->bindParam(":fin", $fin);
        $searchStmt->bindParam(":grij", $grij);
        $searchStmt->bindParam(":user", $login);
        $searchStmt->bindParam(":cat", $cat);
        $searchStmt->bindParam(":img", $ext);
        $searchStmt->execute();
        $id = $pdo->lastInsertId();

        return $id;
    }

    /**
     * Récupère les infos d'un festival avec sa grij
     *
     * @param PDO $pdo the pdo object
     * @param string $fest l'ID du festival
     * @return array les données du festival
     */
    public function getInfo(PDO $pdo, int $fest): array
    {
        $sql = "SELECT * FROM festivals
            INNER JOIN grij
            ON grij.id_grij = festivals.id_grij
            WHERE id_festival=:id;";
        $stmt = $pdo->prepare($sql);
        $stmt->bindParam(":id", $fest);
        $stmt->execute();
        return $stmt->fetch();
    }


    /**
     * Renvoie la date du festival
     *
     * @param PDO $pdo the pdo object
     * @param string $fest l'ID du festival
     * @return array les données du festival
     */
    public function getDateOfFestival(PDO $pdo, string $fest): array
    {
        $sql = "SELECT date_deb,DATE_ADD(date_fin,INTERVAL 1 DAY) AS date_fin FROM festivals
                WHERE id_festival=:id;";
        $stmt = $pdo->prepare($sql);
        $stmt->bindParam(":id", $fest);
        $stmt->execute();
        return $stmt->fetch();
    }


    /**
     * Renvoie la date du festival
     *
     * @param PDO $pdo the pdo object
     * @param string $fest l'ID du festival
     * @return array les données du festival
     */
    public function getDureeOfFestival(PDO $pdo, string $fest): int
    {
        $sql = "SELECT date_fin-date_deb+1 FROM festivals
                WHERE id_festival=:id;";
        $stmt = $pdo->prepare($sql);
        $stmt->bindParam(":id", $fest);
        $stmt->execute();
        return $stmt->fetch()["date_fin-date_deb+1"];
    }

    public function delete(PDO $pdo, int $fest)
    {
        // Récupération ID grij
        $sql_grij = "SELECT id_grij FROM festivals WHERE id_festival=?";
        $stmt = $pdo->prepare($sql_grij);
        $stmt->execute([$fest]);
        $res = $stmt->fetch();
        $id_grij = $res["id_grij"];

        $scripts = [
            "DELETE FROM contient WHERE id_festival=:id;",
            "DELETE FROM scenes WHERE id_festival=:id;",
            "DELETE FROM organise WHERE id_festival=:id;",
            "DELETE FROM festivals WHERE id_festival=:id;",
            "DELETE FROM grij WHERE id_grij=:id;"
        ];

        // TODO ajouter la planification
        try {
            $pdo->beginTransaction();
            for ($i = 0; $i < count($scripts); $i++) {
                $sql = $scripts[$i];
                $stmt = $pdo->prepare($sql);
                if ($i = 4) {
                    $stmt->bindParam(":id", $id_grij);
                } else {
                    $stmt->bindParam(":id", $fest);
                }
                $res = $stmt->execute();
                if (!$res) {
                    return false;
                }
            }
        } catch (PDOException $e) {
            $pdo->rollback();
            return false;
        }
        $pdo->commit();
        return true;
    }

    /**
     * Met à jour les spectacles du festival
     * @param PDO $pdo l'objet PDO
     * @param int $id_fest l'identifiant du festival
     * @param array $id_nouveaux la liste des id des nouveaux spectacles
     */
    public function ajusterSpectacles(PDO $pdo, int $id_fest, array $id_nouveaux)
    {
        // récupérer listes spectacles sélectionnés
        $anciens_spectacles = $this->getListOfSpectacle($pdo, $id_fest);
        $id_anciens = array();
        foreach ($anciens_spectacles as $ancien) {
            $id_anciens[] = $ancien["id_spectacle"];
        }

        // permet de sélectionner ceux qui ne sont pas dans les deux array
        $anciens_diff = array_diff($id_anciens, $id_nouveaux);
        $nouveaux_diff = array_diff($id_nouveaux, $id_anciens);

        /*
         * Si id est parmi les sélectionnés : ne rien faire
         * S'il ne l'est pas : le rajouter
         * Si un sélectionné n'est pas dans id : le supprimer
         */
        $pdo->beginTransaction();
        try {
            foreach ($anciens_diff as $ancien) {
                if (!$this->supprimerSpectacle($pdo, $id_fest, $ancien)) {
                    throw new Exception("Impossible de supprimer le spectacle.");
                }
            }
            foreach ($nouveaux_diff as $nouveau) {
                if (!$this->ajouterSpectacle($pdo, $id_fest, $nouveau)) {
                    throw new Exception("Impossible d'ajouter le spectacle.");
                }
            }
        } catch (Exception $e) {
            $pdo->rollback();
            return false;
        }
        $pdo->commit();
        return true;
    }

    function supprimerSpectacle(PDO $pdo, int $id_fest, int $id_spec): bool
    {
        $sql = "DELETE FROM contient WHERE id_festival = :fest AND id_spectacle = :spec";
        $stmt = $pdo->prepare($sql);
        $stmt->bindParam(":fest", $id_fest);
        $stmt->bindParam(":spec", $id_spec);
        return $stmt->execute();
    }

    function ajouterSpectacle($pdo, $id_fest, $id_spec)
    {
        $sql = "INSERT INTO contient (id_festival, id_spectacle) VALUES (:fest, :spec)";
        $stmt = $pdo->prepare($sql);
        $stmt->bindParam(":fest", $id_fest);
        $stmt->bindParam(":spec", $id_spec);
        return $stmt->execute();
    }

    /**
     * Vérifie que l'utilisateur est RESPONSABLE du festival.
     * 
     * @param PDO $pdo l'objet pdo
     * @param string $user l'utilisateur qu'on souhaite vérifier
     * @param int $spec l'id du festival qu'on recherche
     */
    public function checkOwner(PDO $pdo, string $user, int $fest): bool
    {
        $sql = "SELECT * 
            FROM festivals
            WHERE id_login = :login
            AND id_festival = :fest;";
        $searchStmt = $pdo->prepare($sql);
        $searchStmt->bindParam(":login", $user);
        $searchStmt->bindParam(":fest", $fest);
        $searchStmt->execute();
        return $searchStmt->rowCount() > 0;
    }

    /**
     * Vérifie que l'utilisateur est bien ORGANISATEUR du festival.
     * 
     * @param PDO $pdo l'objet pdo
     * @param string $user l'utilisateur qu'on souhaite vérifier
     * @param int $fest l'id du festival qu'on recherche
     */
    public function checkOrganisateur(PDO $pdo, string $user, int $fest): bool
    {
        $sql = "SELECT * 
            FROM users
            INNER JOIN organise
            ON organise.id_login = users.id_login
            WHERE organise.id_festival = :fest
            AND users.id_login = :login;";
        $searchStmt = $pdo->prepare($sql);
        $searchStmt->bindParam(":login", $user);
        $searchStmt->bindParam(":fest", $fest);
        $searchStmt->execute();
        return $searchStmt->rowCount() > 0;
    }
}
?>