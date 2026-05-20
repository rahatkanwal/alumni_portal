<?php
require_once __DIR__ . '/../config/database.php';

class Gallery {
    private $conn;
    public function __construct() {
        $db = new Database();
        $this->conn = $db->getConnection();
    }

    public function add($data) {
        $stmt = $this->conn->prepare("INSERT INTO gallery (event_id, title, image, caption, uploaded_by) VALUES (?, ?, ?, ?, ?)");
        $stmt->execute([
            $data['event_id'] ?? null, $data['title'] ?? null,
            $data['image'], $data['caption'] ?? null, $data['uploaded_by']
        ]);
        return $this->conn->lastInsertId();
    }

    public function delete($id) {
        return $this->conn->prepare("DELETE FROM gallery WHERE photo_id=?")->execute([$id]);
    }

    public function getAll($eventId = null) {
        if ($eventId) {
            $stmt = $this->conn->prepare("SELECT * FROM gallery WHERE event_id=? ORDER BY created_at DESC");
            $stmt->execute([$eventId]);
            return $stmt->fetchAll();
        }
        return $this->conn->query("SELECT g.*, e.title as event_title FROM gallery g LEFT JOIN events e ON g.event_id=e.event_id ORDER BY g.created_at DESC")->fetchAll();
    }
}
