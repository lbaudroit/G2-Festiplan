<?php
namespace services;


use PDO;
use PDOStatement;

/**
 * The example service class
 */
class ExampleService
{
    /**
     * Returns all users.
     *
     * @param PDO $pdo the pdo object
     * @return PDOStatement the statement referencing the result set
     */
    public function getAllUsers(PDO $pdo): PDOStatement
    {
        $sql = "SELECT * FROM users";
        $searchStmt = $pdo->query($sql);
        return $searchStmt;
    }

}
?>