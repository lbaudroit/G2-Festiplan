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
     * return true si la valeur existe et est non vide
     */
    public function valide($valeur)
    {
        if ($valeur != null && $valeur != "") {
            return true;
        } else {
            return false;
        }
    }

    /**
     * Trouve les utilisateurs
     *
     * @param PDO $pdo the pdo object
     * @return user the statement referencing the result set
     */
    public function getUsersLoginAndMdp(PDO $pdo, $login, $mdp)
    {
        if (UsersService::valide($login) && UsersService::valide($mdp)){

            $searchStmt = $pdo->prepare('SELECT * FROM users WHERE id_login= ? AND hashed_pwd= ? ');
            $searchStmt->bindParam(1, $login);
            $searchStmt->bindParam(2, $mdp);
            $searchStmt->execute();
            $user = $searchStmt->fetch();
            return $user;
        } else {
            return null;
        }
    }

    /**
     * Crée un utilisateur
     *
     * @param PDO $pdo the pdo object
     * @return user the statement referencing the result set
     */
    public function addUsers(PDO $pdo, $lastname, $firstname, $mail, $login, $mdp) {
        if (UsersService::valide($login) && UsersService::valide($mdp) && UsersService::valide($lastname) && UsersService::valide($firstname) && UsersService::valide($mail)) {
            $searchStmt = $pdo->prepare('INSERT INTO users VALUES ()');
            $searchStmt->bindParam(1, $login);
            $searchStmt->bindParam(2, $mdp);
            $searchStmt->execute();
            $user = $searchStmt->fetch();
        }
    }


}
?>