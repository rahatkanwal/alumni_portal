<?php
/**
 * Helper functions used across the portal
 */

function require_login() {
    if (!isset($_SESSION['user_id'])) {
        header('Location: index.php?action=login');
        exit;
    }
}

function require_admin() {
    require_login();
    if (($_SESSION['role'] ?? '') !== 'admin') {
        header('Location: index.php?action=dashboard');
        exit;
    }
}

function require_alumni() {
    require_login();
    if (($_SESSION['role'] ?? '') !== 'alumni') {
        header('Location: index.php?action=admin_dashboard');
        exit;
    }
}

function flash($key, $msg = null) {
    if ($msg === null) {
        $val = $_SESSION['flash'][$key] ?? null;
        unset($_SESSION['flash'][$key]);
        return $val;
    }
    $_SESSION['flash'][$key] = $msg;
}

function e($str) {
    return htmlspecialchars($str ?? '', ENT_QUOTES, 'UTF-8');
}

function csrf_token() {
    if (empty($_SESSION['csrf_token'])) {
        $_SESSION['csrf_token'] = bin2hex(random_bytes(32));
    }
    return $_SESSION['csrf_token'];
}

function csrf_check() {
    return isset($_POST['csrf_token']) && hash_equals($_SESSION['csrf_token'] ?? '', $_POST['csrf_token']);
}

function log_activity($userId, $type, $description, $link = null) {
    try {
        require_once __DIR__ . '/../config/database.php';
        $db = new Database();
        $conn = $db->getConnection();
        if (!$conn) return;
        $stmt = $conn->prepare("INSERT INTO activities (user_id, activity_type, description, link) VALUES (?, ?, ?, ?)");
        $stmt->execute([$userId, $type, $description, $link]);
    } catch (Exception $e) {
        error_log('Activity log failed: ' . $e->getMessage());
    }
}

function calc_profile_completeness($profile) {
    $fields = ['name', 'phone', 'graduation_year', 'department', 'degree', 'current_job', 'company', 'address', 'bio', 'achievements', 'skills', 'profile_picture'];
    $filled = 0;
    foreach ($fields as $f) {
        if (!empty($profile[$f])) $filled++;
    }
    return (int) round(($filled / count($fields)) * 100);
}

function send_notification_email($to, $subject, $body) {
    // Uses PHP mail(). In production replace with SMTP/PHPMailer.
    $headers = "From: noreply@uafalumni.local\r\nReply-To: noreply@uafalumni.local\r\nContent-Type: text/html; charset=UTF-8\r\n";
    @mail($to, $subject, $body, $headers);
    // Always log for dev environments where mail() is not configured
    error_log("[EMAIL] To: $to | Subject: $subject");
}

/**
 * Geocode an address string to lat/lng using OpenStreetMap Nominatim.
 * Returns ['lat' => float, 'lng' => float, 'display' => string] on success, or null on failure.
 *
 * Per Nominatim usage policy: max 1 request/second, must send descriptive User-Agent.
 * https://operations.osmfoundation.org/policies/nominatim/
 */
function geocode_address($address) {
    $address = trim($address ?? '');
    if ($address === '') return null;

    $url = 'https://nominatim.openstreetmap.org/search?' . http_build_query([
        'q' => $address,
        'format' => 'json',
        'limit' => 1,
        'addressdetails' => 0,
    ]);

    $ctx = stream_context_create([
        'http' => [
            'method' => 'GET',
            'header' => "User-Agent: UAF-Alumni-Portal/1.0 (alumni-portal@uaf.edu.pk)\r\n",
            'timeout' => 6,
        ]
    ]);

    $json = @file_get_contents($url, false, $ctx);
    if ($json === false) {
        error_log("Geocoding failed (network) for: $address");
        return null;
    }

    $data = json_decode($json, true);
    if (!is_array($data) || empty($data[0]['lat']) || empty($data[0]['lon'])) {
        error_log("Geocoding returned no results for: $address");
        return null;
    }

    return [
        'lat' => (float)$data[0]['lat'],
        'lng' => (float)$data[0]['lon'],
        'display' => $data[0]['display_name'] ?? $address,
    ];
}

/**
 * Get display info for any user (alumni OR admin OR anyone in users table).
 * Returns ['user_id', 'name', 'email', 'role', 'profile_picture', 'current_job'].
 * Returns null if user doesn't exist.
 */
function get_user_display($userId) {
    $userId = (int)$userId;
    if (!$userId) return null;
    require_once __DIR__ . '/../config/database.php';
    $db = new Database();
    $conn = $db->getConnection();
    if (!$conn) return null;

    // Try alumni first (most common case)
    $stmt = $conn->prepare("SELECT u.user_id, u.email, u.role, a.name, a.profile_picture, a.current_job, a.company
                            FROM users u
                            LEFT JOIN alumni a ON a.user_id = u.user_id
                            WHERE u.user_id = ?");
    $stmt->execute([$userId]);
    $row = $stmt->fetch();
    if (!$row) return null;

    // Admin fallback for name
    if (empty($row['name'])) {
        $adminStmt = $conn->prepare("SELECT name FROM admin WHERE user_id = ?");
        $adminStmt->execute([$userId]);
        $admin = $adminStmt->fetch();
        if ($admin) $row['name'] = $admin['name'];
    }

    // Final fallback
    if (empty($row['name'])) $row['name'] = $row['email'] ?? 'User';

    return $row;
}

function award_badge_if_eligible($userId, $badgeName) {
    try {
        require_once __DIR__ . '/../config/database.php';
        $db = new Database();
        $conn = $db->getConnection();
        if (!$conn) return;
        $stmt = $conn->prepare("SELECT badge_id FROM badges WHERE name = ?");
        $stmt->execute([$badgeName]);
        $badge = $stmt->fetch();
        if ($badge) {
            $ins = $conn->prepare("INSERT IGNORE INTO user_badges (user_id, badge_id) VALUES (?, ?)");
            $ins->execute([$userId, $badge['badge_id']]);
        }
    } catch (Exception $e) {
        error_log('Badge award failed: ' . $e->getMessage());
    }
}
