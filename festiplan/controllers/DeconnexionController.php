<?php
namespace controllers;
session_start();

use yasmf\HttpHelper;
use yasmf\View;


class DeconnexionController
{

    /**
     * Create a new default controller
     */
    public function __construct()
    {

    }

    public function index()
    { 
        session_destroy();
        header('Location: ./index.php');
        exit;
    }

}