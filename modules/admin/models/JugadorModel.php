<?php
namespace Modules\Admin\Models;

use Core\Model;
use PDO;

class JugadorModel extends Model {
    public function getAll() {
        $stmt = $this->db->query("SELECT * FROM jugadores ORDER BY apellido_nombre");
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function getAllWithDetails() {
        $stmt = $this->db->query("
            SELECT j.*, c.nombre as club_nombre, cat.nombre as categoria_nombre, loc.nombre as localidad_nombre
            FROM jugadores j
            LEFT JOIN clubes c ON j.id_club = c.id_club
            LEFT JOIN categorias cat ON j.id_categoria_afiliacion = cat.id_categoria
            LEFT JOIN localidades loc ON c.id_localidad = loc.id_localidad
            ORDER BY j.apellido_nombre
        ");
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function find($id) {
        $stmt = $this->db->prepare("SELECT * FROM jugadores WHERE id_jugador = :id");
        $stmt->execute(['id' => $id]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public function create($data) {
        $stmt = $this->db->prepare("INSERT INTO jugadores (dni, apellido_nombre, id_club, imagen, id_categoria_afiliacion, id_categoria_temporal, email, telefono, ranking_anterior, id_categoria_ranking_actual) VALUES (:dni, :apellido_nombre, :id_club, :imagen, :id_categoria_afiliacion, :id_categoria_temporal, :email, :telefono, :ranking_anterior, :id_categoria_ranking_actual)");
        return $stmt->execute([
            'dni' => $data['dni'],
            'apellido_nombre' => $data['apellido_nombre'],
            'id_club' => $data['id_club'],
            'imagen' => $data['imagen'],
            'id_categoria_afiliacion' => $data['id_categoria_afiliacion'],
            'id_categoria_temporal' => $data['id_categoria_temporal'],
            'email' => $data['email'],
            'telefono' => $data['telefono'],
            'ranking_anterior' => $data['ranking_anterior'],
            'id_categoria_ranking_actual' => $data['id_categoria_ranking_actual']
        ]);
    }

    public function update($id, $data) {
        $stmt = $this->db->prepare("UPDATE jugadores SET dni = :dni, apellido_nombre = :apellido_nombre, id_club = :id_club, imagen = :imagen, id_categoria_afiliacion = :id_categoria_afiliacion, id_categoria_temporal = :id_categoria_temporal, email = :email, telefono = :telefono, ranking_anterior = :ranking_anterior, id_categoria_ranking_actual = :id_categoria_ranking_actual WHERE id_jugador = :id");
        return $stmt->execute([
            'id' => $id,
            'dni' => $data['dni'],
            'apellido_nombre' => $data['apellido_nombre'],
            'id_club' => $data['id_club'],
            'imagen' => $data['imagen'],
            'id_categoria_afiliacion' => $data['id_categoria_afiliacion'],
            'id_categoria_temporal' => $data['id_categoria_temporal'],
            'email' => $data['email'],
            'telefono' => $data['telefono'],
            'ranking_anterior' => $data['ranking_anterior'],
            'id_categoria_ranking_actual' => $data['id_categoria_ranking_actual']
        ]);
    }

    public function delete($id) {
        $stmt = $this->db->prepare("DELETE FROM jugadores WHERE id_jugador = :id");
        return $stmt->execute(['id' => $id]);
    }
}