<?php
namespace utils;

/**
 * Crée l'URL des images depuis index.php
 */
function buildImageURL(string $type, string $path): string
{
    return "../images/$type/$path";
}

?>