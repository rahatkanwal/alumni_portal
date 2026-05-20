<?php
/**
 * Admin Model
 * Handles all database operations for Admin
 */

require_once __DIR__ . '/../config/database.php';

class Admin {
    private $conn;
    private $table = 'admin';

    public function __construct() {
        $database = new Database();
        $this->conn = $database->getConnection();
    }

    /**
     * Get admin by email
     * @param string $email
     * @return array|false
     */
    public function getByEmail($email) {
        $query = "SELECT a.*, u.email, u.password, u.role, u.status 
                  FROM " . $this->table . " a
                  INNER JOIN users u ON a.user_id = u.user_id
                  WHERE u.email = :email AND u.role = 'admin'";
        
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':email', $email);
        $stmt->execute();
        
        return $stmt->fetch();
    }

    /**
     * Get admin by user ID
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
}

