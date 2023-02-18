<?php

namespace app\models\ProductTypes;

use app\models\Product;

class Invalid extends Product
{
    protected function validate()
    {
        return "Invalid Product";
    }
}