<?php
require_once __DIR__ . '/../config/database.php';

class Announcement {
    private $conn;
    public function __construct() {
        $db = new Database();
        $this->conn = $db->getConnection();
    }

    public function create($data) {
        $stmt = $this->conn->prepare("INSERT INTO announcements (title, body, image, created_by) VALUES (?, ?, ?, ?)");
        $stmt->execute([$data['title'], $data['body'], $data['image'] ?? null, $data['created_by']]);
        return $this->conn->lastInsertId();
    }

    public function update($id, $data) {
        $sql = "UPDATE announcements SET title=?, body=?";
        $params = [$data['title'], $data['body']];
        if (!empty($data['image'])) {
            $sql .= ", image=?";
            $params[] = $data['image'];
        }
        $sql .= " WHERE announcement_id=?";
        $params[] = $id;
        $stmt = $this->conn->prepare($sql);
        return $stmt->execute($params);
    }

    public function delete($id) {
        $stmt = $this->conn->prepare("DELETE FROM announcements WHERE announcement_id=?");
        return $stmt->execute([$id]);
    }

    public function getById($id) {
        $stmt = $this->conn->prepare("SELECT a.*, u.email as author_email FROM announcements a LEFT JOIN users u ON a.created_by=u.user_id WHERE a.announcement_id=?");
        $stmt->execute([$id]);
        return $stmt->fetch();
    }

    public function getAll() {
        return $this->conn->query("SELECT a.*, u.email as author_email FROM announcements a LEFT JOIN users u ON a.created_by=u.user_id ORDER BY a.created_at DESC")->fetchAll();
    }

    public function getRecent($limit = 5) {
        $stmt = $this->conn->prepare("SELECT * FROM announcements ORDER BY created_at DESC LIMIT ?");
        $stmt->bindValue(1, (int)$limit, PDO::PARAM_INT);
        $stmt->execute();
        return $stmt->fetchAll();
    }
}
