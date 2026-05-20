<?php
require_once __DIR__ . '/../config/database.php';

class Activity {
    private $conn;
    public function __construct() {
        $db = new Database();
        $this->conn = $db->getConnection();
    }

    public function getRecent($limit = 20) {
        $stmt = $this->conn->prepare("SELECT a.*, al.name, al.profile_picture FROM activities a
                                      LEFT JOIN alumni al ON a.user_id = al.user_id
                                      ORDER BY a.created_at DESC LIMIT ?");
        $stmt->bindValue(1, (int)$limit, PDO::PARAM_INT);
        $stmt->execute();
        return $stmt->fetchAll();
    }

    public function getByUser($userId, $limit = 50) {
        $stmt = $this->conn->prepare("SELECT * FROM activities WHERE user_id=? ORDER BY created_at DESC LIMIT ?");
        $stmt->bindValue(1, $userId, PDO::PARAM_INT);
        $stmt->bindValue(2, (int)$limit, PDO::PARAM_INT);
        $stmt->execute();
        return $stmt->fetchAll();
    }
}
