<?php

require_once __DIR__ . '/config.php';

function db(): PDO
{
    static $pdo = null;

    if($pdo === null){
        $dns  = sprintf(
            'pgsql:host=%s;port=%s;dbname=%s;sslmode=%s',
            env('DB_HOST', 'localhost'),
            env('DB_PORT', 5432),
            env('DB_NAME', 'ecommerce'),
            env('DB_SSLMODE', 'prefer')
        );
        $pdo = new PDO($dns, env('DB_USER', 'postgres'), env('DB_PASSWORD', ''),
            [
                PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
                PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
                PDO::ATTR_EMULATE_PREPARES => false,
            ]
        );
    }
    return $pdo;
}

?>