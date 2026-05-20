<?php
require_once __DIR__ . '/../config/database.php';

class CareerStory {
    private $conn;
    public function __construct() {
        $db = new Database();
        $this->conn = $db->getConnection();
    }

    public function create($data) {
        $stmt = $this->conn->prepare("INSERT INTO career_stories (user_id, title, story, image) VALUES (?, ?, ?, ?)");
        $stmt->execute([$data['user_id'], $data['title'], $data['story'], $data['image'] ?? null]);
        return $this->conn->lastInsertId();
    }

    public function getAllApproved() {
        return $this->conn->query("SELECT cs.*, a.name, a.graduation_year, a.department, a.profile_picture
                                   FROM career_stories cs
                                   LEFT JOIN alumni a ON cs.user_id=a.user_id
                                   WHERE cs.status='approved'
                                   ORDER BY cs.is_featured DESC, cs.created_at DESC")->fetchAll();
    }

    public function getFeatured($limit = 3) {
        $stmt = $this->conn->prepare("SELECT cs.*, a.name, a.graduation_year, a.department, a.profile_picture
                                      FROM career_stories cs
                                      LEFT JOIN alumni a ON cs.user_id=a.user_id
                                      WHERE cs.status='approved' AND cs.is_featured=1
                                      ORDER BY cs.created_at DESC LIMIT ?");
        $stmt->bindValue(1, (int)$limit, PDO::PARAM_INT);
        $stmt->execute();
        return $stmt->fetchAll();
    }

    public function getAll() {
        return $this->conn->query("SELECT cs.*, a.name FROM career_stories cs LEFT JOIN alumni a ON cs.user_id=a.user_id ORDER BY cs.created_at DESC")->fetchAll();
    }

    public function getById($id) {
        $stmt = $this->conn->prepare("SELECT cs.*, a.name, a.graduation_year, a.department, a.profile_picture FROM career_stories cs LEFT JOIN alumni a ON cs.user_id=a.user_id WHERE cs.story_id=?");
        $stmt->execute([$id]);
        return $stmt->fetch();
    }

    public function updateStatus($id, $status, $featured = null) {
        if ($featured !== null) {
            $stmt = $this->conn->prepare("UPDATE career_stories SET status=?, is_featured=? WHERE story_id=?");
            return $stmt->execute([$status, $featured, $id]);
        }
        $stmt = $this->conn->prepare("UPDATE career_stories SET status=? WHERE story_id=?");
        return $stmt->execute([$status, $id]);
    }

    public function delete($id) {
        return $this->conn->prepare("DELETE FROM career_stories WHERE story_id=?")->execute([$id]);
    }
}
