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

    /**
     * Vérifie la taille
     * @return user the statement referencing the result set
     */
    public function valideTaille($verif) {
        //var_dump($verif);
        if ($verif != null) {
            $regex = "/^.{1,35}$/";
            var_dump(preg_match($regex, $verif));
            return preg_match($regex, $verif, $matches);
        }
        return false;
    }

    /**
     * Vérifie la taille
     * @return user the statement referencing the result set
     */
    public function valideMail($mail) {
        //var_dump($mail);
        if ($mail != null) {
            $regex = "/^.{1,35}$/";
            return preg_match($regex, $mail, $matches)  && filter_var($mail, FILTER_VALIDATE_EMAIL);
        }
        return false;
    }
    
    /**
     * Vérifie la taille
     * @return user the statement referencing the result set
     */
    public function valideMdp($mdp) {
        if ($mdp != null) {
            $regex = '/^(?=.*\d)(?=.*[A-Z])(?=.*[a-z])(?=.*[^\w\d\s:])([^\s]){4,35}$/';
            return preg_match($regex, $mdp, $matches);
        }
        return false;
    }

    /**
     * Vérifie la taille
     * @return user the statement referencing the result set
     */
    public function insertion(PDO $pdo, $login, $lastname, $firstname, $mail, $mdp) {
        $sql = "INSERT INTO users(id_login, nom, prenom, email, hashed_pwd) VALUES (:login, :lastname, :firstname, :mail, :mdp)";
        $searchStmt = $pdo->prepare($sql);
        $searchStmt->bindParam(":login", $login);
        $searchStmt->bindParam(":lastname", $lastname);
        $searchStmt->bindParam(":firstname", $firstname);
        $searchStmt->bindParam(":mail", $mail);
        $searchStmt->bindParam(":mdp", $mdp);
        $searchStmt->execute();
        $user = $searchStmt->fetch();
        //$pdo -> query($sql);
    }

}
?>