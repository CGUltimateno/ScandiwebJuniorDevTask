<?php

require_once __DIR__ . '/vendor/autoload.php';
require_once __DIR__ . '/config/config.php';


use app\Controller\ProductController;
use app\core\Database;
use app\core\Router;


$db = new Database();
$router = new Router($db);


$router->get('/juniortask/', [ProductController::class, 'index']);
$router->get('/juniortask/add-product/', [ProductController::class, 'add']);
$router->post('/juniortask/add-product/', [ProductController::class, 'add']);
$router->post('/juniortask/delete/', [ProductController::class, 'delete']);
$router->get('/juniortask/api/read/', [ProductController::class, 'read']);

$router->resolve();