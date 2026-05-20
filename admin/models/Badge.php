<?php
require_once __DIR__ . '/../config/database.php';

class Badge {
    private $conn;
    public function __construct() {
        $db = new Database();
        $this->conn = $db->getConnection();
    }

    public function getAll() {
        return $this->conn->query("SELECT * FROM badges ORDER BY badge_id ASC")->fetchAll();
    }

    public function getByUser($userId) {
        $stmt = $this->conn->prepare("SELECT b.*, ub.awarded_at FROM user_badges ub
                                      INNER JOIN badges b ON ub.badge_id=b.badge_id
                                      WHERE ub.user_id=? ORDER BY ub.awarded_at DESC");
        $stmt->execute([$userId]);
        return $stmt->fetchAll();
    }

    public function award($userId, $badgeId) {
        $stmt = $this->conn->prepare("INSERT IGNORE INTO user_badges (user_id, badge_id) VALUES (?, ?)");
        return $stmt->execute([$userId, $badgeId]);
    }
}
