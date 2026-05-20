<?php
require_once __DIR__ . '/../config/database.php';

class Mentorship {
    private $conn;
    public function __construct() {
        $db = new Database();
        $this->conn = $db->getConnection();
    }

    public function becomeOrUpdateMentor($userId, $expertise, $availability, $bio) {
        $stmt = $this->conn->prepare("INSERT INTO mentorship_profiles (user_id, expertise, availability, bio) VALUES (?, ?, ?, ?)
                                      ON DUPLICATE KEY UPDATE expertise=?, availability=?, bio=?, is_active=1, approval_status='pending', admin_notes=NULL");
        return $stmt->execute([$userId, $expertise, $availability, $bio, $expertise, $availability, $bio]);
    }

    public function getMentorProfile($userId) {
        $stmt = $this->conn->prepare("SELECT * FROM mentorship_profiles WHERE user_id=?");
        $stmt->execute([$userId]);
        return $stmt->fetch();
    }

    public function getAllMentors() {
        return $this->conn->query("SELECT m.*, a.name, a.department, a.graduation_year, a.current_job, a.company, a.profile_picture
                                   FROM mentorship_profiles m
                                   INNER JOIN alumni a ON m.user_id=a.user_id
                                   WHERE m.is_active=1 AND m.approval_status='approved'
                                   ORDER BY m.created_at DESC")->fetchAll();
    }

    public function getAllMentorApplications() {
        return $this->conn->query("SELECT m.*,
                                          COALESCE(a.name, ad.name, u.email) as name,
                                          a.department,
                                          a.graduation_year,
                                          a.current_job,
                                          a.company,
                                          a.profile_picture,
                                          u.email,
                                          u.role
                                   FROM mentorship_profiles m
                                   INNER JOIN users u ON m.user_id=u.user_id
                                   LEFT JOIN alumni a ON m.user_id=a.user_id
                                   LEFT JOIN admin ad ON m.user_id=ad.user_id
                                   ORDER BY FIELD(m.approval_status, 'pending', 'approved', 'rejected'), m.created_at DESC")->fetchAll();
    }

    public function countByApprovalStatus($status) {
        $stmt = $this->conn->prepare("SELECT COUNT(*) FROM mentorship_profiles WHERE approval_status=?");
        $stmt->execute([$status]);
        return (int)$stmt->fetchColumn();
    }

    public function updateMentorApproval($mentorId, $status, $adminNotes = null) {
        $allowed = ['pending', 'approved', 'rejected'];
        if (!in_array($status, $allowed, true)) return false;
        $isActive = $status === 'approved' ? 1 : 0;
        $stmt = $this->conn->prepare("UPDATE mentorship_profiles SET approval_status=?, admin_notes=?, is_active=? WHERE mentor_id=?");
        return $stmt->execute([$status, $adminNotes, $isActive, $mentorId]);
    }

    public function sendRequest($mentorUserId, $menteeUserId, $message) {
        $check = $this->conn->prepare("SELECT 1 FROM mentorship_profiles WHERE user_id=? AND is_active=1 AND approval_status='approved'");
        $check->execute([$mentorUserId]);
        if (!$check->fetchColumn()) return false;

        $stmt = $this->conn->prepare("INSERT INTO mentorship_requests (mentor_user_id, mentee_user_id, message) VALUES (?, ?, ?)");
        return $stmt->execute([$mentorUserId, $menteeUserId, $message]);
    }

    public function updateRequestStatus($requestId, $status, $mentorUserId) {
        $stmt = $this->conn->prepare("UPDATE mentorship_requests SET status=? WHERE request_id=? AND mentor_user_id=?");
        return $stmt->execute([$status, $requestId, $mentorUserId]);
    }

    public function getIncomingRequests($mentorUserId) {
        $stmt = $this->conn->prepare("SELECT r.*, a.name as mentee_name, a.profile_picture FROM mentorship_requests r
                                      LEFT JOIN alumni a ON r.mentee_user_id=a.user_id
                                      WHERE r.mentor_user_id=? ORDER BY r.created_at DESC");
        $stmt->execute([$mentorUserId]);
        return $stmt->fetchAll();
    }

    public function getOutgoingRequests($menteeUserId) {
        $stmt = $this->conn->prepare("SELECT r.*, a.name as mentor_name, a.profile_picture, m.expertise FROM mentorship_requests r
                                      LEFT JOIN alumni a ON r.mentor_user_id=a.user_id
                                      LEFT JOIN mentorship_profiles m ON r.mentor_user_id=m.user_id
                                      WHERE r.mentee_user_id=? ORDER BY r.created_at DESC");
        $stmt->execute([$menteeUserId]);
        return $stmt->fetchAll();
    }
}
