<?php
namespace Modules\Admin\Models;

use Core\Model;
use PDO;

class ProvinciaModel extends Model {
    public function getAll() {
        $stmt = $this->db->query("SELECT * FROM provincias ORDER BY nombre");
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function find($id) {
        $stmt = $this->db->prepare("SELECT * FROM provincias WHERE id_provincia = :id");
        $stmt->execute(['id' => $id]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public function create($data) {
        $stmt = $this->db->prepare("INSERT INTO provincias (nombre, id_federacion) VALUES (:nombre, :id_federacion)");
        return $stmt->execute([
            'nombre' => $data['nombre'],
            'id_federacion' => $data['id_federacion']
        ]);
    }

    public function update($id, $data) {
        $stmt = $this->db->prepare("UPDATE provincias SET nombre = :nombre, id_federacion = :id_federacion WHERE id_provincia = :id");
        return $stmt->execute([
            'id' => $id,
            'nombre' => $data['nombre'],
            'id_federacion' => $data['id_federacion']
        ]);
    }

    public function delete($id) {
        $stmt = $this->db->prepare("DELETE FROM provincias WHERE id_provincia = :id");
        return $stmt->execute(['id' => $id]);
    }
}