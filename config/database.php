<?php
// config/database.php

// Cargar variables de entorno
$env = parse_ini_file(__DIR__ . '/../.env');

return [
    'host' => $env['DB_HOST'] ?? 'localhost',
    'dbname' => $env['DB_NAME'] ?? 'database',
    'user' => $env['DB_USER'] ?? 'root',
    'password' => $env['DB_PASS'] ?? '',
    'charset' => 'utf8mb4',
];