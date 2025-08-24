<?php
namespace Modules\Admin\Controllers;

use Core\Controller;
use Modules\Admin\Models\FederacionModel;
use Core\Auth;

class FederacionController extends Controller {
    public function index() {
        Auth::require('manage_users');
        $federacionModel = new FederacionModel();
        $federaciones = $federacionModel->getAll();
        $this->view('federaciones/index', ['federaciones' => $federaciones]);
    }

    public function create() {
        Auth::require('manage_users');
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $federacionModel = new FederacionModel();
            $federacionModel->create($_POST);
            header('Location: /federacion/index');
            exit;
        }
        $this->view('federaciones/create');
    }

    public function edit($id) {
        Auth::require('manage_users');
        $federacionModel = new FederacionModel();
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $federacionModel->update($id, $_POST);
            header('Location: /federacion/index');
            exit;
        }
        $federacion = $federacionModel->find($id);
        $this->view('federaciones/edit', ['federacion' => $federacion]);
    }

    public function delete($id) {
        Auth::require('manage_users');
        $federacionModel = new FederacionModel();
        $federacionModel->delete($id);
        header('Location: /federacion/index');
        exit;
    }
}