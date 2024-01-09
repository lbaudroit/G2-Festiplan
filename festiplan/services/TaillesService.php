<?php
namespace services;


use PDO;
use PDOStatement;

/**
 * The users service class
 */
class TaillesService
{
    /**
     * Liste les tailles.
     *
     * @param PDO $pdo the pdo object
     * @return PDOStatement the statement referencing the result set
     */
    public static function getList(PDO $pdo): PDOStatement
    {
        $sql = "SELECT * FROM taillescene;";
        $searchStmt = $pdo->query($sql);
        return $searchStmt;
    }
}
?>