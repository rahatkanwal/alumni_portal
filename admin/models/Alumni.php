<?php
/**
 * Alumni Model
 * Handles all database operations for Alumni
 */

require_once __DIR__ . '/../config/database.php';

class Alumni {
    private $conn;
    private $table = 'alumni';

    public function __construct() {
        $database = new Database();
        $this->conn = $database->getConnection();
    }

    /**
     * Register a new alumni
     * @param array $data
     * @return array|false
     */
    public function register($data) {
        try {
            $this->conn->beginTransaction();

            // First, create user account
            $userQuery = "INSERT INTO users (email, password, role, status) 
                         VALUES (:email, :password, 'alumni', 'active')";
            $userStmt = $this->conn->prepare($userQuery);
            
            $hashedPassword = password_hash($data['password'], PASSWORD_DEFAULT);
            
            $userStmt->bindParam(':email', $data['email']);
            $userStmt->bindParam(':password', $hashedPassword);
            
            if (!$userStmt->execute()) {
                throw new Exception("Failed to create user account");
            }

            $userId = $this->conn->lastInsertId();

            // Then, create alumni profile
            $alumniQuery = "INSERT INTO " . $this->table . " 
                          (user_id, name, phone, graduation_year, department, degree, 
                           current_job, company, address, bio, achievements, skills) 
                          VALUES 
                          (:user_id, :name, :phone, :graduation_year, :department, :degree,
                           :current_job, :company, :address, :bio, :achievements, :skills)";
            
            $alumniStmt = $this->conn->prepare($alumniQuery);
            
            // Use bindValue for direct values (including null)
            $alumniStmt->bindValue(':user_id', $userId);
            $alumniStmt->bindValue(':name', $data['name']);
            $alumniStmt->bindValue(':phone', $data['phone'] ?? null, PDO::PARAM_STR);
            $alumniStmt->bindValue(':graduation_year', $data['graduation_year'] ?? null, PDO::PARAM_INT);
            $alumniStmt->bindValue(':department', $data['department'] ?? null, PDO::PARAM_STR);
            $alumniStmt->bindValue(':degree', $data['degree'] ?? null, PDO::PARAM_STR);
            $alumniStmt->bindValue(':current_job', $data['current_job'] ?? null, PDO::PARAM_STR);
            $alumniStmt->bindValue(':company', $data['company'] ?? null, PDO::PARAM_STR);
            $alumniStmt->bindValue(':address', $data['address'] ?? null, PDO::PARAM_STR);
            $alumniStmt->bindValue(':bio', $data['bio'] ?? null, PDO::PARAM_STR);
            $alumniStmt->bindValue(':achievements', $data['achievements'] ?? null, PDO::PARAM_STR);
            $alumniStmt->bindValue(':skills', $data['skills'] ?? null, PDO::PARAM_STR);

            if (!$alumniStmt->execute()) {
                throw new Exception("Failed to create alumni profile");
            }

            $this->conn->commit();
            return [
                'success' => true,
                'user_id' => $userId,
                'alumni_id' => $this->conn->lastInsertId()
            ];

        } catch(Exception $e) {
            $this->conn->rollBack();
            error_log("Registration error: " . $e->getMessage());
            return ['success' => false, 'error' => $e->getMessage()];
        }
    }

    /**
     * Get alumni by user ID
     * @param int $userId
     * @return array|false
     */
    public function getByUserId($userId) {
        $query = "SELECT a.*, u.email, u.role, u.status 
                  FROM " . $this->table . " a
                  INNER JOIN users u ON a.user_id = u.user_id
                  WHERE a.user_id = :user_id";
        
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':user_id', $userId);
        $stmt->execute();
        
