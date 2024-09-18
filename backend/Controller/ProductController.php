<?php

namespace app\Controller;

use app\core\Database;

class ProductController
{
    private $req;

    public function __construct($req)
    {
        $this->req = $req;
    }

    public function req()
    {
        if ($this->req === 'GET') {
            self::index();
        } elseif ($this->req === 'POST') {
            self::add();
        } elseif ($this->req === 'DELETE') {
            self::deleteProductsBySkus();
        } else {
            http_response_code(405);
            echo json_encode(['success' => false, 'message' => 'Invalid request method']);
        }
    }

    public function index()
    {
        $db = new Database();
        $products = $db->getProducts();
        echo json_encode($products);
    }

    public function add()
    {
        $data = json_decode(file_get_contents('php://input'), true);
        $db = new Database();
        $product = $db->createProduct($data);
        echo json_encode($product);
    }

    public function deleteProductsBySkus()
    {
        $data = json_decode(file_get_contents('php://input'), true);

        if (isset($data['skus'])) {
            $skus = is_array($data['skus']) ? $data['skus'] : [$data['skus']];

            $db = new Database();
            $deleted = [];
            foreach ($skus as $sku) {
                if ($db->deleteProduct($sku)) {
                    $deleted[] = $sku;
                }
            }
            if (count($deleted) > 0) {
                echo json_encode(['success' => true, 'message' => 'Products deleted successfully', 'deleted' => $deleted]);
            } else {
                echo json_encode(['success' => false, 'message' => 'No products were deleted']);
            }
        } else {
            http_response_code(400);
            echo json_encode(['success' => false, 'message' => 'Invalid input, no SKUs provided']);
        }
    }


}
