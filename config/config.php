<?php
// Cargar variables de entorno
$env = parse_ini_file(__DIR__ . '/../.env');

return [
    // Información general de la aplicación
    'app_name' => $env['APP_NAME'] ?? 'Aplicación',
    'app_url' => rtrim($env['APP_URL'] ?? 'http://localhost', '/'),
    'base_path' => $env['BASE_PATH'] ?? '', // Ejemplo: '/miapp' si no está en raíz

    // Configuración de depuración
    'debug' => filter_var($env['DEBUG'] ?? true, FILTER_VALIDATE_BOOLEAN),

    // Configuración de base de datos
    'db_host' => $env['DB_HOST'] ?? 'localhost',
    'db_name' => $env['DB_NAME'] ?? 'database',
    'db_user' => $env['DB_USER'] ?? 'root',
    'db_pass' => $env['DB_PASS'] ?? '',

    // Configuración de rutas y URLs
    'routes' => [
        'login' => '/auth/login',
        'logout' => '/auth/logout',
        'dashboard' => '/admin/dashboard',
        // Agrega aquí otras rutas comunes que uses en el sistema
    ],

    // Configuración de permisos (puedes definir permisos globales aquí)
    'permissions' => [
        'manage_users' => 'manage_users',
        'manage_tournaments' => 'manage_tournaments',
        'view_rankings' => 'view_rankings',
        // Agrega más permisos según necesidad
    ],

    // Otros parámetros configurables
    'items_per_page' => 20,
];