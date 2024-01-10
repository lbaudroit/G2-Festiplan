<?php
namespace services;


use PDO;
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
}
?>