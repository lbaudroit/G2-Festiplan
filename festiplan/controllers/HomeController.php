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
        $login = HttpHelper::getParam("identifiant");
        $mdp = HttpHelper::getParam("pswd");
        $searchStmt = $this->usersService->getUsersLoginAndMdp($pdo, $login, $mdp);
        $view = new View("/views/authentification");
        $view->setVar('searchStmt',$searchStmt);
        return $view;
    }

}


