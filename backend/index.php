<?php

require_once __DIR__ . '/vendor/autoload.php';
require_once __DIR__ . '/config/config.php';


use app\backend\Controller\ProductController;
use app\backend\core\Database;
use app\backend\core\Router;


$db = new Database();
$router = new Router($db);


$router->get('/', [ProductController::class, 'index']);
$router->get('/add-product/', [ProductController::class, 'add']);
$router->post('/add-product/', [ProductController::class, 'add']);
$router->post('/delete/', [ProductController::class, 'delete']);
$router->get('/api/read/', [ProductController::class, 'read']);

$router->resolve();