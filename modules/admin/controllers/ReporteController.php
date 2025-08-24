<?php
namespace Modules\Admin\Controllers;

use Core\Controller;
use Modules\Admin\Models\ReporteModel;
use Core\Auth;

class ReporteController extends Controller {
    public function index() {
        Auth::require('view_rankings');
        $reporteModel = new ReporteModel();
        $rankingGeneral = $reporteModel->getRankingGeneral();
        $this->view('reportes/index', ['rankingGeneral' => $rankingGeneral]);
    }

    public function ranking() {
        Auth::require('view_rankings');
        $reporteModel = new ReporteModel();
        $categoriaId = $_GET['categoria_id'] ?? null;
        if ($categoriaId) {
            $ranking = $reporteModel->getRankingPorCategoria($categoriaId);
        } else {
            $ranking = $reporteModel->getRankingGeneral();
        }
        $this->view('reportes/ranking', ['ranking' => $ranking]);
    }
}