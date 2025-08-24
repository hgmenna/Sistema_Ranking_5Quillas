<?php
namespace Modules\Auth\Models;

use Core\Model;
use PDO;

class User extends Model {
    public function findByUsername($username) {
        $stmt = $this->db->prepare("SELECT * FROM users WHERE username = :username LIMIT 1");
        $stmt->execute(['username' => $username]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public function create($data) {
        $stmt = $this->db->prepare("INSERT INTO users (username, password_hash, email) VALUES (:username, :password_hash, :email)");
        return $stmt->execute([
            'username' => $data['username'],
            'password_hash' => password_hash($data['password'], PASSWORD_DEFAULT),
            'email' => $data['email']
        ]);
    }

    public function getRoles($userId) {
        $stmt = $this->db->prepare("
            SELECT r.* FROM roles r
            JOIN role_user ru ON r.id = ru.role_id
            WHERE ru.user_id = :user_id
        ");
        $stmt->execute(['user_id' => $userId]);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function getPermissions($userId) {
        $stmt = $this->db->prepare("
            SELECT p.* FROM permissions p
            JOIN permission_role pr ON p.id = pr.permission_id
            JOIN role_user ru ON pr.role_id = ru.role_id
            WHERE ru.user_id = :user_id
        ");
        $stmt->execute(['user_id' => $userId]);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
}