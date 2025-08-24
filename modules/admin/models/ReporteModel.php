<?php
namespace Modules\Admin\Models;

use Core\Model;
use PDO;

class ReporteModel extends Model {
    public function getRankingGeneral() {
        $stmt = $this->db->query("
            SELECT j.*, c.nombre as categoria_nombre, cl.nombre as club_nombre,
                   COUNT(i.id) as torneos_jugados,
                   SUM(CASE WHEN p.posicion = 1 THEN 1 ELSE 0 END) as torneos_ganados
            FROM jugadores j
            LEFT JOIN categorias c ON j.categoria_id = c.id
            LEFT JOIN clubes cl ON j.club_id = cl.id
            LEFT JOIN inscripciones i ON j.id = i.jugador_id
            LEFT JOIN participaciones p ON i.id = p.inscripcion_id
            GROUP BY j.id
            ORDER BY torneos_ganados DESC, torneos_jugados DESC
        ");
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function getRankingPorCategoria($categoriaId) {
        $stmt = $this->db->prepare("
            SELECT j.*, c.nombre as categoria_nombre, cl.nombre as club_nombre,
                   COUNT(i.id) as torneos_jugados,
                   SUM(CASE WHEN p.posicion = 1 THEN 1 ELSE 0 END) as torneos_ganados
            FROM jugadores j
            LEFT JOIN categorias c ON j.categoria_id = c.id
            LEFT JOIN clubes cl ON j.club_id = cl.id
            LEFT JOIN inscripciones i ON j.id = i.jugador_id
            LEFT JOIN participaciones p ON i.id = p.inscripcion_id
            WHERE j.categoria_id = :categoria_id
            GROUP BY j.id
            ORDER BY torneos_ganados DESC, torneos_jugados DESC
        ");
        $stmt->execute(['categoria_id' => $categoriaId]);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function getEstadisticasTorneo($torneoId) {
        $stmt = $this->db->prepare("
            SELECT t.nombre as torneo_nombre,
                   COUNT(i.id) as total_inscripciones,
                   COUNT(DISTINCT i.jugador_id) as jugadores_unicos
            FROM torneos t
            LEFT JOIN inscripciones i ON t.id = i.torneo_id
            WHERE t.id = :torneo_id
            GROUP BY t.id
        ");
        $stmt->execute(['torneo_id' => $torneoId]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }
}