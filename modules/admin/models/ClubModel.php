<?php
namespace Modules\Admin\Models;

use Core\Model;
use PDO;

class ClubModel extends Model {
    public function getAll() {
        $stmt = $this->db->query("SELECT * FROM clubes ORDER BY nombre");
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function getAllWithLocation() {
        $stmt = $this->db->query("
            SELECT c.*, l.nombre as localidad_nombre, p.nombre as provincia_nombre
            FROM clubes c
            LEFT JOIN localidades l ON c.id_localidad = l.id_localidad
            LEFT JOIN provincias p ON l.id_provincia = p.id_provincia
            ORDER BY c.nombre
        ");
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function find($id) {
        $stmt = $this->db->prepare("SELECT * FROM clubes WHERE id_club = :id");
        $stmt->execute(['id' => $id]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public function create($data) {
        $stmt = $this->db->prepare("INSERT INTO clubes (nombre, calle, numero, id_localidad, logo, email, telefono, cantidad_mesas) VALUES (:nombre, :calle, :numero, :id_localidad, :logo, :email, :telefono, :cantidad_mesas)");
        return $stmt->execute([
            'nombre' => $data['nombre'],
            'calle' => $data['calle'],
            'numero' => $data['numero'],
            'id_localidad' => $data['id_localidad'],
            'logo' => $data['logo'],
            'email' => $data['email'],
            'telefono' => $data['telefono'],
            'cantidad_mesas' => $data['cantidad_mesas']
        ]);
    }

    public function update($id, $data) {
        $stmt = $this->db->prepare("UPDATE clubes SET nombre = :nombre, calle = :calle, numero = :numero, id_localidad = :id_localidad, logo = :logo, email = :email, telefono = :telefono, cantidad_mesas = :cantidad_mesas WHERE id_club = :id");
        return $stmt->execute([
            'id' => $id,
            'nombre' => $data['nombre'],
            'calle' => $data['calle'],
            'numero' => $data['numero'],
            'id_localidad' => $data['id_localidad'],
            'logo' => $data['logo'],
            'email' => $data['email'],
            'telefono' => $data['telefono'],
            'cantidad_mesas' => $data['cantidad_mesas']
        ]);
    }

    public function delete($id) {
        $stmt = $this->db->prepare("DELETE FROM clubes WHERE id_club = :id");
        return $stmt->execute(['id' => $id]);
    }
}