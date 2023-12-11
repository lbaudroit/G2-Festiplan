<?php

const PREFIX_TO_RELATIVE_PATH = "";
require $_SERVER['DOCUMENT_ROOT'] . PREFIX_TO_RELATIVE_PATH . '/libs/autoload.php';

use application\DefaultComponentFactory;
use yasmf\DataSource;
use yasmf\Router;

$dataSource = new DataSource(
    $host = 'mezabi-1-db',
    $port = '3306',
    $db = 'festiplan',
    $user = 'server-user',
    $pass = '12AveyronRodezIUT',
    $charset = 'utf8mb4'
);

$router = new Router(new DefaultComponentFactory());
$router->route(PREFIX_TO_RELATIVE_PATH, $dataSource);
?>