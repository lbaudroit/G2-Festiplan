<?php
namespace services;


use PDO;
use PDOStatement;

/**
 * The Intervenant service class
 */
class IntervenantService
{

    /**
     * Insert user dans la BD
     * 
     */
    public function insertion(PDO $pdo, $lastname, $firstname, $mail)
    {
        $sql = "INSERT INTO intervenants (nom,prenom,email) VALUES (:nom,:prenom,:email)";
        $stmt = $pdo->prepare($sql);
        $stmt->bindParam("nom", $lastname);
        $stmt->bindParam("prenom", $firstname);
        $stmt->bindParam("email", $mail);
        $stmt->execute();
    }

    /**
     * Insert user dans la BD
     * 
     */
    public function liaison(PDO $pdo, $lastname, $firstname, $mail, $type, $spectacle)
    {
        if ($type == 1) {
            $sql = "INSERT INTO esthorsscene (id_intervenant,id_spectacle) VALUES ((SELECT id_intervenant FROM intervenants WHERE nom=:nom AND prenom=:prenom AND email=:email),:leSpectacle)";

        } else if ($type == 0) {
            $sql = "INSERT INTO estsurscene (id_intervenant,id_spectacle) VALUES ((SELECT id_intervenant FROM intervenants WHERE nom=:nom AND prenom=:prenom AND email=:email),:leSpectacle)";
        }
        $stmt = $pdo->prepare($sql);
        $stmt->bindParam("nom", $lastname);
        $stmt->bindParam("prenom", $firstname);
        $stmt->bindParam("email", $mail);
        $stmt->bindParam("leSpectacle", $spectacle);
        $stmt->execute();
    }

    /**
     * verifi si l'intervenant existe deja
     * 
     */
    public function intervenantExisteDeja(PDO $pdo, $lastname, $firstname, $mail)
    {
        $sql = "SELECT * FROM intervenants WHERE nom=:nom AND prenom=:prenom AND email=:email";
        $stmt = $pdo->prepare($sql);
        $stmt->bindParam("nom", $lastname);
        $stmt->bindParam("prenom", $firstname);
        $stmt->bindParam("email", $mail);
        $stmt->execute();
        if ($stmt->fetch() == null) {
            return true;
        } else {
            return false;
        }
    }

    public function intervenantDejaDansSpectacle(PDO $pdo, $lastname, $firstname, $mail, $type, $spectacle)
    {
        if ($type == 0) {
            $sql = "SELECT * FROM estsurscene 
                    WHERE id_intervenant=
                        (SELECT id_intervenant FROM intervenants 
                         WHERE nom=:nom AND prenom=:prenom AND email=:email)
                    AND id_spectacle=:spectacle";
        } else if ($type == 1) {
            $sql = "SELECT * FROM esthorsscene 
                    WHERE id_intervenant=
                        (SELECT id_intervenant FROM intervenants 
                         WHERE nom=:nom AND prenom=:prenom AND email=:email)
                    AND id_spectacle=:spectacle";
        }
        $stmt = $pdo->prepare($sql);
        $stmt->bindParam("nom", $lastname);
        $stmt->bindParam("prenom", $firstname);
        $stmt->bindParam("email", $mail);
        $stmt->bindParam("spectacle", $spectacle);
        $stmt->execute();
        if ($stmt->fetch() == null) {
            return false;
        } else {
            return true;
        }
    }
} ?>