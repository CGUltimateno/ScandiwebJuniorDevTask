<?php


namespace app\Controller;
use app\core\Database;
use app\models\ProductTypes\Invalid;
use app\view\ShowProducts;

class ProductController
{
    public static function index()
    {
        $db = new Database();
        ShowProducts::show('products', ['products' => $db->getProducts()]);
    }

    public static function add()
    {
        $product = new Invalid([]);
        $errors = [];
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $productData = [];
            foreach ($_POST as $key => $value) {
                $productData[$key] = $value;
            }
            $name = "app\\models\\ProductTypes\\" . $_POST['type'];
            if (class_exists($name)) {
                $product = new $name($productData);
            } else {
                $product = new Invalid($productData);
            }

            $errors = $product->validatedata();

            if (!$errors) {
                $db = new Database();
                $db->createProduct($product);
                header('Location: /juniortask/');
                exit;
            }
        }

        ShowProducts::show('add', [
            'errors' => $errors,
            'product' => $product
        ]);
    }
    public static function delete()
        {
            if ($_POST) {
                $db = new Database();
                foreach ($_POST as $key => $value) {
                    $db->deleteProduct($key);
                }
            }
            header('Location: /juniortask/');
        }
    public static function read()
    {
        header('Content-Type: /juniortask/application/json/');
        $db = new Database();
        echo json_encode($db->getProduct($_GET['sku']));
    }
}