<?php
namespace Modules\Admin\Controllers;

use Core\Controller;
use Modules\Admin\Models\LocalidadModel;
use Core\Auth;

class LocalidadController extends Controller {
    public function index() {
        Auth::require('manage_users');
        $localidadModel = new LocalidadModel();
        $localidades = $localidadModel->getAll();
        $this->view('localidades/index', ['localidades' => $localidades]);
    }

    public function create() {
        Auth::require('manage_users');
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $localidadModel = new LocalidadModel();
            $localidadModel->create($_POST);
            header('Location: /localidad/index');
            exit;
        }
        $this->view('localidades/create');
    }

    public function edit($id) {
        Auth::require('manage_users');
        $localidadModel = new LocalidadModel();
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $localidadModel->update($id, $_POST);
            header('Location: /localidad/index');
            exit;
        }
        $localidad = $localidadModel->find($id);
        $this->view('localidades/edit', ['localidad' => $localidad]);
    }

    public function delete($id) {
        Auth::require('manage_users');
        $localidadModel = new LocalidadModel();
        $localidadModel->delete($id);
        header('Location: /localidad/index');
        exit;
    }
}