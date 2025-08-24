<?php
namespace Modules\Admin\Models;

use Core\Model;
use PDO;

class LocalidadModel extends Model {
    public function getAll() {
        $stmt = $this->db->query("SELECT l.*, p.nombre as provincia_nombre FROM localidades l LEFT JOIN provincias p ON l.id_provincia = p.id_provincia ORDER BY l.nombre");
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function find($id) {
        $stmt = $this->db->prepare("SELECT * FROM localidades WHERE id_localidad = :id");
        $stmt->execute(['id' => $id]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public function create($data) {
        $stmt = $this->db->prepare("INSERT INTO localidades (nombre, codigo_postal, ddn, id_provincia) VALUES (:nombre, :codigo_postal, :ddn, :id_provincia)");
        return $stmt->execute([
            'nombre' => $data['nombre'],
            'codigo_postal' => $data['codigo_postal'],
            'ddn' => $data['ddn'],
            'id_provincia' => $data['id_provincia']
        ]);
    }

    public function update($id, $data) {
        $stmt = $this->db->prepare("UPDATE localidades SET nombre = :nombre, codigo_postal = :codigo_postal, ddn = :ddn, id_provincia = :id_provincia WHERE id_localidad = :id");
        return $stmt->execute([
            'id' => $id,
            'nombre' => $data['nombre'],
            'codigo_postal' => $data['codigo_postal'],
            'ddn' => $data['ddn'],
            'id_provincia' => $data['id_provincia']
        ]);
    }

    public function delete($id) {
        $stmt = $this->db->prepare("DELETE FROM localidades WHERE id_localidad = :id");
        return $stmt->execute(['id' => $id]);
    }
}