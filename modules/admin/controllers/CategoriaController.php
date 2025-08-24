<?php
namespace Modules\Admin\Controllers;

use Core\Controller;
use Modules\Admin\Models\CategoriaModel;
use Core\Auth;

class CategoriaController extends Controller {
    public function index() {
        Auth::require('manage_users');
        $categoriaModel = new CategoriaModel();
        $categorias = $categoriaModel->getAll();
        $this->view('categorias/index', ['categorias' => $categorias]);
    }

    public function create() {
        Auth::require('manage_users');
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $categoriaModel = new CategoriaModel();
            $categoriaModel->create($_POST);
            header('Location: /categoria/index');
            exit;
        }
        $this->view('categorias/create');
    }

    public function edit($id) {
        Auth::require('manage_users');
        $categoriaModel = new CategoriaModel();
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $categoriaModel->update($id, $_POST);
            header('Location: /categoria/index');
            exit;
        }
        $categoria = $categoriaModel->find($id);
        $this->view('categorias/edit', ['categoria' => $categoria]);
    }

    public function delete($id) {
        Auth::require('manage_users');
        $categoriaModel = new CategoriaModel();
        $categoriaModel->delete($id);
        header('Location: /categoria/index');
        exit;
    }
}