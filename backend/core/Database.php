<?php

namespace app\core;

use app\models\Product;

class Database extends Connection
{
    public function getProducts()
    {
        $statement = "SELECT * FROM producttb";
        $products = $this->get()->prepare($statement);
        $products->execute();
        return $products->fetchAll();
    }


    public function getProduct($sku)
    {
        $statement = "SELECT * FROM producttb WHERE sku = :sku";
        $product = $this->get()->prepare($statement);
        $product->bindValue(':sku', $sku);
        $product->execute();
        return $product->fetch();
    }

    public function deleteProduct($sku)
    {
        $statement = "DELETE FROM producttb WHERE sku = :sku";
        $product = $this->get()->prepare($statement);
        $product->bindValue(':sku', $sku);
        $product->execute();
        return $product->rowCount() > 0;
    }



    public function createProduct($product)
    {
        $statement = "INSERT INTO producttb (sku, name, price, type, value) VALUES (:sku, :name, :price, :type, :value)";

        $stmt = $this->get()->prepare($statement);

        // Use array values directly
        $stmt->bindValue(':sku', $product['sku']);
        $stmt->bindValue(':name', $product['name']);
        $stmt->bindValue(':price', $product['price']);
        $stmt->bindValue(':type', $product['type']);
        $stmt->bindValue(':value', $product['value']);

        $stmt->execute();

        return $stmt->rowCount() > 0 ? ['success' => true, 'message' => 'Product added successfully'] : ['success' => false, 'message' => 'Failed to add product'];
    }


}