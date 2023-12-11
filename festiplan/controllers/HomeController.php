<?php
namespace controllers;

use yasmf\View;

use services\ExampleService;

class HomeController
{

    private ExampleService $exampleService;

    /**
     * Create a new default controller
     */
    public function __construct(ExampleService $serv)
    {
        $this->exampleService = $serv;
    }

    public function index($pdo): View
    {
        $searchStmt = $this->exampleService->getAllUsers($pdo);
        $view = new View("/views/home");
        $view->setVar('users', $searchStmt);
        return $view;
    }

}