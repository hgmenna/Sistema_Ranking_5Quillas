<?php
namespace Modules\Admin\Models;

use Core\Model;
use PDO;

class CategoriaModel extends Model {
    public function getAll() {
        $stmt = $this->db->query("SELECT * FROM categorias ORDER BY nombre");
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function find($id) {
        $stmt = $this->db->prepare("SELECT * FROM categorias WHERE id = :id");
        $stmt->execute(['id' => $id]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public function create($data) {
        $stmt = $this->db->prepare("INSERT INTO categorias (nombre, descripcion) VALUES (:nombre, :descripcion)");
        return $stmt->execute([
            'nombre' => $data['nombre'],
            'descripcion' => $data['descripcion']
        ]);
    }

    public function update($id, $data) {
        $stmt = $this->db->prepare("UPDATE categorias SET nombre = :nombre, descripcion = :descripcion WHERE id = :id");
        return $stmt->execute([
            'id' => $id,
            'nombre' => $data['nombre'],
            'descripcion' => $data['descripcion']
        ]);
    }

    public function delete($id) {
        $stmt = $this->db->prepare("DELETE FROM categorias WHERE id = :id");
        return $stmt->execute(['id' => $id]);
    }
}