<?php
require_once __DIR__ . '/../config/database.php';

class Event {
    private $conn;

    public function __construct() {
        $db = new Database();
        $this->conn = $db->getConnection();
    }

    public function create($data) {
        $sql = "INSERT INTO events (title, description, event_date, location, image, category, created_by, latitude, longitude)
                VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?)";
        $stmt = $this->conn->prepare($sql);
        $stmt->execute([
            $data['title'], $data['description'], $data['event_date'],
            $data['location'] ?? null, $data['image'] ?? null, $data['category'] ?? 'general',
            $data['created_by'], $data['latitude'] ?? null, $data['longitude'] ?? null
        ]);
        return $this->conn->lastInsertId();
    }

    public function update($id, $data) {
        $sql = "UPDATE events SET title=?, description=?, event_date=?, location=?, category=?, latitude=?, longitude=?";
        $params = [$data['title'], $data['description'], $data['event_date'], $data['location'] ?? null,
                   $data['category'] ?? 'general', $data['latitude'] ?? null, $data['longitude'] ?? null];
        if (!empty($data['image'])) {
            $sql .= ", image=?";
            $params[] = $data['image'];
        }
        $sql .= " WHERE event_id=?";
        $params[] = $id;
        $stmt = $this->conn->prepare($sql);
        return $stmt->execute($params);
    }

    public function delete($id) {
        $stmt = $this->conn->prepare("DELETE FROM events WHERE event_id=?");
        return $stmt->execute([$id]);
    }

    public function getById($id) {
        $stmt = $this->conn->prepare("SELECT * FROM events WHERE event_id=?");
        $stmt->execute([$id]);
        return $stmt->fetch();
    }

    public function getAll($onlyUpcoming = false) {
        $sql = "SELECT * FROM events";
        if ($onlyUpcoming) $sql .= " WHERE event_date >= NOW()";
        $sql .= " ORDER BY event_date DESC";
        return $this->conn->query($sql)->fetchAll();
    }

    public function getUpcoming($limit = 5) {
        $stmt = $this->conn->prepare("SELECT * FROM events WHERE event_date >= NOW() ORDER BY event_date ASC LIMIT ?");
        $stmt->bindValue(1, (int)$limit, PDO::PARAM_INT);
        $stmt->execute();
        return $stmt->fetchAll();
    }

    public function rsvp($eventId, $userId, $status = 'going') {
        $stmt = $this->conn->prepare("INSERT INTO event_rsvps (event_id, user_id, status) VALUES (?, ?, ?)
                                      ON DUPLICATE KEY UPDATE status=?");
        return $stmt->execute([$eventId, $userId, $status, $status]);
    }

    public function getRsvp($eventId, $userId) {
        $stmt = $this->conn->prepare("SELECT * FROM event_rsvps WHERE event_id=? AND user_id=?");
        $stmt->execute([$eventId, $userId]);
        return $stmt->fetch();
    }

    public function getRsvpCount($eventId) {
        $stmt = $this->conn->prepare("SELECT COUNT(*) FROM event_rsvps WHERE event_id=? AND status='going'");
        $stmt->execute([$eventId]);
        return $stmt->fetchColumn();
    }

    public function getAttendeeCount($userId) {
        $stmt = $this->conn->prepare("SELECT COUNT(*) FROM event_rsvps WHERE user_id=? AND status='going'");
        $stmt->execute([$userId]);
        return $stmt->fetchColumn();
    }
}
