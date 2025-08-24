<?php
namespace Modules\Admin\Controllers;

use Core\Controller;
use Modules\Admin\Models\ProvinciaModel;
use Core\Auth;

class ProvinciaController extends Controller {
    public function index() {
        Auth::require('manage_users');
        $provinciaModel = new ProvinciaModel();
        $provincias = $provinciaModel->getAll();
        $this->view('provincias/index', ['provincias' => $provincias]);
    }

    public function create() {
        Auth::require('manage_users');
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $provinciaModel = new ProvinciaModel();
            $provinciaModel->create($_POST);
            header('Location: /provincia/index');
            exit;
        }
        $this->view('provincias/create');
    }

    public function edit($id) {
        Auth::require('manage_users');
        $provinciaModel = new ProvinciaModel();
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $provinciaModel->update($id, $_POST);
            header('Location: /provincia/index');
            exit;
        }
        $provincia = $provinciaModel->find($id);
        $this->view('provincias/edit', ['provincia' => $provincia]);
    }

    public function delete($id) {
        Auth::require('manage_users');
        $provinciaModel = new ProvinciaModel();
        $provinciaModel->delete($id);
        header('Location: /provincia/index');
        exit;
    }
}