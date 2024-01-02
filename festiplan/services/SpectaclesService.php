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
    public function getList(PDO $pdo): PDOStatement
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
            WHERE id_login = :login
            AND id_spectacle = :spec;";
        $searchStmt = $pdo->prepare($sql);
        $searchStmt->bindParam(":login", $user);
        $searchStmt->bindParam(":spec", $spec);
        $searchStmt->execute();
        return $searchStmt->rowCount() > 0;
    }
}
?>