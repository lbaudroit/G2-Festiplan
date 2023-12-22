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
}
?>