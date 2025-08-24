<?php
namespace Modules\Admin\Controllers;

use Core\Controller;
use Modules\Admin\Models\JugadorModel;
use Modules\Admin\Models\ClubModel;
use Modules\Admin\Models\CategoriaModel;
use Core\Auth;

class JugadorController extends Controller {
    public function index() {
        Auth::require('manage_users');
        $jugadorModel = new JugadorModel();
        $jugadores = $jugadorModel->getAllWithDetails();
        $this->view('jugadores/index', ['jugadores' => $jugadores]);
    }

    public function create() {
        Auth::require('manage_users');
        $clubModel = new ClubModel();
        $categoriaModel = new CategoriaModel();
        $clubs = $clubModel->getAll();
        $categorias = $categoriaModel->getAll();
        
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $jugadorModel = new JugadorModel();
            $jugadorModel->create($_POST);
            header('Location: /jugador/index');
            exit;
        }
        $this->view('jugadores/create', [
            'clubs' => $clubs,
            'categorias' => $categorias
        ]);
    }

    public function edit($id) {
        Auth::require('manage_users');
        $jugadorModel = new JugadorModel();
        $clubModel = new ClubModel();
        $categoriaModel = new CategoriaModel();
        $clubs = $clubModel->getAll();
        $categorias = $categoriaModel->getAll();
        
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $jugadorModel->update($id, $_POST);
            header('Location: /jugador/index');
            exit;
        }
        $jugador = $jugadorModel->find($id);
        $this->view('jugadores/edit', [
            'jugador' => $jugador,
            'clubs' => $clubs,
            'categorias' => $categorias
        ]);
    }

    public function delete($id) {
        Auth::require('manage_users');
        $jugadorModel = new JugadorModel();
        $jugadorModel->delete($id);
        header('Location: /jugador/index');
        exit;
    }
}