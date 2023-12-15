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

    
    public function index($pdo): View {

        $searchStmt = $this->usersService->getUsersLoginAndMdp($pdo);
        $view = new View("/views/authentification");
        $view->setVar('searchStmt',$searchStmt);
        return $view;
    }

}


