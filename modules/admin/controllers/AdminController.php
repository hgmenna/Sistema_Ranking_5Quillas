<?php
namespace Modules\Admin\Controllers;

use Core\Controller;
use Core\Auth;

class AdminController extends Controller {
    public function dashboard() {
        if (!Auth::check()) {
            header('Location: /auth/login');
            exit;
        }
        $user = Auth::user();
        $this->view('admin/dashboard', ['user' => $user]);
    }
}