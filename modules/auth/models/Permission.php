<?php
namespace Modules\Auth\Models;

use Core\Model;
use PDO;

class Permission extends Model {
    public function all() {
        $stmt = $this->db->query("SELECT * FROM permissions");
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function find($id) {
        $stmt = $this->db->prepare("SELECT * FROM permissions WHERE id = :id");
        $stmt->execute(['id' => $id]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }
}