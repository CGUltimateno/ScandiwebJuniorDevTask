<?php
namespace app\core;

use app\models\Product;
use PDO;

class Database
{
    private PDO $pdo;

    public function __construct()
    {

        $this->pdo = new PDO('mysql:host=' . host . ';port=3306;', user, pass);
        $this->pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        $this->pdo->query("USE juniortest;");
    }

    public function getProducts()
    {
        $statement = $this->pdo->prepare('SELECT * FROM producttb ORDER BY sku');
        $statement->execute();

        return $statement->fetchAll(PDO::FETCH_ASSOC);
    }

    public function getProduct($sku)
    {
        $statement = $this->pdo->prepare('SELECT * FROM producttb WHERE sku = :sku');
        $statement->bindValue(':sku', $sku);
        $statement->execute();

        return $statement->fetch(PDO::FETCH_ASSOC);
    }

    public function deleteProduct($sku)
    {
        $statement = $this->pdo->prepare('DELETE FROM producttb WHERE sku = :sku');
        $statement->bindValue(':sku', $sku);

        return $statement->execute();
    }

    public function createProduct(Product $product)
    {
        $statement = $this->pdo->prepare("INSERT INTO producttb (sku, name, price, type, value)
                VALUES (:sku, :name, :price, :type, :value)");

        $statement->bindValue(':sku', $product->sku);
        $statement->bindValue(':name', $product->name);
        $statement->bindValue(':price', $product->price);
        $statement->bindValue(':type', $product->type);
        $statement->bindValue(':value', $product->value);

        $statement->execute();
    }
}
