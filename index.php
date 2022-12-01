<?php


include_once './classes/Router.php';

const DIR = __DIR__ . '/';


$url = $_SERVER['REQUEST_URI'];
$router = new Router();

$router->addRoute('admin2', 'admin2.php');
$router->addRoute('admin/plugins', 'admin/plugins.php');

$router->route($url);