<?php
namespace services;

use Exception;
use PDO;
use PDOStatement;
use DateTime;
use services\FestivalsService;

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
    public function getPlannif(PDO $pdo, string $idFestival) {
        $rqt = "SELECT planifie.id_scene, planifie.id_spectacle, planifie.date_spectacle, planifie.heure_deb
                FROM planifie
                INNER JOIN scenes
                ON planifie.id_scene = scenes.id_scene
                WHERE scenes.id_festival = :idfestival ";
        $searchStmt = $pdo->prepare($rqt);
        $searchStmt->bindParam(":idfestival", $idFestival);
        $searchStmt->execute();

        // si le resultat est vide, on genere la plannif
        if ($searchStmt->rowCount() == 0) {
            $res = $this->genererPlannif($pdo, $idFestival);
        } else {
            $res = $this->convertirEnTableau($searchStmt);
        }

        return $res;
    }

    /**
     * Genere la plannification du festival selon les spectacles, les intervenants
     * et les renseignements
     */
    public function genererPlannif(PDO $pdo, string $idFestival) {
        try {
            // Recuperer les valeurs necéssaires pour pouvoir générer la plannification
            $listeDesSpectacles = $this->getlisteDesSpectacles($pdo, $idFestival);
            $grijFestival = $this->getGrij($pdo, $idFestival);
            $listeDesScenesDisponible = $this->getlisteDesScenesDisponible($pdo, $idFestival, $grijFestival[0]);
            $listeIntervenantDisponible = $this->getlisteIntervenantDisponible($pdo, $grijFestival[0]);
            $DureeFestivalEnJour = $this->getDureeOfFestival($pdo,$idFestival);

            // On fait jour apres jour pour placer les spectacles
            for ($jour = 1; $jour <= $DureeFestivalEnJour; $jour++) {
                $listeDesScenesDisponible = $this->resetSceneHeureDispo($listeDesSpectacles, $grijFestival[0]);
                $listeIntervenantDisponible = $this->resetIntervenantHeureDispo($listeIntervenantDisponible, $grijFestival[0]);

                foreach ($listeDesSpectacles as $spectacle) {

                    // si le spectacle n'est pas deja placé (= 0), essaye de le placer sinon prochain spectacle
                    if ($spectacle[3] !=  1) {
                        $sceneChoisi = $this->choisirLaSceneDisponibleAuPlusTot($spectacle, $listeDesScenesDisponible);
                        $listeIntervenantSpectacle = $this->getListeIntervenantSpectacle($pdo, $spectacle[0]);
                        $intervenantDisponibleAuPlusTard = $this->choisirIntervenantDisponibleAuPlusTard($listeIntervenantSpectacle ,$listeIntervenantDisponible);
                        
                        if ($sceneChoisi[1] < $intervenantDisponibleAuPlusTard[1]) {
                            $heureDebut = $intervenantDisponibleAuPlusTard[1];
                        } else {
                            $heureDebut = $sceneChoisi[1];
                        }

                        $heureDeFin = date_add(date_add($heureDebut, $spectacle[1]), $grijFestival[2]);

                        if ($heureDeFin <= $grijFestival[1]){
                            $res[] = [$spectacle[0], $heureDebut, $jour, $sceneChoisi[0]];
                            $listeDesScenesDisponible = $this->miseAJourDisponibiliteScene($sceneChoisi[0], $heureDeFin, $listeDesScenesDisponible);
                            $listeIntervenantDisponible = $this->miseAJourDisponibiliteIntervenant($listeIntervenantSpectacle, $heureDeFin, $listeIntervenantDisponible);
                            $spectacle[3] = 1;
                        }
                    }
                }
            }

            if (count($listeDesSpectacles) != count($res)) {
                throw new Exception("Problème plannification : Un ou plusieurs spectacles n'ont pas pu etre placé pour des raisons de temps ou disponibilités des scenes et intervenants");
            } else {
                $this->savePlannification($pdo, $res);
            }

            return $res;
        } catch (Exception $e) {
            throw new Exception($e->getMessage());
        }
    }

    /**
     * ajoute la plannification a la base de données
     */
    function savePlannification($pdo, $plannification){
        foreach ($plannification as $creneau){
            $rqt = "INSERT INTO plannification VALUES(:idscene, :idSpectacle, :jour, :heured)";
            $searchStmt = $pdo->prepare($rqt);
            $searchStmt->bindParam(":idscene", $creneau[3]);
            $searchStmt->bindParam(":idSpectacle", $creneau[0]);
            $searchStmt->bindParam(":jour", $creneau[2]);
            $searchStmt->bindParam(":heured", $creneau[1]);
            $searchStmt->execute();
        }
    }

    /**
     * Met a jour l'heure de disponibilités des intervenants du spectacles
     */
    function miseAJourDisponibiliteIntervenant($listeIntervenantSpectacle, $heureDeFin, $listeIntervenantDisponible) {
        foreach ($listeIntervenantSpectacle as $idIntervenant) {
            $listeIntervenantDisponible[$idIntervenant] = $heureDeFin;
        }
        
        return  $listeIntervenantDisponible;
    }

    /**
     * Met a jour l'heure de disponibilités d'une scene
     */
    function miseAJourDisponibiliteScene(string $idScene, $heureDeFin, $listeDesScenesDisponible) {
        $listeDesScenesDisponible[$idScene] = $heureDeFin;
        return $listeDesScenesDisponible;
    }

    /**
     * cherche et renvoie l'intervenant du spectacle disponible le plus tard pour
     * demarrer le spectacle.
     */
    function choisirIntervenantDisponibleAuPlusTard($listeIntervenantSpectacle ,$listeIntervenantDisponible) {
        $i = 0;

        foreach ($listeIntervenantSpectacle as $idIntervenant) {
            if ($i == 0) {
                $heureMaxIntervenantDispo = $listeIntervenantDisponible[$idIntervenant];
                $res = array($idIntervenant, $heureMaxIntervenantDispo);
                $i ++;
            }

            if (isset($heureMaxIntervenantDispo) 
                && $heureMaxIntervenantDispo <= $listeIntervenantDisponible[$idIntervenant]) {
                $heureMaxIntervenantDispo = $listeIntervenantDisponible[$idIntervenant];  
                $res = array($idIntervenant, $heureMaxIntervenantDispo); 
            }
        }

        if (!isset($res)){
            throw new Exception("Probleme : Aucun Intervenant dans le spectacle");
        }

        return $res;
    }
    /**
     * Recupere la liste des id intervenants du spectacle hors et sur scene, confondu
     */
    function getListeIntervenantSpectacle($pdo, $idSpectacle) {
        $rqt = "SELECT id_intervenant
                FROM esthorsscene
                WHERE id_spectacle = :idSpectacle";
        $searchStmt = $pdo->prepare($rqt);
        $searchStmt->bindParam(":idSpectacle", $idSpectacle);
        $searchStmt->execute();

        while ($ligne = $searchStmt->fetch()){
            $res[] = $ligne["id_intervenant"];
        } 

        $rqt = "SELECT id_intervenant
                FROM estsurscene
                WHERE id_spectacle = :idSpectacle";
        $searchStmt = $pdo->prepare($rqt);
        $searchStmt->bindParam(":idSpectacle", $idSpectacle);
        $searchStmt->execute();

        while ($ligne = $searchStmt->fetch()){
            $res[] = $ligne["id_intervenant"];
        } 

        return $res;
    }

    /**
     * Choisie une scene disponible au plus tot pour le spectacle, d'une taille 
     * egal ou supérieur a celle nécessaire
     */
    function choisirLaSceneDisponibleAuPlusTot($spectacle, $listeDesScenesDisponible) {
        $i = 0;

        foreach ($listeDesScenesDisponible as $idScene => $infos) {
            if ($spectacle[2] >= $infos[1] && $i == 0){
                $heureMinSceneDispo = $infos[0];
                $res = array($idScene, $heureMinSceneDispo, $infos[1]);
                $i++;
            }
            
            if (isset($heureMinSceneDispo) && 
                ($spectacle[2] == $infos[1] || $heureMinSceneDispo >= $infos[0])) {
                $heureMinSceneDispo = $infos[0];
                $res = array($idScene, $infos[0], $infos[1]);
            }  
        }

        /* si le resultat n'est pas initialisé cela veut dire que il n'y a 
           aucune scene a la bonne taille ou supérieur */
        if (!isset($res)){
            throw new Exception("Un des spectacles ne peut etre placé car il n'y a pas de scene a la bonne taille ou supérieur");
        }

        return $res;
    }

    /**
     * Permet de reinitialiser l'heure de disponibilité des scenes pour une
     * nouvelle journée
     */
    function resetSceneHeureDispo($listeDesSpectacles, $heureDebutGrij) {
        foreach ($listeDesSpectacles as $scene) {
            $scene[1] = $heureDebutGrij;
        }
        return $listeDesSpectacles;
    }

    /**
     * Permet de reinitialiser l'heure de disponibilité des intervenant 
     * pour une nouvelle journée
     */
    function resetIntervenantHeureDispo($listeIntervenantDisponible, $heureDebutGrij) {
        foreach ($listeIntervenantDisponible as $intervenant) {
            $intervenant = $heureDebutGrij;
        }
        return $listeIntervenantDisponible;
    }

    /**
     * Recupere la liste des intervenants dans la base de donnée, et 
     * leur attribu l'heure de debut de festival par défaut
     */
    function getlisteIntervenantDisponible(PDO $pdo, $heureDebut) {
        // Recupere l'heure de debut
        $rqt = "SELECT id_intervenant
                FROM intervenants";
        $searchStmt = $pdo->prepare($rqt);
        $searchStmt->execute();

        // stock le resultat dans un tableau
        while($ligne = $searchStmt->fetch()){
            $res[$ligne["id_intervenant"]] = $heureDebut;
        }

        return $res;
        
    }

    /**
     * Recupère la grij du festival
     */
    function getGrij(PDO $pdo, string $idFestival) {
        // Recupere l'heure de debut
        $rqt = "SELECT grij.heure_deb, grij.heure_fin, grij.temps_pause
                FROM grij
                INNER JOIN festivals
                ON grij.id_grij = festivals.id_grij
                WHERE id_festival = :idfestival ";
        $searchStmt = $pdo->prepare($rqt);
        $searchStmt->bindParam(":idfestival", $idFestival);
        $searchStmt->execute();

        $row = $searchStmt->fetch();
        // stock le resultat dans un tableau
        $res = array($row["heure_deb"], $row["heure_fin"], $row["temps_pause"]);

        return $res;
    }

    /**
     * recupere la liste des spectacles du festival avec son id, dans la base
     */
    function getlisteDesSpectacles(PDO $pdo, string $idFestival) {
        /* requete pour recupérer le titre, la duree et la taille de scene 
           necessaire pour chaque spectacle d'un festival */
        $rqt = "SELECT spectacles.id_spectacle, spectacles.duree, id_taille
                FROM spectacles
                INNER JOIN contient
                ON contient.id_spectacle = spectacles.id_spectacle
                WHERE id_festival = :idFestival ";
        $searchStmt = $pdo->prepare($rqt);
        $searchStmt->bindParam(":idFestival", $idFestival);
        $searchStmt->execute();

        while ($ligne = $searchStmt->fetch()){
            $res[] = [$ligne["id_spectacle"],$ligne["duree"],$ligne["id_taille"],0];
        } 

        if(!isset($res)){
            throw new Exception("Aucun Spectacle n'est associé au festival");
        }
        return $res;
    }

    /**
     * recupere la liste des scènes du festival avec son id et sa taille,
     * dans la base lui attribut une heure de disponibilité
     */
    function getlisteDesScenesDisponible(PDO $pdo, string $idFestival, $heureDebut) {
        /* requete pour recupérer id_scene */
        $rqt = "SELECT id_scene, id_taille
                FROM scenes
                WHERE id_festival = :idFestival
                ORDER BY id_taille";
        $searchStmt = $pdo->prepare($rqt);
        $searchStmt->bindParam(":idFestival", $idFestival);
        $searchStmt->execute();

        while ($ligne = $searchStmt->fetch()){
            $res[$ligne["id_scene"]] = [$heureDebut ,$ligne["id_taille"]];
        } 

        return $res;
    }

    /**
     * Convertit le resultat de la requete rq$rqt qui recupere la plannif en
     * tableau pour la vue
     */
    function convertirEnTableauPlannif(PDO $pdo ,PDOstatement $resDeRequete) {
        while ($ligne = $resDeRequete->fetch()){
            // stock le resultat dans un tableau a double entreé
            $res[]= [$ligne["id_spectacle"], $ligne["heureDebut"], $ligne["id_scene"],$ligne["date"]];

        }

        return $res;
    }

    /**
     * Renvoie la date du festival
     *
     * @param PDO $pdo the pdo object
     * @param string $fest l'ID du festival
     * @return array les données du festival
     */
    public function getDureeOfFestival(PDO $pdo, String $fest): int
    {
        $rqt = "SELECT date_fin-date_deb+1 FROM festivals
                WHERE id_festival=:id;";
        $stmt = $pdo->prepare($rqt);
        $stmt->bindParam(":id", $fest);
        $stmt->execute();
        return $stmt->fetch()["date_fin-date_deb+1"];
    }
}