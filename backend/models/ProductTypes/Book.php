<?php

namespace app\models\ProductTypes;

use app\models\Product;

class Book extends Product
{
    protected function validate()
    {
        if (!$this->data['weight']) {
            return "Please provide a Weight";
        }

        if (is_numeric($this->data['weight']) && floatval($this->data['weight'] >= 0)) {
            $this->value = 'Weight: ' . $this->data['weight'] . ' KGs';
            return "";
        }

        return "Invalid Weight";
    }
};
