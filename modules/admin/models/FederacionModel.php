<?php
namespace Modules\Admin\Models;

use Core\Model;
use PDO;

class FederacionModel extends Model {
    public function getAll() {
        $stmt = $this->db->query("SELECT * FROM federaciones ORDER BY nombre");
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function find($id) {
        $stmt = $this->db->prepare("SELECT * FROM federaciones WHERE id_federacion = :id");
        $stmt->execute(['id' => $id]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public function create($data) {
        $stmt = $this->db->prepare("INSERT INTO federaciones (nombre, sigla, facebook, instagram, email, telefono, logo) VALUES (:nombre, :sigla, :facebook, :instagram, :email, :telefono, :logo)");
        return $stmt->execute([
            'nombre' => $data['nombre'],
            'sigla' => $data['sigla'],
            'facebook' => $data['facebook'],
            'instagram' => $data['instagram'],
            'email' => $data['email'],
            'telefono' => $data['telefono'],
            'logo' => $data['logo']
        ]);
    }

    public function update($id, $data) {
        $stmt = $this->db->prepare("UPDATE federaciones SET nombre = :nombre, sigla = :sigla, facebook = :facebook, instagram = :instagram, email = :email, telefono = :telefono, logo = :logo WHERE id_federacion = :id");
        return $stmt->execute([
            'id' => $id,
            'nombre' => $data['nombre'],
            'sigla' => $data['sigla'],
            'facebook' => $data['facebook'],
            'instagram' => $data['instagram'],
            'email' => $data['email'],
            'telefono' => $data['telefono'],
            'logo' => $data['logo']
        ]);
    }

    public function delete($id) {
        $stmt = $this->db->prepare("DELETE FROM federaciones WHERE id_federacion = :id");
        return $stmt->execute(['id' => $id]);
    }
}