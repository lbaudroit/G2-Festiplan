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


    public function index($pdo): View{
        $login = HttpHelper::getParam("identifiant");
        $mdp = HttpHelper::getParam("pswd");
        $user = $this->usersService->getUsersLoginAndMdp($pdo, $login, $mdp);
        if ($user != null) {
            $_SESSION['user'] = $user;
            header('Location: ./index.php?controller=Dashboard');
            exit;
        }
        $view = new View("/views/authentification");

        return $view;

        //header('Location: ./index.php?controller=planification');
        //exit;

        /* $login = HttpHelper::getParam("identifiant");
        $mdp = HttpHelper::getParam("pswd");
        $user = $this->usersService->getUsersLoginAndMdp($pdo, $login, $mdp);
        if ($user != null) {
            $_SESSION['user'] = $user;
            header('Location: ./index.php?controller=Dashboard');
            exit;
        }
        $view = new View("/views/authentification");

        return $view; */

    }

}


