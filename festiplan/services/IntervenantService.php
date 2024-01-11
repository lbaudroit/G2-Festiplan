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
    public function insertion(PDO $pdo, $lastname, $firstname, $mail, $type)
    {
        $sql = "INSERT INTO intervenants VALUES ($lastname,$firstname, $mail)";
        $pdo->query($sql);
    }

} ?>