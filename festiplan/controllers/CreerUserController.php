<?php
namespace controllers;

use services\UsersService;
use yasmf\View;
use yasmf\HttpHelper;

class CreerUserController
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
        $nom = HttpHelper::getParam("nom");
        $prenom = HttpHelper::getParam("prenom");
        $email = HttpHelper::getParam("email");
        $login = HttpHelper::getParam("identifiant");
        $mdp = HttpHelper::getParam("pswd");
        $loginOk = $this->usersService->valideTaille($login);
        $nomOk = $this->usersService->valideTaille($nom);
        $prenomOk = $this->usersService->valideTaille($prenom);
        $emailOk = $this->usersService->valideMail($email);
        $mdpOk = $this->usersService->valideMdp($mdp);
        if ($loginOk && $nomOk && $prenomOk && $emailOk && $mdpOk) {
            $this->usersService->insertion($pdo, $login, $nom, $prenom, $email, $mdp);
            $view = new View("/views/authentification");
        } else {
            $view = new View("/views/creerCompte");
            $view->setVar("nomOK", $nomOk);
            $view->setVar("loginOk", $loginOk);
            $view->setVar("prenomOk", $prenomOk);
            $view->setVar("emailOk", $emailOk);
            $view->setVar("mdpOk", $mdpOk);
        }
        return $view;
    }


}