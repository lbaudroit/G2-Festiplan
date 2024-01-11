<?php
namespace controllers;

use services\UsersService;
use services\CreerIntervenantService;

use yasmf\View;
use yasmf\HttpHelper;

class CreerIntervenantController
{

    private UsersService $usersService;
    private CreerIntervenantService $creerIntervenantController;

    /**
     * Create a new default controller
     */
    public function __construct(CreerIntervenantService $creerIntervenantService,UsersService $usersService)
    {
        $this->creerIntervenantService = $creerIntervenantService;
        $this->usersService = $usersService;
    }


    public function index($pdo): View
    {        

        $nom = HttpHelper::getParam("nom");
        $prenom = HttpHelper::getParam("prenom");
        $email = HttpHelper::getParam("email");
        $login = HttpHelper::getParam("identifiant");
        $mdp = HttpHelper::getParam("pswd");
        $loginOk = $this -> usersService -> valideTaille($login);
        $nomOk = $this -> usersService -> valideTaille($nom);
        $prenomOk = $this -> usersService -> valideTaille($prenom);
        $emailOk = $this -> usersService -> valideMail($email);
        $mdpOk = $this -> usersService -> valideMdp($mdp);
       // var_dump($nomOk);
        if ($loginOk && $nomOk && $prenomOk && $emailOk && $mdpOk) {
            $this -> usersService -> insertion($pdo, $login, $nom, $prenom, $email, $mdp);
            $view = new View("/views/authentification");
        } else {
            $view = new View("/views/creerIntervenant"); 
            $view -> setVar("nomOK", $nomOk);
            $view -> setVar("loginOk", $loginOk);
            $view -> setVar("prenomOk", $prenomOk);
            $view -> setVar("emailOk", $emailOk);
            $view -> setVar("mdpOk", $mdpOk);
            
           
        }
        return $view;
    }

}