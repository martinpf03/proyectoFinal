<?php

$publicPath = __DIR__ . '/public';
$uri = urldecode(parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH));

// 🔥 ruta real del archivo
$file = $publicPath . $uri;

// 🔥 si es archivo real → servirlo
if ($uri !== '/' && is_file($file)) {
    return false;
}

// 🔥 si no → Laravel
require_once $publicPath . '/index.php';
