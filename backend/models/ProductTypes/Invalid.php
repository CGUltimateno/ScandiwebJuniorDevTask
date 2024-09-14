<?php

namespace app\backend\models\ProductTypes;

use app\backend\models\Product;

class Invalid extends Product
{
    protected function validate()
    {
        return "Invalid Product";
    }
}