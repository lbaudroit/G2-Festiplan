<?php

namespace services;

use PDO;
use PDOStatement;

/**
 * Handles the SQL requests to return the list of articles.
 */
class CategoriesService
{
    /**
     * Fetches the clothing categories from the database.
     * @param PDO $pdo the pdo object
     * @return PDOStatement the statement referencing the result set.
     */
    public function getAllCategories(PDO $pdo)
    {
        $sql = "select code_categorie, designation 
        from a_categories
        order by code_categorie";
        $searchStmt = $pdo->prepare($sql);
        $searchStmt->execute();
        return $searchStmt;
    }

    /**
     * Changes the name of a clothing category in the database.
     * @param PDO $pdo the pdo object
     * @param string $designation the new name of the category
     * @param string $code_cat the code of the category to be changed
     */
    public function editCategorie(PDO $pdo, string $designation, string $code_cat)
    {
        $sql = "update a_categories 
            set designation = ? 
            where code_categorie = ?";
        $searchStmt = $pdo->prepare($sql);
        $searchStmt->execute([$designation, $code_cat]);
        $searchStmt->execute();
        return $searchStmt;
    }
}

?>