<?php

require_once __DIR__ . '/vendor/autoload.php';

use app\Controller\ProductController;

header("Access-Control-Allow-Origin: http://localhost:3000");
header("Access-Control-Allow-Methods: GET, POST, OPTIONS, DELETE");
header("Access-Control-Allow-Headers: Content-Type, Authorization");

if ($_SERVER['REQUEST_METHOD'] === 'OPTIONS') {
    http_response_code(200);
    exit();
}

$path = trim(parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH), '/');

$controllerMap = [
    'api/products' => 'GET',
    'api/add' => 'POST',
    'api/delete' => 'DELETE',
];

if (isset($controllerMap[$path])) {
    $controller = new ProductController($controllerMap[$path]);
    $controller->req();
} else {
    http_response_code(404);
    echo json_encode(['error' => 'Not Found']);
}
