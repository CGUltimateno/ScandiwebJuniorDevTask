<?php

namespace app\models;
use app\core\Database;

abstract class Product
{
    public string $sku;
    public string $name;
    public float $price;
    public string $type;
    public string $value;
    public static array $types = ['DVD', 'Book', 'Furniture'];
    public array $data;

    public function __construct($data)
    {
        $this->data = $data;
    }


    public function callValidate() {
        return $this->validate();
    }
    public function validatesku(){
        if(!$this->data['sku']){
            return "Please enter a value";
        }
        $db = new Database();
        if($db->getProduct($this->data['sku'])){
            return "SKU exists";
        }
        $this->sku = $this->data['sku'];
        return "";
    }
    public function validatename(){
        if(!$this->data['name']){
            return "Please enter a name";
        }
        if($this->data['name'] ===''){
            return 'Please enter a name';
        }
        $this->name = $this->data['name'];
        return "";
    }

    public function validateprice(){
        if (!$this->data['price']){
            return "Please enter a price";
        }
        if(!filter_var($this->data['price'], FILTER_VALIDATE_FLOAT) || !(strlen($this->data['price']) > 0) ||!(floatval($this->data['price']) >= 0)){
            return "Wrong Price";
        }
        $this->price = floatval($this->data['price']);
        return "";
    }
    public function type($carry, $item){
        if($carry === true || $item === $carry){
            return true;
        }
        return $carry;
    }

    public function validatetype(){
        if(!$this->data['type']){
            return "Choose a type";
        }
        if (array_reduce($this::$types, array($this, "type"), $this->data['type']) !== true){
            return "Wrong Type";
        }
        $this->type =$this->data['price'];
        return "";
    }
    abstract protected function validate();
}