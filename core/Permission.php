<?php
// core/Permission.php
namespace Core;

class Permission {
    public static function has($permission) {
        session_start();
        if (!isset($_SESSION['permissions'])) {
            return false;
        }
        return in_array($permission, $_SESSION['permissions']);
    }

    public static function require($permission) {
        if (!self::has($permission)) {
            // Redirigir al login o mostrar error
            header('Location: /auth/login');
            exit;
        }
    }
}