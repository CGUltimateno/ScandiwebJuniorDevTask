<?php

namespace app\models\ProductTypes;

use app\models\Product;

class Book extends Product
{
    protected function validate()
    {
        if (!$this->data['value']) {
            return "Please provide a Weight";
        }
        if (is_numeric($this->data['value']) && floatval($this->data['value']) >= 0) {
            $this->value = 'Weight: ' . $this->data['weight'] . ' KGs';
            return "";
        }

        return "Invalid Weight";
    }
}
