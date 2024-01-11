<?php
namespace controllers;

use services\UsersService;
use services\IntervenantService;

use yasmf\View;
use yasmf\HttpHelper;

class CreerIntervenantController
{

    private UsersService $usersService;
    private IntervenantService $intervenantService;

    /**
     * Create a new default controller
     */
    public function __construct(IntervenantService $intervenantService, UsersService $usersService)
    {
        $this->intervenantService = $intervenantService;
        $this->usersService = $usersService;
    }


    public function index($pdo): View
    {

        $nom = HttpHelper::getParam("nom");
        $prenom = HttpHelper::getParam("prenom");
        $email = HttpHelper::getParam("email");
        $login = HttpHelper::getParam("identifiant");
        $mdp = HttpHelper::getParam("pswd");
        $type = HttpHelper::getParam("type");
        $loginOk = $this->usersService->valideTaille($login);
        $nomOk = $this->usersService->valideTaille($nom);
        $prenomOk = $this->usersService->valideTaille($prenom);
        $emailOk = $this->usersService->valideMail($email);
        $mdpOk = $this->usersService->valideMdp($mdp);
        // var_dump($nomOk);
        if ($loginOk && $nomOk && $prenomOk && $emailOk && $mdpOk) {
            $this->intervenantService->insertion($pdo, $nom, $prenom, $email, $type);
            $view = new View("/views/authentification");
        } else {
            $view = new View("/views/creerIntervenant");
            $view->setVar("nomOK", $nomOk);
            $view->setVar("loginOk", $loginOk);
            $view->setVar("prenomOk", $prenomOk);
            $view->setVar("emailOk", $emailOk);
            $view->setVar("mdpOk", $mdpOk);


        }
        return $view;
    }

}