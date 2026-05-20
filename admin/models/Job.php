<?php
require_once __DIR__ . '/../config/database.php';

class Job {
    private $conn;
    public function __construct() {
        $db = new Database();
        $this->conn = $db->getConnection();
    }

    public function create($data) {
        $sql = "INSERT INTO jobs (title, company, location, job_type, description, requirements, salary_range, apply_link, posted_by, deadline)
                VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";
        $stmt = $this->conn->prepare($sql);
        $stmt->execute([
            $data['title'], $data['company'], $data['location'] ?? null,
            $data['job_type'] ?? 'full-time', $data['description'], $data['requirements'] ?? null,
            $data['salary_range'] ?? null, $data['apply_link'] ?? null,
            $data['posted_by'], $data['deadline'] ?? null
        ]);
        return $this->conn->lastInsertId();
    }

    public function update($id, $data) {
        $stmt = $this->conn->prepare("UPDATE jobs SET title=?, company=?, location=?, job_type=?, description=?, requirements=?, salary_range=?, apply_link=?, deadline=?, status=? WHERE job_id=?");
        return $stmt->execute([
            $data['title'], $data['company'], $data['location'] ?? null,
            $data['job_type'] ?? 'full-time', $data['description'], $data['requirements'] ?? null,
            $data['salary_range'] ?? null, $data['apply_link'] ?? null,
            $data['deadline'] ?? null, $data['status'] ?? 'open', $id
        ]);
    }

    public function delete($id) {
        return $this->conn->prepare("DELETE FROM jobs WHERE job_id=?")->execute([$id]);
    }

    public function getById($id) {
        $stmt = $this->conn->prepare("SELECT j.*, a.name as poster_name FROM jobs j LEFT JOIN alumni a ON j.posted_by=a.user_id WHERE j.job_id=?");
        $stmt->execute([$id]);
        return $stmt->fetch();
    }

    public function getAll($filters = []) {
        $sql = "SELECT j.*, a.name as poster_name FROM jobs j LEFT JOIN alumni a ON j.posted_by=a.user_id WHERE j.status='open'";
        $params = [];
        if (!empty($filters['keyword'])) {
            $sql .= " AND (j.title LIKE ? OR j.company LIKE ? OR j.description LIKE ?)";
            $kw = '%' . $filters['keyword'] . '%';
            $params[] = $kw; $params[] = $kw; $params[] = $kw;
        }
        if (!empty($filters['job_type'])) {
            $sql .= " AND j.job_type = ?";
            $params[] = $filters['job_type'];
        }
        $sql .= " ORDER BY j.created_at DESC";
        $stmt = $this->conn->prepare($sql);
        $stmt->execute($params);
        return $stmt->fetchAll();
    }

    public function getByUser($userId) {
        $stmt = $this->conn->prepare("SELECT * FROM jobs WHERE posted_by=? ORDER BY created_at DESC");
        $stmt->execute([$userId]);
        return $stmt->fetchAll();
    }

    public function apply($jobId, $userId, $coverLetter = null, $resume = null) {
        $stmt = $this->conn->prepare("INSERT INTO job_applications (job_id, user_id, cover_letter, resume) VALUES (?, ?, ?, ?)
                                     ON DUPLICATE KEY UPDATE cover_letter=?, resume=?");
        return $stmt->execute([$jobId, $userId, $coverLetter, $resume, $coverLetter, $resume]);
    }

    public function getApplications($jobId) {
        $stmt = $this->conn->prepare("SELECT ja.*, a.name, u.email FROM job_applications ja
                                      LEFT JOIN alumni a ON ja.user_id=a.user_id
                                      LEFT JOIN users u ON ja.user_id=u.user_id
                                      WHERE ja.job_id=? ORDER BY ja.applied_at DESC");
        $stmt->execute([$jobId]);
        return $stmt->fetchAll();
    }

    public function hasApplied($jobId, $userId) {
        $stmt = $this->conn->prepare("SELECT 1 FROM job_applications WHERE job_id=? AND user_id=?");
        $stmt->execute([$jobId, $userId]);
        return (bool)$stmt->fetchColumn();
    }
}
