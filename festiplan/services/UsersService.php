<?php
namespace services;


use PDO;
use PDOStatement;

/**
 * The users service class
 */
class UsersService
{
    /**
     * Trouve les utilisateurs
     *
     * @param PDO $pdo the pdo object
     * @return PDOStatement the statement referencing the result set
     */
    public function getUsers(PDO $pdo): PDOStatement
    {
        $sql = "SELECT * FROM users";
        $searchStmt = $pdo->query($sql);
        return $searchStmt;
    }

    /**
     * Trouve les utilisateurs
     *
     * @param PDO $pdo the pdo object
     * @return PDOStatement the statement referencing the result set
     */
    public function getUsersLoginAndMdp(PDO $pdo): PDOStatement
    {
        $sql = "SELECT id_login,hashed_pwd FROM users";
        $searchStmt = $pdo->query($sql);
        return $searchStmt;
    }

}
?>