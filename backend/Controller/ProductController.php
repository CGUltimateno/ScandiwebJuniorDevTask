<?php

namespace app\backend\Controller;

use app\backend\core\Database;
use app\backend\models\ProductTypes\Invalid;

class ProductController
{
    // Fetch all products
    public static function index()
    {
        header('Content-Type: application/json');

        $db = new Database();
        $products = $db->getProducts();

        echo json_encode($products);
    }

    // Add a new product
    public static function add()
    {
        header('Content-Type: application/json');
        $productData = json_decode(file_get_contents('php://input'), true);

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $name = "app\\backend\\models\\ProductTypes\\" . $productData['type'];

            if (class_exists($name)) {
                $product = new $name($productData);
            } else {
                $product = new Invalid($productData);
            }

            $errors = $product->validatedata();

            if (empty($errors)) {
                $db = new Database();
                $db->createProduct($product);
                echo json_encode(['success' => true]);
            } else {
                http_response_code(400);
                echo json_encode(['success' => false, 'errors' => $errors]);
            }
        } else {
            http_response_code(405); // Method Not Allowed
            echo json_encode(['success' => false, 'message' => 'Invalid request method']);
        }
    }

    // Delete products
    public static function delete()
    {
        header('Content-Type: application/json');
        $productData = json_decode(file_get_contents('php://input'), true);

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $db = new Database();
            foreach ($productData as $sku) {
                $db->deleteProduct($sku);
            }
            echo json_encode(['success' => true]);
        } else {
            http_response_code(405);
            echo json_encode(['success' => false, 'message' => 'Invalid request method']);
        }
    }

    // Fetch a single product
    public static function read()
    {
        header('Content-Type: application/json');

        $db = new Database();

        if (isset($_GET['sku'])) {
            $product = $db->getProduct($_GET['sku']);
            if ($product) {
                echo json_encode($product);
            } else {
                http_response_code(404);
                echo json_encode(['error' => 'Product not found']);
            }
        } else {
            http_response_code(400);
            echo json_encode(['error' => 'SKU not provided']);
        }
    }
}
