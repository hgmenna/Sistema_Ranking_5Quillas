<?php
// helpers/helpers.php

// Función para obtener la URL base de la aplicación
function base_url($path = '') {
    $config = require 'config/config.php';
    return rtrim($config['app_url'], '/') . '/' . ltrim($path, '/');
}

// Función para redirigir
function redirect($url) {
    header("Location: " . base_url($url));
    exit;
}

// Función para escapar HTML
function e($string) {
    return htmlspecialchars($string, ENT_QUOTES, 'UTF-8');
}

// Función para verificar si el usuario está autenticado
function auth_check() {
    return \Core\Auth::check();
}

// Función para obtener el usuario autenticado
function auth_user() {
    return \Core\Auth::user();
}