<?php
namespace Modules\Public\Controllers;

use Core\Controller;
use Modules\Public\Models\PublicModel;

class PublicController extends Controller {
    public function index() {
        $publicModel = new PublicModel();
        $ranking = $publicModel->getRankingPublico();
        $torneos = $publicModel->getTorneosPublicos();
        $this->view('ranking', ['ranking' => $ranking, 'torneos' => $torneos]);
    }

    public function torneos() {
        $publicModel = new PublicModel();
        $torneos = $publicModel->getTorneosPublicos();
        $this->view('torneos', ['torneos' => $torneos]);
    }

    public function jugadores() {
        $categoriaId = $_GET['categoria_id'] ?? null;
        $publicModel = new PublicModel();
        if ($categoriaId) {
            $jugadores = $publicModel->getJugadoresPorCategoria($categoriaId);
        } else {
            $jugadores = [];
        }
        $this->view('jugadores', ['jugadores' => $jugadores]);
    }
}