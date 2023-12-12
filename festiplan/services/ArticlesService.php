<?php
    namespace services;


    use PDO;
    use PDOStatement;
    
    /**
     * The articles service class
     */
    class ArticlesService
    {
        /**
         * Find clothing articles by category.
         *
         * @param PDO $pdo the pdo object
         * @param string $codeCategorie the category alias
         * @return PDOStatement the statement referencing the result set
         */
        public function findArticlesByCategory(PDO $pdo, string $codeCategorie): PDOStatement
        {
            $sql = "select id_article, code_article, designation 
            from articles
            where categorie = ?
            order by code_article";
            $searchStmt = $pdo->prepare($sql);
            $searchStmt->execute([$codeCategorie]);
            return $searchStmt;
        }
    
    }
?>