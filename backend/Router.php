<?php

if (php_sapi_name() == 'cli-server') {
    $filePath = __DIR__ . parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);
    if (is_file($filePath)) {
        return false;
    }
}
require_once __DIR__ . '/index.php';
