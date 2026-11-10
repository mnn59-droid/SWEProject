<?php

//loads settings from .env file
require_once __DIR__ . '/../vendor/autoload.php';

$dotenv = Dotenv\Dotenv::createImmutable(dirname(__DIR__));
$dotenv->safeLoad();

function env(string $key, $default = null){
    $value = $_ENV[$key] ?? $_SERVER[$key] ?? getenv($key);
    if($value === false || $value === null|| $value === ''){
        return $default;
    }
    return $value;
}
define('TAX_RATE', (float) env('TAX_RATE', 0.6625));
?>