<?php

namespace app\models\ProductTypes;

use app\models\Product;

class Furniture extends Product
{
    protected function validate()
    {
        if (!isset($this->data['value']) || empty($this->data['value'])) {
            return "Please enter the dimensions in the format height x width x length";
        }

        $dimensions = explode('x', $this->data['value']);

        if (count($dimensions) !== 3) {
            return "Please enter the dimensions in the format height x width x length";
        }

        list($height, $width, $length) = $dimensions;

        if (!is_numeric($height) || floatval($height) < 0) {
            return "Invalid height: must be a non-negative number";
        }
        if (!is_numeric($width) || floatval($width) < 0) {
            return "Invalid width: must be a non-negative number";
        }
        if (!is_numeric($length) || floatval($length) < 0) {
            return "Invalid length: must be a non-negative number";
        }

        $this->value = $height . 'x' . $width . 'x' . $length . ' cm';
        return "";
    }
}
