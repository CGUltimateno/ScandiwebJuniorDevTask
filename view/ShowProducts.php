<?php

namespace app\view;

class ShowProducts
{
    public static function show($show, $params = [])
    {
        foreach ($params as $key => $value) {
            $$key = $value;
        }
        ob_start();
        include __DIR__ . "/productview/$show.php";
        $content = ob_get_clean();
        include __DIR__ . "/productview/main.php";
    }
}
