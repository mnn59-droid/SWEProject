<?php

//loads settings from .env file
require_once __DIR__ . '/../vendor/autoload.php';
date_default_timezone_set('America/New_York');
$dotenv = Dotenv\Dotenv::createImmutable(dirname(__DIR__));
$dotenv->safeLoad();

function env(string $key, $default = null){
    $value = $_ENV[$key] ?? $_SERVER[$key] ?? getenv($key);
    if($value === false || $value === null|| $value === ''){
        return $default;
    }
    return $value;
}
define('TAX_RATE', (float) env('TAX_RATE', 0.06625));
define('EMAILJS_SERVICE_ID', env('EMAILJS_SERVICE_ID'));
define('EMAILJS_TEMPLATE_ID', env('EMAILJS_TEMPLATE_ID'));
define('EMAILJS_PUBLIC_KEY', env('EMAILJS_PUBLIC_KEY'));
define('EMAILJS_PRIVATE_KEY', env('EMAILJS_PRIVATE_KEY'));
define('ADMIN_EMAIL', env('ADMIN_EMAIL'));
?>