<?php

namespace app\core;

class Database extends Connection
{
    public function getProducts()
    {
        try {
            $statement = "SELECT * FROM producttb";
            $products = $this->get()->prepare($statement);
            $products->execute();
            return $products->fetchAll();
        } catch (\PDOException $e) {
            return ['success' => false, 'message' => 'Error fetching products'];
        }
    }

    public function getProduct($sku)
    {
        try {
            $statement = "SELECT * FROM producttb WHERE sku = :sku";
            $product = $this->get()->prepare($statement);
            $product->bindValue(':sku', $sku);
            $product->execute();
            return $product->fetch();
        } catch (\PDOException $e) {
            return null;
        }
    }

    public function deleteProduct($sku)
    {
        try {
            $statement = "DELETE FROM producttb WHERE sku = :sku";
            $product = $this->get()->prepare($statement);
            $product->bindValue(':sku', $sku);
            $product->execute();
            return $product->rowCount() > 0;
        } catch (\PDOException $e) {
            return false;
        }
    }

    public function createProduct($product)
    {
        try {
            $statement = "INSERT INTO producttb (sku, name, price, type, value) VALUES (:sku, :name, :price, :type, :value)";
            $stmt = $this->get()->prepare($statement);

            $stmt->bindValue(':sku', $product['sku']);
            $stmt->bindValue(':name', $product['name']);
            $stmt->bindValue(':price', $product['price']);
            $stmt->bindValue(':type', $product['type']);
            $stmt->bindValue(':value', $product['value']);

            $stmt->execute();

            return ['success' => $stmt->rowCount() > 0, 'message' => 'Product added successfully'];
        } catch (\PDOException $e) {
            return ['success' => false, 'message' => 'Failed to add product'];
        }
    }
}
