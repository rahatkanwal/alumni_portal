<?php
require_once __DIR__ . '/../config/database.php';

class HonorCardApplication {
    private $conn;

    public function __construct() {
        $db = new Database();
        $this->conn = $db->getConnection();
    }

    public function getByUser($userId) {
        $stmt = $this->conn->prepare("SELECT * FROM honor_card_applications WHERE user_id = ?");
        $stmt->execute([$userId]);
        return $stmt->fetch();
    }

    public function createOrUpdate($userId, $data) {
        $sql = "INSERT INTO honor_card_applications (user_id, applicant_name, applicant_email, department, graduation_year, delivery_address, phone, notes)
                VALUES (?, ?, ?, ?, ?, ?, ?, ?)
                ON DUPLICATE KEY UPDATE
                    applicant_name = VALUES(applicant_name),
                    applicant_email = VALUES(applicant_email),
                    department = VALUES(department),
                    graduation_year = VALUES(graduation_year),
                    delivery_address = VALUES(delivery_address),
                    phone = VALUES(phone),
                    notes = VALUES(notes),
                    status = IF(status = 'rejected', 'pending', status)";
        $stmt = $this->conn->prepare($sql);
        return $stmt->execute([
            $userId,
            $data['applicant_name'] ?? null,
            $data['applicant_email'] ?? null,
            $data['department'] ?? null,
            $data['graduation_year'] ?? null,
            $data['delivery_address'],
            $data['phone'] ?? null,
            $data['notes'] ?? null,
        ]);
    }

    public function createGuest($data) {
        $sql = "INSERT INTO honor_card_applications (user_id, applicant_name, applicant_email, department, graduation_year, delivery_address, phone, notes)
                VALUES (NULL, ?, ?, ?, ?, ?, ?, ?)";
        $stmt = $this->conn->prepare($sql);
        return $stmt->execute([
            $data['applicant_name'],
            $data['applicant_email'],
            $data['department'] ?? null,
            $data['graduation_year'] ?? null,
            $data['delivery_address'],
            $data['phone'] ?? null,
            $data['notes'] ?? null,
        ]);
    }

    public function getAll() {
        $sql = "SELECT h.*,
                    COALESCE(a.name, h.applicant_name) as name,
                    COALESCE(a.department, h.department) as display_department,
                    COALESCE(a.graduation_year, h.graduation_year) as display_graduation_year,
                    COALESCE(u.email, h.applicant_email) as email
                FROM honor_card_applications h
                LEFT JOIN users u ON h.user_id = u.user_id
                LEFT JOIN alumni a ON h.user_id = a.user_id
                ORDER BY FIELD(h.status, 'pending', 'approved', 'issued', 'rejected'), h.applied_at DESC";
        return $this->conn->query($sql)->fetchAll();
    }

    public function countByStatus($status = null) {
        if ($status) {
            $stmt = $this->conn->prepare("SELECT COUNT(*) FROM honor_card_applications WHERE status = ?");
            $stmt->execute([$status]);
            return (int)$stmt->fetchColumn();
        }
        return (int)$this->conn->query("SELECT COUNT(*) FROM honor_card_applications")->fetchColumn();
    }

    public function updateStatus($applicationId, $status, $adminNotes = null) {
        $allowed = ['pending', 'approved', 'rejected', 'issued'];
        if (!in_array($status, $allowed, true)) {
            return false;
        }

        $stmt = $this->conn->prepare("UPDATE honor_card_applications SET status = ?, admin_notes = ? WHERE application_id = ?");
        return $stmt->execute([$status, $adminNotes, $applicationId]);
    }
}