        return $stmt->fetch();
    }

    /**
     * Get alumni by email
     * @param string $email
     * @return array|false
     */
    public function getByEmail($email) {
        $query = "SELECT a.*, u.email, u.password, u.role, u.status 
                  FROM " . $this->table . " a
                  INNER JOIN users u ON a.user_id = u.user_id
                  WHERE u.email = :email";
        
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':email', $email);
        $stmt->execute();
        
        return $stmt->fetch();
    }

    /**
     * Update alumni profile
     * @param int $userId
     * @param array $data
     * @return bool
     */
    public function updateProfile($userId, $data) {
        try {
            $query = "UPDATE " . $this->table . " SET
                      name = :name,
                      phone = :phone,
                      graduation_year = :graduation_year,
                      department = :department,
                      degree = :degree,
                      current_job = :current_job,
                      company = :company,
                      address = :address,
                      bio = :bio,
                      achievements = :achievements,
                      skills = :skills";
            
            if (isset($data['profile_picture'])) {
                $query .= ", profile_picture = :profile_picture";
            }
            
            $query .= " WHERE user_id = :user_id";
            
            $stmt = $this->conn->prepare($query);
            
            // Use bindValue for direct values (including null)
            $stmt->bindValue(':user_id', $userId);
            $stmt->bindValue(':name', $data['name']);
            $stmt->bindValue(':phone', $data['phone'] ?? null, PDO::PARAM_STR);
            $stmt->bindValue(':graduation_year', $data['graduation_year'] ?? null, PDO::PARAM_INT);
            $stmt->bindValue(':department', $data['department'] ?? null, PDO::PARAM_STR);
            $stmt->bindValue(':degree', $data['degree'] ?? null, PDO::PARAM_STR);
            $stmt->bindValue(':current_job', $data['current_job'] ?? null, PDO::PARAM_STR);
            $stmt->bindValue(':company', $data['company'] ?? null, PDO::PARAM_STR);
            $stmt->bindValue(':address', $data['address'] ?? null, PDO::PARAM_STR);
            $stmt->bindValue(':bio', $data['bio'] ?? null, PDO::PARAM_STR);
            $stmt->bindValue(':achievements', $data['achievements'] ?? null, PDO::PARAM_STR);
            $stmt->bindValue(':skills', $data['skills'] ?? null, PDO::PARAM_STR);
            
            if (isset($data['profile_picture'])) {
                $stmt->bindValue(':profile_picture', $data['profile_picture'], PDO::PARAM_STR);
            }
            
            return $stmt->execute();
        } catch(PDOException $e) {
            error_log("Update profile error: " . $e->getMessage());
            return false;
        }
    }

    /**
     * Check if email exists
     * @param string $email
     * @return bool
     */
    public function emailExists($email) {
        $query = "SELECT user_id FROM users WHERE email = :email LIMIT 1";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':email', $email);
        $stmt->execute();
        
        return $stmt->rowCount() > 0;
    }

    /**
     * Get all alumni (for directory)
     * @param array $filters
     * @return array
     */
    public function getAll($filters = []) {
        $query = "SELECT a.*, u.email 
                  FROM " . $this->table . " a
                  INNER JOIN users u ON a.user_id = u.user_id
                  WHERE u.status = 'active'";
        
        $params = [];
        
        if (!empty($filters['name'])) {
            $query .= " AND a.name LIKE :name";
            $params[':name'] = '%' . $filters['name'] . '%';
        }
        
        if (!empty($filters['graduation_year'])) {
            $query .= " AND a.graduation_year = :graduation_year";
            $params[':graduation_year'] = $filters['graduation_year'];
        }
        
        if (!empty($filters['department'])) {
            $query .= " AND a.department = :department";
            $params[':department'] = $filters['department'];
        }
        
        $query .= " ORDER BY a.name ASC";

        $stmt = $this->conn->prepare($query);
        foreach ($params as $key => $value) {
            $stmt->bindValue($key, $value);
        }
        $stmt->execute();

        return $stmt->fetchAll();
    }

    /**
     * Count alumni (optionally with filter)
     */
    public function count($activeOnly = true) {
        $sql = "SELECT COUNT(*) FROM alumni a INNER JOIN users u ON a.user_id=u.user_id";
        if ($activeOnly) $sql .= " WHERE u.status='active'";
        return (int)$this->conn->query($sql)->fetchColumn();
    }

    /**
     * Count grouped by graduation year (for analytics)
     */
    public function countByYear() {
        $sql = "SELECT graduation_year, COUNT(*) as cnt FROM alumni WHERE graduation_year IS NOT NULL GROUP BY graduation_year ORDER BY graduation_year ASC";
        return $this->conn->query($sql)->fetchAll();
    }

    /**
     * Count grouped by department (for analytics)
     */
    public function countByDepartment() {
        $sql = "SELECT department, COUNT(*) as cnt FROM alumni WHERE department IS NOT NULL AND department != '' GROUP BY department ORDER BY cnt DESC";
        return $this->conn->query($sql)->fetchAll();
    }

    /**
     * Get all departments (distinct, for filter dropdown)
     */
    public function getDepartments() {
        $sql = "SELECT DISTINCT department FROM alumni WHERE department IS NOT NULL AND department != '' ORDER BY department ASC";
        return $this->conn->query($sql)->fetchAll(PDO::FETCH_COLUMN);
    }

    /**
     * Get all graduation years (distinct, for filter dropdown)
     */
    public function getGraduationYears() {
        $sql = "SELECT DISTINCT graduation_year FROM alumni WHERE graduation_year IS NOT NULL ORDER BY graduation_year DESC";
        return $this->conn->query($sql)->fetchAll(PDO::FETCH_COLUMN);
    }

    /**
     * Update status (active/suspended) via user table
     */
    public function setStatus($userId, $status) {
        $stmt = $this->conn->prepare("UPDATE users SET status=? WHERE user_id=?");
        return $stmt->execute([$status, $userId]);
    }

    /**
     * Save geocoded coordinates for an alumni's address.
     */
    public function setCoordinates($userId, $lat, $lng, $geocodedAddress) {
        $stmt = $this->conn->prepare("UPDATE alumni SET latitude=?, longitude=?, geocoded_address=? WHERE user_id=?");
        return $stmt->execute([$lat, $lng, $geocodedAddress, $userId]);
    }

    /**
     * Clear coordinates (when address is removed).
     */
    public function clearCoordinates($userId) {
        $stmt = $this->conn->prepare("UPDATE alumni SET latitude=NULL, longitude=NULL, geocoded_address=NULL WHERE user_id=?");
        return $stmt->execute([$userId]);
    }

    /**
     * Get alumni who have coordinates set (for map view).
     */
    public function getGeocoded() {
        $sql = "SELECT a.*, u.email FROM alumni a
                INNER JOIN users u ON a.user_id=u.user_id
                WHERE a.latitude IS NOT NULL AND a.longitude IS NOT NULL AND u.status='active'
                ORDER BY a.name ASC";
        return $this->conn->query($sql)->fetchAll();
    }

    /**
     * Get alumni who need geocoding (have address but no coords).
     */
    public function getNeedsGeocoding() {
        $sql = "SELECT user_id, name, address FROM alumni
                WHERE address IS NOT NULL AND address != ''
                AND (latitude IS NULL OR longitude IS NULL)";
        return $this->conn->query($sql)->fetchAll();
    }

    /**
     * Delete alumni (cascades via FK)
     */
    public function delete($userId) {
        $stmt = $this->conn->prepare("DELETE FROM users WHERE user_id=?");
        return $stmt->execute([$userId]);
    }
}

