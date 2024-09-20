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

// Update this routing logic to handle dynamic SKU paths
$controllerMap = [
    'api/products' => 'GET',
    'api/add' => 'POST',
    'api/delete' => 'DELETE',
];

// Check if the path starts with 'api/products/' and extract the SKU
if (preg_match('/^api\/products\/(.+)/', $path, $matches)) {
    $controller = new ProductController('GET');
    $controller->getProductBySku($matches[1]); // Pass the SKU to the controller
} elseif (isset($controllerMap[$path])) {
    $controller = new ProductController($controllerMap[$path]);
    $controller->req();
} else {
    http_response_code(404);
    echo json_encode(['error' => 'Not Found']);
}
