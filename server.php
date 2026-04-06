<?php

$publicPath = __DIR__ . '/public';

$uri = urldecode(
    parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH) ?? ''
);

// 🔥 SERVIR ARCHIVOS ESTÁTICOS (VITE)
if ($uri !== '/' && file_exists($publicPath . $uri)) {
    return false;
}

// 🔥 SI NO → LARAVEL
require_once $publicPath . '/index.php';
