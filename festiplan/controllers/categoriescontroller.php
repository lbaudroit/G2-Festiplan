<?php

/*
if ($modeEdition) {
try {
} catch (PDOException $exception) {
throw new PDOException($exception->getMessage(), (int) $exception->getCode());
}
}*/

namespace controllers;

use services\CategoriesService;
use yasmf\HttpHelper;
use yasmf\View;

class CategoriesController
{

    private CategoriesService $categoriesService;

    /**
     * Create a new default controller
     */
    public function __construct(CategoriesService $categoriesService)
    {
        $this->categoriesService = $categoriesService;
    }

    public function index($pdo)
    {
        $codeCategorie = HttpHelper::getParam("code_categorie");
        $designationCategorie = HttpHelper::getParam("categorie");
        $view = new View("/views/edit-categorie");
        $view->setVar('code', $codeCategorie);
        $view->setVar('designation', $designationCategorie);
        return $view;
    }

    public function edition($pdo)
    {
        $codeCategorie = HttpHelper::getParam("code_categorie");
        $designationCategorie = HttpHelper::getParam("categorie");
        $searchStmt = $this->categoriesService->editCategorie($pdo, $designationCategorie, $codeCategorie);
        if ($searchStmt) {
            $message = "Catégorie modifiée !";
        }
        $view = new View("/views/edit-categorie");
        $view->setVar('message', $message);
        $view->setVar('code', $codeCategorie);
        $view->setVar('designation', $designationCategorie);
        return $view;
    }

}