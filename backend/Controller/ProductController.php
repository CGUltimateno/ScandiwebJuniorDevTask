<?php

namespace app\Controller;

use app\core\Database;
use app\models\ProductTypes\Book;
use app\models\ProductTypes\DVD;
use app\models\ProductTypes\Furniture;

class ProductController
{
    private $req;

    public function __construct($req)
    {
        $this->req = $req;
    }

    public function req()
    {
        switch ($this->req) {
            case 'GET':
                $this->index();
                break;
            case 'POST':
                $this->add();
                break;
            case 'DELETE':
                $this->deleteProductsBySkus();
                break;
            default:
                $this->sendResponse(405, ['success' => false, 'message' => 'Invalid request method']);
        }
    }

    private function index()
    {
        $db = new Database();
        $products = $db->getProducts();
        $this->sendResponse(200, $products);
    }

    private function add()
    {
        $data = json_decode(file_get_contents('php://input'), true);

        $product = $this->createProductInstance($data);

        if ($product === null) {
            $this->sendResponse(400, ['success' => false, 'message' => 'Invalid product type']);
            return;
        }

        $errors = $this->validateProduct($product);

        if (!empty($errors)) {
            $this->sendResponse(400, ['success' => false, 'message' => 'Validation errors', 'errors' => $errors]);
            return;
        }

        $db = new Database();
        $result = $db->createProduct($data);
        $this->sendResponse(200, $result);
    }

    private function createProductInstance($data)
    {
        switch ($data['type']) {
            case 'DVD':
                return new DVD($data);
            case 'Book':
                return new Book($data);
            case 'Furniture':
                return new Furniture($data);
            default:
                return null;
        }
    }

    private function validateProduct($product)
    {
        $errors = [
            $product->validatesku(),
            $product->validatename(),
            $product->validateprice(),
            $product->validatetype(),
            $product->callValidate()
        ];

        return array_filter($errors);
    }

    private function deleteProductsBySkus()
    {
        $data = json_decode(file_get_contents('php://input'), true);

        if (!isset($data['skus'])) {
            $this->sendResponse(400, ['success' => false, 'message' => 'Invalid input, no SKUs provided']);
            return;
        }

        $skus = is_array($data['skus']) ? $data['skus'] : [$data['skus']];
        $db = new Database();

        $deleted = array_filter($skus, fn($sku) => $db->deleteProduct($sku));

        if (!empty($deleted)) {
            $this->sendResponse(200, ['success' => true, 'message' => 'Products deleted successfully', 'deleted' => $deleted]);
        } else {
            $this->sendResponse(400, ['success' => false, 'message' => 'No products were deleted']);
        }
    }
    private function sendResponse($statusCode, $response)
    {
        http_response_code($statusCode);
        echo json_encode($response);
    }
}
