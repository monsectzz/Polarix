<?php
declare(strict_types=1);
function db(): PDO {
    static $connection;
    if ($connection instanceof PDO) return $connection;
    $dsn = getenv('POLARIX_DSN') ?: 'mysql:host=127.0.0.1;port=3307;dbname=polarix;charset=utf8mb4';
    $connection = new PDO($dsn, getenv('POLARIX_DB_USER') ?: 'root', getenv('POLARIX_DB_PASSWORD') ?: '', [PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION, PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC, PDO::ATTR_EMULATE_PREPARES => false]);
    return $connection;
}
