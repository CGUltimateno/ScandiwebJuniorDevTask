<?php

namespace app\models\ProductTypes;

use app\models\Product;

class DVD extends Product
{
    protected function validate()
    {
        if(!$this->data['size']){
            return"Please enter a size";
        }
        if(is_numeric($this->data['size']) &&floatval($this->data['size'] >=0)){
            $this->value = 'Size' . $this->data['size'] . 'MBs';
            return "";
        }
        return "Invalid Size";
    }
};