<?php
namespace Modules\Admin\Controllers;

use Core\Controller;
use Modules\Admin\Models\InscripcionModel;
use Core\Auth;

class InscripcionController extends Controller {
    public function index() {
        Auth::require('manage_tournaments');
        $inscripcionModel = new InscripcionModel();
        $inscripciones = $inscripcionModel->getAll();
        $this->view('inscripciones/index', ['inscripciones' => $inscripciones]);
    }

    public function create() {
        Auth::require('manage_tournaments');
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $inscripcionModel = new InscripcionModel();
            $inscripcionModel->create($_POST);
            header('Location: /inscripcion/index');
            exit;
        }
        $this->view('inscripciones/create');
    }

    public function edit($id) {
        Auth::require('manage_tournaments');
        $inscripcionModel = new InscripcionModel();
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $inscripcionModel->update($id, $_POST);
            header('Location: /inscripcion/index');
            exit;
        }
        $inscripcion = $inscripcionModel->find($id);
        $this->view('inscripciones/edit', ['inscripcion' => $inscripcion]);
    }

    public function delete($id) {
        Auth::require('manage_tournaments');
        $inscripcionModel = new InscripcionModel();
        $inscripcionModel->delete($id);
        header('Location: /inscripcion/index');
        exit;
    }
}