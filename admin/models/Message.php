<?php
require_once __DIR__ . '/../config/database.php';

class Message {
    private $conn;
    public function __construct() {
        $db = new Database();
        $this->conn = $db->getConnection();
    }

    public function send($senderId, $receiverId, $body) {
        $stmt = $this->conn->prepare("INSERT INTO messages (sender_id, receiver_id, body) VALUES (?, ?, ?)");
        $stmt->execute([$senderId, $receiverId, $body]);
        return $this->conn->lastInsertId();
    }

    public function getConversation($userA, $userB, $limit = 100) {
        $stmt = $this->conn->prepare("SELECT * FROM messages
                                      WHERE (sender_id=? AND receiver_id=?) OR (sender_id=? AND receiver_id=?)
                                      ORDER BY created_at ASC LIMIT ?");
        $stmt->bindValue(1, $userA, PDO::PARAM_INT);
        $stmt->bindValue(2, $userB, PDO::PARAM_INT);
        $stmt->bindValue(3, $userB, PDO::PARAM_INT);
        $stmt->bindValue(4, $userA, PDO::PARAM_INT);
        $stmt->bindValue(5, $limit, PDO::PARAM_INT);
        $stmt->execute();
        return $stmt->fetchAll();
    }

    public function getInbox($userId) {
        // Get latest message per conversation partner. Coalesce alumni name with admin name
        // so chats with admins also show a real name (not "Alumni").
        $sql = "SELECT m.*,
                       COALESCE(a.name, ad.name, u.email) AS partner_name,
                       a.profile_picture,
                       u.role AS partner_role,
                       CASE WHEN m.sender_id = ? THEN m.receiver_id ELSE m.sender_id END AS partner_id
                FROM messages m
                LEFT JOIN users u ON u.user_id = CASE WHEN m.sender_id = ? THEN m.receiver_id ELSE m.sender_id END
                LEFT JOIN alumni a ON a.user_id = u.user_id
                LEFT JOIN admin ad ON ad.user_id = u.user_id
                WHERE m.message_id IN (
                    SELECT MAX(message_id) FROM messages
                    WHERE sender_id=? OR receiver_id=?
                    GROUP BY LEAST(sender_id, receiver_id), GREATEST(sender_id, receiver_id)
                )
                ORDER BY m.created_at DESC";
        $stmt = $this->conn->prepare($sql);
        $stmt->execute([$userId, $userId, $userId, $userId]);
        return $stmt->fetchAll();
    }

    public function markRead($senderId, $receiverId) {
        $stmt = $this->conn->prepare("UPDATE messages SET is_read=1 WHERE sender_id=? AND receiver_id=? AND is_read=0");
        return $stmt->execute([$senderId, $receiverId]);
    }

    public function unreadCount($userId) {
        $stmt = $this->conn->prepare("SELECT COUNT(*) FROM messages WHERE receiver_id=? AND is_read=0");
        $stmt->execute([$userId]);
        return $stmt->fetchColumn();
    }

    public function sentCount($userId) {
        $stmt = $this->conn->prepare("SELECT COUNT(*) FROM messages WHERE sender_id=?");
        $stmt->execute([$userId]);
        return $stmt->fetchColumn();
    }
}
