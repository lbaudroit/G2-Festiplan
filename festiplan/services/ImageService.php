<?php

namespace services;

class ImageService
{

    public function __construct()
    {
    }

    /**
     * Crée l'URL des images depuis index.php
     */
    public static function buildImageURL(string $type, int $id, string $path): string
    {
        return "/images/$type/$id$path";
    }

    /**
     * Récupère l'extension du fichier depuis son tableau extrait de $_FILES.
     */
    public static function extractExtension(array $img): string|null
    {
        $from_type_regex = "/^(image\/)(jpg|png|gif)$/";
        $parties = array();
        // Le premier groupe contient l'ensemble matché, le second la partie "/image", la troisième le code de type
        $reussi = preg_match($from_type_regex, $img["type"], $parties);
        if ($reussi != 1) {
            return null;
        }
        return "." . $parties[2];
    }

    /**
     * Récupère l'image telle que passée dans $_FILES et son extension pour la renommer
     * et la rajouter dans le dossier des images
     * @param int $id l'identifiant du spectacle ou festival auquel on ajoute une image
     * @param array $img l'image telle que passée dans $_FILES
     * @param string $ext l'extension sous la forme ".png" par exemple
     * Lance une exception si le format ou les dimensions sont invalides ou si le fichier 
     * ne peut être créé.
     */
    public static function ajouterImage(int $id, string $type, array $img, string $ext)
    {
        $prefixe = substr($type, 0, 1);

        // Vérification du type de fichier
        $accepted_types = [".png", ".gif", ".jpg"];
        if (!in_array($ext, $accepted_types)) {
            throw new Exception("Le type du fichier est invalide.");
        }
        $target_dir = "./images/$type/";
        $target_file = $target_dir . $prefixe . $id . $ext;
        $check = getimagesize($img["tmp_name"]);
        if ($check == false || $check[0] > 800 || $check[1] > 600) {
            throw new Exception("Les dimensions du fichier sont invalides.");
        }
        if (!move_uploaded_file($img["tmp_name"], $target_file)) {
            throw new Exception("Impossible d'uploader l'image.");
        }
    }
}