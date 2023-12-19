<?php
const PREFIX_TO_RELATIVE_PATH = "/festiplan";
require $_SERVER['DOCUMENT_ROOT'] . PREFIX_TO_RELATIVE_PATH . '/libs/autoload.php';

use application\DefaultComponentFactory;
use yasmf\DataSource;
use yasmf\Router;

$dataSource = new DataSource(
    $host = 'saccharun.fr',
    $port = '6612',
    $db = 'festiplan',
    $user = 'server-user',
    $pass = '12AveyronRodezIUT',
    $charset = 'utf8mb4'
);

//Pour développer une page pas encore accessible, ajouter vos paramètres ici
/*
$_GET["controller"] = "spectacle";
$_GET["action"] = "index";
$_GET["user"] = "francksilvestre";
*/

try {
    $router = new Router(new DefaultComponentFactory());
    $router->route(PREFIX_TO_RELATIVE_PATH, $dataSource);
} catch (PDOException $e) {
    header("Location: ./error.php");
}

