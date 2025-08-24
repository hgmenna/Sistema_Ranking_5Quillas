<?php
namespace Modules\Admin\Controllers;

use Core\Controller;
use Modules\Admin\Models\TorneoModel;
use Core\Auth;

class TorneoController extends Controller {
    public function index() {
        Auth::require('manage_tournaments');
        $torneoModel = new TorneoModel();
        $torneos = $torneoModel->getAll();
        $this->view('torneos/index', ['torneos' => $torneos]);
    }

    public function create() {
        Auth::require('manage_tournaments');
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $torneoModel = new TorneoModel();
            $torneoModel->create($_POST);
            header('Location: /torneo/index');
            exit;
        }
        $this->view('torneos/create');
    }

    public function edit($id) {
        Auth::require('manage_tournaments');
        $torneoModel = new TorneoModel();
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $torneoModel->update($id, $_POST);
            header('Location: /torneo/index');
            exit;
        }
        $torneo = $torneoModel->find($id);
        $this->view('torneos/edit', ['torneo' => $torneo]);
    }

    public function delete($id) {
        Auth::require('manage_tournaments');
        $torneoModel = new TorneoModel();
        $torneoModel->delete($id);
        header('Location: /torneo/index');
        exit;
    }
}