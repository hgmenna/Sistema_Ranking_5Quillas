<?php
namespace Modules\Admin\Controllers;

use Core\Controller;
use Modules\Admin\Models\ClubModel;
use Modules\Admin\Models\LocalidadModel;
use Core\Auth;

class ClubController extends Controller {
    public function index() {
        Auth::require('manage_users');
        $clubModel = new ClubModel();
        $clubs = $clubModel->getAllWithLocation();
        $this->view('clubes/index', ['clubs' => $clubs]);
    }

    public function create() {
        Auth::require('manage_users');
        $localidadModel = new LocalidadModel();
        $localidades = $localidadModel->getAll();
        
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $clubModel = new ClubModel();
            $clubModel->create($_POST);
            header('Location: /club/index');
            exit;
        }
        $this->view('clubes/create', ['localidades' => $localidades]);
    }

    public function edit($id) {
        Auth::require('manage_users');
        $clubModel = new ClubModel();
        $localidadModel = new LocalidadModel();
        $localidades = $localidadModel->getAll();
        
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $clubModel->update($id, $_POST);
            header('Location: /club/index');
            exit;
        }
        $club = $clubModel->find($id);
        $this->view('clubes/edit', ['club' => $club, 'localidades' => $localidades]);
    }

    public function delete($id) {
        Auth::require('manage_users');
        $clubModel = new ClubModel();
        $clubModel->delete($id);
        header('Location: /club/index');
        exit;
    }
}