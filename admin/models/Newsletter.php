<?php
require_once __DIR__ . '/../config/database.php';

class Newsletter {
    private $conn;
    public function __construct() {
        $db = new Database();
        $this->conn = $db->getConnection();
    }

    public function subscribe($email, $name = null) {
        $stmt = $this->conn->prepare("INSERT INTO newsletter_subscriptions (email, name) VALUES (?, ?)
                                      ON DUPLICATE KEY UPDATE is_active=1, name=COALESCE(?, name)");
        return $stmt->execute([$email, $name, $name]);
    }

    public function unsubscribe($email) {
        $stmt = $this->conn->prepare("UPDATE newsletter_subscriptions SET is_active=0 WHERE email=?");
        return $stmt->execute([$email]);
    }

    public function getAll() {
        return $this->conn->query("SELECT * FROM newsletter_subscriptions ORDER BY subscribed_at DESC")->fetchAll();
    }

    public function getActiveCount() {
        return $this->conn->query("SELECT COUNT(*) FROM newsletter_subscriptions WHERE is_active=1")->fetchColumn();
    }
}
