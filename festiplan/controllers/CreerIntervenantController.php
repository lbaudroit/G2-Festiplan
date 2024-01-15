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
        $type = HttpHelper::getParam("type");
        $spectacle = HttpHelper::getParam("spectacle");
        $nomOk = $this->usersService->valideTaille($nom);
        $prenomOk = $this->usersService->valideTaille($prenom);
        $emailOk = $this->usersService->valideMail($email);
        if ($nomOk && $prenomOk && $emailOk) {
            if (!$this->intervenantService->intervenantDejaDansSpectacle($pdo, $nom, $prenom, $email, $type, $spectacle)) {
                if ($this->intervenantService->intervenantExisteDeja($pdo, $nom, $prenom, $email)){
                    $this->intervenantService->insertion($pdo, $nom, $prenom, $email);
                }
                $this->intervenantService->liaison($pdo, $nom, $prenom, $email, $type, $spectacle);
            }
            header("Location: ./index.php?controller=spectacle&action=modify&spectacle=".$spectacle );
            exit;
        } else {
            $view = new View("/views/creerIntervenant");
            $view->setVar("nomOK", $nomOk);
            $view->setVar("prenomOk", $prenomOk);
            $view->setVar("emailOk", $emailOk);
        }
        return $view;
    }

}