<?php

// Enable error reporting
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

require_once __DIR__ . '/vendor/autoload.php';
require_once __DIR__ . '/config.php';

use app\Controller\ProductController;

$path = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);
$path = trim($path, '/');

// Handle routes
switch ($path) {
    case 'api/products': // Route for fetching all products
        $controller = new ProductController('GET');
        $controller->req();
        break;

    case 'api/add': // Route for adding products
        $controller = new ProductController('POST');
        $controller->req();
        break;

    case 'api/delete':
        $controller = new ProductController('DELETE');
        $controller->req();
        break;

    default:
        http_response_code(404);
        echo json_encode(['error' => 'Not Found']);
        break;
}
