<?php
namespace controllers;

use services\UsersService;
use yasmf\View;
use yasmf\HttpHelper;

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
        $view = new View("/views/authentification");
        $user = $this->usersService->getUsersLoginAndMdp($pdo, $login, $mdp);
        $view->setVar('user',$user);
        return $view;
    }

}


