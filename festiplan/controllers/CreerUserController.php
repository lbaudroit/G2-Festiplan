<?php 
namespace controllers;
session_start();

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


    public function index(): View
    {
        /* $login = HttpHelper::getParam("identifiant");
        $mdp = HttpHelper::getParam("pswd");
        $user = $this->usersService->getUsersLoginAndMdp($pdo, $login, $mdp);
        if ($user != null) {
            $_SESSION['user']=$user;
            header('Location: ./index.php?controller=Dashboard');
            exit;
        }     */
        

        $view = new View("/views/creerCompte");

        return $view;
    }

    public function formulaireValide($pdo){
        $nom = HttpHelper::getParam("nom");
        $prenom = HttpHelper::getParam("prenom");
        $email = HttpHelper::getParam("email");
        $login = HttpHelper::getParam("identifiant");
        $mdp = HttpHelper::getParam("pswd");

        
    }

}