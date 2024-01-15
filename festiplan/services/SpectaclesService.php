<?php
namespace services;


use PDO;
use PDOException;
use PDOStatement;

/**
 * The users service class
 */
class SpectaclesService
{
    /**
     * Liste les spectacles.
     *
     * @param PDO $pdo the pdo object
     * @return PDOStatement the statement referencing the result set
     */
    public static function getList(PDO $pdo): PDOStatement
    {
        $sql = "SELECT * FROM spectacles";
        $searchStmt = $pdo->query($sql);
        return $searchStmt;
    }

    /**
     * Trouve les spectacles créés par cet utilisateur.
     *
     * @param PDO $pdo the pdo object
     * @param string $user l'utilisateur dont on cherche les spectacles
     * @return PDOStatement the statement referencing the result set
     */
    public function getListOfUser(PDO $pdo, string $user): PDOStatement
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
     * Vérifie que l'utilisateur a bien les droits d'accéder au spectacle.
     * 
     * @param PDO $pdo l'objet pdo
     * @param string $user l'utilisateur qu'on souhaite vérifier
     * @param int $spec l'id du spectacle qu'on recherche
     */
    public function checkOwner(PDO $pdo, string $user, int $spec): bool
    {
        $sql = "SELECT * 
            FROM spectacles
            WHERE id_login = :user
            AND id_spectacle = :spec;";
        $searchStmt = $pdo->prepare($sql);
        $searchStmt->bindParam(":user", $user);
        $searchStmt->bindParam(":spec", $spec);
        $searchStmt->execute();
        return $searchStmt->rowCount() > 0;
    }

    /*
     * Renvoie les informations de ce spectacle.
     *
     * @param PDO $pdo the pdo object
     * @param int $id_spec l'identifiant du spectacle
     * @return PDOStatement the statement referencing the result set
     */
    public function getInfo(PDO $pdo, int $id_spec): array
    {
        $sql = "SELECT * 
            FROM spectacles
            WHERE id_spectacle = :id";
        $searchStmt = $pdo->prepare($sql);
        $searchStmt->bindParam(":id", $id_spec);
        $searchStmt->execute();
        return $searchStmt->fetch();
    }

    /**
     * Trouve les intervenants sur scènes de ce spectacle.
     *
     * @param PDO $pdo the pdo object
     * @param int $id_spec l'identifiant du spectacle
     * @return PDOStatement the statement referencing the result set
     */
    public function getIntervenantsSurScene(PDO $pdo, int $id_spec): PDOStatement
    {
        $sql = "SELECT * 
            FROM estsurscene
            INNER JOIN intervenants
            ON estsurscene.id_intervenant = intervenants.id_intervenant
            WHERE estsurscene.id_spectacle = :id";
        $searchStmt = $pdo->prepare($sql);
        $searchStmt->bindParam(":id", $id_spec);
        $searchStmt->execute();
        return $searchStmt;
    }

    /**
     * Trouve les intervenants hors scènes de ce spectacle.
     *
     * @param PDO $pdo the pdo object
     * @param int $id_spec l'identifiant du spectacle
     * @return PDOStatement the statement referencing the result set
     */
    public function getIntervenantsHorsScene(PDO $pdo, int $id_spec): PDOStatement
    {
        $sql = "SELECT * 
            FROM esthorsscene
            INNER JOIN intervenants
            ON esthorsscene.id_intervenant = intervenants.id_intervenant
            WHERE esthorsscene.id_spectacle = :id";
        $searchStmt = $pdo->prepare($sql);
        $searchStmt->bindParam(":id", $id_spec);
        $searchStmt->execute();
        return $searchStmt;
    }

    /**
     * Crée un spectacle.
     * 
     * @param PDO $pdo l'objet PDO
     * @param string $titre le nom du spectacle
     * @param string $desc la description du spectacle
     * @param string $duree la durée du spectacle
     * @param int $taille l'id de la taille dans la BDD (clé étrangère)
     * @param int $cat l'id de la catégories (clé étrangère)
     * @param ?string $ext l'extension de l'image
     */
    public function createSpectacle(PDO $pdo, string $titre, string $desc, string $duree, int $taille, int $cat, string $login, ?string $ext): int|false
    {
        try {
            $sql = "INSERT INTO spectacles (titre, description_s, duree, id_cat, id_login, id_taille, lien_img) 
                VALUES (:titre, :descr, :duree, :cat, :user, :taille, :extension)";
            $searchStmt = $pdo->prepare($sql);
            $searchStmt->bindParam(":titre", $titre);
            $searchStmt->bindParam(":descr", $desc);
            $searchStmt->bindParam(":duree", $duree);
            $searchStmt->bindParam(":cat", $cat);
            $searchStmt->bindParam(":user", $login);
            $searchStmt->bindParam(":taille", $taille);
            $searchStmt->bindParam(":extension", $ext);
            $searchStmt->execute();
            return $pdo->lastInsertId();
        } catch (PDOException $e) {
            return false;
        }
    }
}
?>