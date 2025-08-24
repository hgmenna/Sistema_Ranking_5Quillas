<?php
namespace Modules\Auth\Controllers;

use Core\Controller;
use Modules\Auth\Models\User;
use Core\Auth;

class AuthController extends Controller {
    public function login() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $userModel = new User();
            $user = $userModel->findByUsername($_POST['username']);
            if ($user && password_verify($_POST['password'], $user['password_hash'])) {
                Auth::login($user);
                header('Location: /admin/dashboard');
                exit;
            } else {
                $error = "Usuario o contraseña incorrectos";
                $this->view('auth/login', ['error' => $error]);
                return;
            }
        }
        $this->view('auth/login');
    }

    public function logout() {
        Auth::logout();
        header('Location: /');
        exit;
    }
}