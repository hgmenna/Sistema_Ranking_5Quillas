<?php
namespace Modules\Admin\Models;

use Core\Model;
use PDO;

class InscripcionModel extends Model {
    public function getAll() {
        $stmt = $this->db->query("
            SELECT i.*, j.nombre as jugador_nombre, j.apellido as jugador_apellido, t.nombre as torneo_nombre
            FROM inscripciones i
            JOIN jugadores j ON i.jugador_id = j.id
            JOIN torneos t ON i.torneo_id = t.id
            ORDER BY i.fecha_inscripcion DESC
        ");
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function find($id) {
        $stmt = $this->db->prepare("
            SELECT i.*, j.nombre as jugador_nombre, j.apellido as jugador_apellido, t.nombre as torneo_nombre
            FROM inscripciones i
            JOIN jugadores j ON i.jugador_id = j.id
            JOIN torneos t ON i.torneo_id = t.id
            WHERE i.id = :id
        ");
        $stmt->execute(['id' => $id]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public function create($data) {
        $stmt = $this->db->prepare("INSERT INTO inscripciones (jugador_id, torneo_id, fecha_inscripcion) VALUES (:jugador_id, :torneo_id, :fecha_inscripcion)");
        return $stmt->execute([
            'jugador_id' => $data['jugador_id'],
            'torneo_id' => $data['torneo_id'],
            'fecha_inscripcion' => $data['fecha_inscripcion']
        ]);
    }

    public function update($id, $data) {
        $stmt = $this->db->prepare("UPDATE inscripciones SET jugador_id = :jugador_id, torneo_id = :torneo_id, fecha_inscripcion = :fecha_inscripcion WHERE id = :id");
        return $stmt->execute([
            'id' => $id,
            'jugador_id' => $data['jugador_id'],
            'torneo_id' => $data['torneo_id'],
            'fecha_inscripcion' => $data['fecha_inscripcion']
        ]);
    }

    public function delete($id) {
        $stmt = $this->db->prepare("DELETE FROM inscripciones WHERE id = :id");
        return $stmt->execute(['id' => $id]);
    }
}