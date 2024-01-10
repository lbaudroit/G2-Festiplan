<?php
namespace services;


use PDO;
use PDOStatement;

/**
 * The users service class
 */
class CategoriesService
{
    /**
     * Liste les catégories.
     *
     * @param PDO $pdo the pdo object
     * @return PDOStatement the statement referencing the result set
     */
    public function getList(PDO $pdo): PDOStatement
    {
        $sql = "SELECT * FROM categories";
        $searchStmt = $pdo->query($sql);
        return $searchStmt;
    }
}
?>