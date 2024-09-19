<?php

namespace app\models\ProductTypes;

use app\models\Product;

class DVD extends Product
{
    protected function validate()
    {
        if (!$this->data['value']) {
            return "Please enter a size";
        }

        // Check if size is numeric and non-negative
        if (is_numeric($this->data['value']) && floatval($this->data['value']) >= 0) {
            $this->value = 'Size: ' . $this->data['value'] . ' MBs';
            return "";
        }

        return "Invalid Size";
    }
}
