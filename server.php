<?php

/**
 * Laravel - A PHP Framework For Web Artisans
 *
 * @package  Laravel
 * @author   Taylor Otwell <taylor@laravel.com>
 */

$uri = urldecode(
    parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH)
);

// Si le fichier existe dans public/, Laravel le sert tel quel
if ($uri !== '/' && file_exists(__DIR__.'/public'.$uri)) {
    return false;
}

// Sinon, on charge le front controller index.php
require_once __DIR__.'/public/index.php';
