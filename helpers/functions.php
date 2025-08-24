<?php
// helpers/functions.php

// Función para formatear fechas
function format_date($date, $format = 'd/m/Y') {
    $datetime = new DateTime($date);
    return $datetime->format($format);
}

// Función para generar un slug
function slugify($text) {
    // Reemplazar caracteres especiales
    $text = preg_replace('~[^\pL\d]+~u', '-', $text);
    
    // Convertir a minúsculas
    $text = strtolower($text);
    
    // Eliminar caracteres no deseados
    $text = preg_replace('~[^-\w]+~', '', $text);
    
    // Eliminar guiones dobles
    $text = preg_replace('~-+~', '-', $text);
    
    // Eliminar guiones al inicio y al final
    $text = trim($text, '-');
    
    return $text;
}

// Función para validar email
function validate_email($email) {
    return filter_var($email, FILTER_VALIDATE_EMAIL);
}

// Función para validar teléfono
function validate_phone($phone) {
    return preg_match('/^[0-9\-\+\s\(\)]+$/', $phone);
}

// Función para generar un token CSRF
function generate_csrf_token() {
    if (empty($_SESSION['csrf_token'])) {
        $_SESSION['csrf_token'] = bin2hex(random_bytes(32));
    }
    return $_SESSION['csrf_token'];
}

// Función para verificar token CSRF
function verify_csrf_token($token) {
    return isset($_SESSION['csrf_token']) && hash_equals($_SESSION['csrf_token'], $token);
}