<?php
namespace Modules\Public\Models;

use Core\Model;
use PDO;

class PublicModel extends Model {
    public function getRankingPublico() {
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
            LIMIT 50
        ");
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function getTorneosPublicos() {
        $stmt = $this->db->query("
            SELECT * FROM torneos 
            WHERE fecha_inicio >= CURDATE()
            ORDER BY fecha_inicio ASC
            LIMIT 10
        ");
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function getJugadoresPorCategoria($categoriaId) {
        $stmt = $this->db->prepare("
            SELECT j.*, c.nombre as categoria_nombre, cl.nombre as club_nombre
            FROM jugadores j
            LEFT JOIN categorias c ON j.categoria_id = c.id
            LEFT JOIN clubes cl ON j.club_id = cl.id
            WHERE j.categoria_id = :categoria_id
            ORDER BY j.apellido, j.nombre
        ");
        $stmt->execute(['categoria_id' => $categoriaId]);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
}