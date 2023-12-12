<?php
namespace controllers;

use services\UsersService;
use yasmf\View;

class HomeController
{

    private UsersService $usersService;

    /**
     * Create a new default controller
     */
    public function __construct(UsersService $usersService)
    {
        $this->usersService = $usersService;
    }

    public function index($pdo): View
    {
        $searchStmt = $this->usersService->getUsers($pdo);
        $view = new View("/views/users");
        $view->setVar('searchStmt', $searchStmt);
        return $view;
    }

}


