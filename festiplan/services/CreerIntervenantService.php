<?php
namespace services;


use PDO;
use PDOStatement;

/**
 * The creerIntervenant service class
 */
class CreerIntervenantService
{

    /**
     * Crée un utilisateur
     *
     * @param PDO $pdo the pdo object
     * 
     */
    public function addUsers(PDO $pdo, $lastname, $firstname, $mail, $login, $mdp)
    {

        $searchStmt = $pdo->prepare('INSERT INTO users VALUES ()');
        $searchStmt->bindParam(1, $login);
        $searchStmt->bindParam(2, $mdp);
        $searchStmt->execute();
        $user = $searchStmt->fetch();

    }

}?>