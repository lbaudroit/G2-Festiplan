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
     * Liste les festivals de cet utilisateur.
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
     * Trouve les spectacles créés par cet utilisateur.
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

    /**
     * 
     */
    public function getNomFestivalByID(PDO $pdo, string $festival): PDOStatement
    {
        $sql = "SELECT nom
                FROM festivals
                WHERE id_festival = :festival";
        $searchStmt = $pdo->prepare($sql);
        $searchStmt->bindParam(":festival", $festival);
        $searchStmt->execute();
        return $searchStmt;
    }

}
?>