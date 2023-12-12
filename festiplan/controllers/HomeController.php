<?php
namespace controllers;

use yasmf\View;

use services\CategoriesService;

class HomeController {

    private CategoriesService $categoriesService;

    /**
     * Create a new default controller
     */
    public function __construct(CategoriesService $categoriesService)
    {
        $this->categoriesService = $categoriesService;
    }

    public function index($pdo):View {
        $searchStmt = $this -> categoriesService -> getAllCategories($pdo);
        $view = new View("/views/all_categories");
        $view->setVar('searchStmt',$searchStmt);
        return $view;
    }

}


