<?php
namespace Core;

class Auth {
    public static function check() {
        return isset($_SESSION['user']);
    }

    public static function user() {
        return $_SESSION['user'] ?? null;
    }

    public static function login($user) {
        // $user debe incluir un array 'permissions' con los permisos del usuario
        $_SESSION['user'] = $user;
    }

    public static function logout() {
        unset($_SESSION['user']);
    }

    public static function require($permission) {
        if (!self::check()) {
            header('Location: /auth/login');
            exit;
        }
        $user = self::user();
        if (!in_array($permission, $user['permissions'] ?? [])) {
            http_response_code(403);
            echo "Acceso denegado: permiso '$permission' requerido.";
            exit;
        }
    }
}