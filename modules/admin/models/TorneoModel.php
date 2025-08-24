<?php
namespace Modules\Admin\Models;

use Core\Model;
use PDO;

class TorneoModel extends Model {
    public function getAll() {
        $stmt = $this->db->query("SELECT * FROM torneos ORDER BY fecha_inicio DESC");
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function find($id) {
        $stmt = $this->db->prepare("SELECT * FROM torneos WHERE id = :id");
        $stmt->execute(['id' => $id]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public function create($data) {
        $stmt = $this->db->prepare("INSERT INTO torneos (nombre, fecha_inicio, fecha_fin, lugar) VALUES (:nombre, :fecha_inicio, :fecha_fin, :lugar)");
        return $stmt->execute([
            'nombre' => $data['nombre'],
            'fecha_inicio' => $data['fecha_inicio'],
            'fecha_fin' => $data['fecha_fin'],
            'lugar' => $data['lugar']
        ]);
    }

    public function update($id, $data) {
        $stmt = $this->db->prepare("UPDATE torneos SET nombre = :nombre, fecha_inicio = :fecha_inicio, fecha_fin = :fecha_fin, lugar = :lugar WHERE id = :id");
        return $stmt->execute([
            'id' => $id,
            'nombre' => $data['nombre'],
            'fecha_inicio' => $data['fecha_inicio'],
            'fecha_fin' => $data['fecha_fin'],
            'lugar' => $data['lugar']
        ]);
    }

    public function delete($id) {
        $stmt = $this->db->prepare("DELETE FROM torneos WHERE id = :id");
        return $stmt->execute(['id' => $id]);
    }
}