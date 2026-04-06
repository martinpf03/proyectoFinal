<?php

$uri = urldecode(
    parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH) ?? ''
);

// Si el archivo existe → servirlo directamente
if ($uri !== '/' && file_exists(__DIR__.'/public'.$uri)) {
    return false;
}

// Si no → Laravel
require_once __DIR__.'/public/index.php';
