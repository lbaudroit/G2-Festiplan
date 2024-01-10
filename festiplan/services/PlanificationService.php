<?php
namespace services;


use PDO;
use PDOStatement;

/**
 * le modèle de la planification
 */
class PlanificationService
{



    /**
     * Recupère la plannification du festival dans base de donnée si elle a 
     * été généré, sinon il l'a génère avant de renvoyer le resultat sous
     * forme de tableau a double entrées.
     */
    function getPlannif(PDO $pdo, string $idFestival) {
        $rqt = "SELECT id_spectacle, heureDebut
                FROM plannifications
                WHERE idfestival = :idfestival ";
        $searchStmt = $pdo->prepare($sql);
        $searchStmt->bindParam(":idfestival", $idFestival);
        $searchStmt->execute();

        // si le resultat est vide, on genere la plannif
        if (rowcount($res) == 0) {
            $res = genererPlannif($pdo, $idFestival);
        } else {
            $res = convertirEnTableau($searchStmt)
        }

        return $res;
    }

    /**
     * Genere la plannification du festival selon les spectacles et les 
     * renseignements
     */
    function genererPlannif(PDO $pdo, string $idFestival) {
        $listeDesSpectacles = getlisteDesSpectacles($pdo, $idFestival);
        $listeDesScenesDisponible = getlisteDesScenesDisponible($pdo, $idFestival);
        $grijFestival = getGrij($pdo, $idFestival);
        $listeIntervenantDisponible = getlisteIntervenantDisponible($pdo, $grijFestival[0]);

    }

    /**
     * Recupere la liste des intervenants dans la base de donnée, et 
     * leur attribu l'heure de debut de festival par défaut
     */
    function getlisteIntervenantDisponible(PDO $pdo, Date $heureDebut) {
        // Recupere l'heure de debut
        $rqt = "SELECT id_intervenant
                FROM intervenants";
        $searchStmt = $pdo->prepare($sql);
        $searchStmt->execute();

        // stock le resultat dans un tableau
        while($ligne = $searchStmt->fetch()){
            $res[$ligne["id_intervenant"]] = $heureDebut;
        }
        
    }

    /**
     * Recupère la grij du festival
     */
    function getGrij(PDO $pdo, string $idFestival) {
        // Recupere l'heure de debut
        $rqt = "SELECT heure_deb, heure_fin, temps_pause
                FROM grij
                INNER JOIN festivals
                ON grij.id_grij = festivals.id_grij
                WHERE idfestival = :idfestival ";
        $searchStmt = $pdo->prepare($sql);
        $searchStmt->bindParam(":idfestival", $idFestival);
        $searchStmt->execute();

        // stock le resultat dans un tableau
        $res = [$searchStmt["heure_deb"], $searchStmt["heure_fin"], $searchStmt["temps_pause"]];
    }

    /**
     * recupere la liste des spectacles du festival avec son id, dans la base
     */
    function getlisteDesSpectacles(PDO $pdo, string $idFestival) {
        /* requete pour recupérer le titre, la duree et la taille de scene 
           necessaire pour chaque spectacle d'un festival */
        $rqt = "SELECT titre, duree, id_taille
                FROM spectacles
                INNER JOIN contient
                ON contient.id_spectacle = spectacles.id_spectacle
                WHERE id_festival = :idFestival ";
        $searchStmt = $pdo->prepare($sql);
        $searchStmt->bindParam(":idfestival", $idFestival);
        $searchStmt->execute();

        while ($ligne = $searchStmt->fetch()){
            $res[$ligne["titre"]] = [$ligne["duree"],$ligne["id_taille"]];
        } 

        return $res;
    }

    /**
     * recupere la liste des scènes du festival avec son id et sa taille,
     * dans la base lui attribut une heure de disponibilité
     */
    function getlisteDesScenesDisponible(PDO $pdo, string $idFestival) {
        /* requete pour recupérer id_scene */
        $rqt = "SELECT id_scene, id_taille
                FROM scenes
                WHERE id_festival = :idFestival ";
        $searchStmt = $pdo->prepare($sql);
        $searchStmt->bindParam(":idfestival", $idFestival);
        $searchStmt->execute();

        /* requete pour récuperer l'heure de debut */
        $rqt = "SELECT heure_deb
                FROM grij
                INNER JOIN festivals
                ON grij.id_grij = festivals.id_grij
                WHERE id_festival = :idFestival ";
        $heureDebut = $pdo->prepare($sql);
        $heureDebut->bindParam(":idfestival", $idFestival);
        $heureDebut->execute();

        while ($ligne = $searchStmt->fetch()){
            $res[$ligne["id_scene"]] = [$heureDebut ,$ligne["id_taille"]];
        } 

        return $res;
    }

    /**
     * Convertit le resultat de la requete sql qui recupere la plannif en
     * tableau pour la vue
     */
    function convertirEnTableauPlannif(PDOstatement $resDeRequete) {
        while ($ligne = $resDeRequete->fetch()){
            // requete pour recupérer le titre et la duree du spectacle
            $rqt = "SELECT titre, duree
                    FROM spectacles
                    WHERE id_spectacle = :idSpectacle ";
            $searchStmt = $pdo->prepare($sql);
            $searchStmt->bindParam(":idSpectacle", $ligne["idSpectacle"]);
            $searchStmt->execute();

            // stock le resultat dans un tableau a double entreé
            $res[$searchStmt["titre"]]= [$ligne["heureDebut"],$searchStmt["duree"]]
        }

        return $res;
    }
}