<?php

declare(strict_types=1);

require_once __DIR__ . '/config.php';

$connection = new mysqli(DB_HOST, DB_USER, DB_PASS, DB_NAME);

if ($connection->connect_error) {
    die('Database connection failed.');
}

$connection->set_charset('utf8mb4');