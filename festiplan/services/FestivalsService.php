<?php
namespace services;

use PDO;
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

    /**
     * Trouve les spectacles liés à un festival.
     *
     * @param PDO $pdo the pdo object
     * @param string $user l'utilisateur dont on cherche les spectacles
     * @return PDOStatement the statement referencing the result set
     */
    public function getSpectaclesOfFestival(PDO $pdo, int $id_fest): PDOStatement
    {
        $sql = "SELECT * 
            FROM spectacles
            WHERE id_login = :login";
        $searchStmt = $pdo->prepare($sql);
        $searchStmt->bindParam(":login", $user);
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
    public function getScenesOfFestival(PDO $pdo, int $id_fest): PDOStatement
    {
        $sql = "SELECT * 
            FROM scenes
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
            $pdo->beginTransaction();
            $sql = "INSERT INTO grij (heure_deb, heure_fin, temps_pause) VALUES (:deb, :fin, :delai);";
            $insertStmt = $pdo->prepare($sql);
            $insertStmt->bindParam(":deb", $heuredeb);
            $insertStmt->bindParam(":fin", $heurefin);
            $insertStmt->bindParam(":delai", $delai);
            $insertStmt->execute();
            $id = $pdo->lastInsertId();
            $pdo->commit();
            return $id;
        }
        return null;
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
        string $img,
        string $debut,
        string $fin,
        int $grij,
        string $login,
        string $cat
    ): PDOStatement {
        $sql = "
        INSERT INTO festivals (titre, description_f, date_deb, date_fin, id_grij, id_login, id_cat)
        VALUES 
        (:nom, :desc, :deb, :fin, :grij, :user, :cat);";
        $searchStmt = $pdo->prepare($sql);
        $searchStmt->bindParam(":nom", $nom);
        $searchStmt->bindParam(":desc", $desc);
        $searchStmt->bindParam(":deb", $debut);
        $searchStmt->bindParam(":fin", $fin);
        $searchStmt->bindParam(":grij", $grij);
        $searchStmt->bindParam(":user", $login);
        $searchStmt->bindParam(":cat", $cat);
        $searchStmt->execute();
        $id = $pdo->lastInsertId();

        // Création du fichier d'image
        // le lien est créé parallèlement dans la BD avec un trigger
        $nomFich = "f" . $id . ".png";
        $file = fopen("./images/festival/" . $nomFich, "w");
        fwrite($file, $img);

        // TODO créer un fichier temporaire pour en vérifier la taille avant de l'insérer

        return $searchStmt;
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