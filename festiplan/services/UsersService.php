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
     * @return array the statement referencing the result set
     */
    public function getUsersLoginAndMdp(PDO $pdo, $login, $mdp) {
        if (UsersService::valide($login) && UsersService::valide($mdp)) {
            $searchStmt = $pdo->prepare('SELECT hashed_pwd FROM users WHERE id_login= ?');
            $searchStmt->bindParam(1, $login);
            $searchStmt->execute();
            $user = $searchStmt->fetch();
            //var_dump($user);
            if (password_verify($mdp, $user["hashed_pwd"])) {
                $searchStmt = $pdo->prepare('SELECT * FROM users WHERE id_login= ?');
                $searchStmt->bindParam(1, $login);
                $searchStmt->execute();
                $user = $searchStmt->fetch();
                return $user;
            }
            return  null;
        } else {
            return null;
        }
    }

    /**
     * Crée un utilisateur
     *
     * @param PDO $pdo the pdo object
     * 
     */
    public function addUsers(PDO $pdo, $lastname, $firstname, $mail, $login, $mdp)
    {
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
     * @return boolean the statement referencing the result set
     */
    public function valideTaille($verif)
    {
        //var_dump($verif);
        if ($verif != null) {
            $regex = "/^.{1,35}$/";
            return preg_match($regex, $verif, $matches);
        }
        return false;
    }

    /**
     * Vérifie la taille
     * @return boolean the statement referencing the result set
     */
    public function valideMail($mail)
    {
        //var_dump($mail);
        if ($mail != null) {
            $regex = "/^.{1,35}$/";
            return preg_match($regex, $mail, $matches) && filter_var($mail, FILTER_VALIDATE_EMAIL);
        }
        return false;
    }

    /**
     * Vérifie la taille
     * @return boolean the statement referencing the result set
     */
    public function valideMdp($mdp)
    {
        if ($mdp != null) {
            $regex = '/^(?=.*\d)(?=.*[A-Z])(?=.*[a-z])(?=.*[^\w\d\s:])([^\s]){4,35}$/';
            return preg_match($regex, $mdp, $matches);
        }
        return false;
    }

    /**
     * Insert user dans la BD
     * 
     */
    public function verifDoublonEmail(PDO $pdo, $email) {
        $searchStmt = $pdo->prepare("SELECT email FROM users");
        $searchStmt->execute();
        $mailOk = true;
        foreach ($searchStmt as $ligne) {
            if ($ligne["email"] == $email) {
                $mailOk = false;
            }
        }
        return $mailOk;
    }

    /**
     * Vérifie la taille
     * @return boolean the statement referencing the result set
     */
    public function verifDoublonLogin(PDO $pdo, $login) {
        $searchStmt = $pdo->prepare("SELECT id_login FROM users");
        $searchStmt->execute();
        $logOk = true;
        foreach ($searchStmt as $ligne) {
            if ($ligne["id_login"] == $login) {
                $logOk = false;
            }
        }
        return $logOk;
    }

    
    public function insertion(PDO $pdo, $lastname, $firstname, $mail, $login, $mdp)
    {
        $sql = "INSERT INTO users VALUES ($login, $lastname,$firstname, $mail, $mdp)";
        $pdo->query($sql);
    }

}
?>