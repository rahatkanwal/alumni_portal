<?php
/**
 * Public Data Helper
 * Bridges public-facing pages with the admin/MVC database layer.
 * Usage: require_once __DIR__ . '/includes/public_data.php';
 */

require_once __DIR__ . '/../admin/config/database.php';

if (!function_exists('e')) {
    function e($s) { return htmlspecialchars($s ?? '', ENT_QUOTES, 'UTF-8'); }
}

function pdo_conn() {
    static $conn = null;
    if ($conn === null) {
        $db = new Database();
        $conn = $db->getConnection();
    }
    return $conn;
}

function public_get_events($onlyUpcoming = false, $limit = null) {
    $conn = pdo_conn();
    if (!$conn) return [];
    $sql = "SELECT * FROM events";
    if ($onlyUpcoming) $sql .= " WHERE event_date >= NOW()";
    $sql .= " ORDER BY event_date " . ($onlyUpcoming ? "ASC" : "DESC");
    if ($limit) $sql .= " LIMIT " . (int)$limit;
    return $conn->query($sql)->fetchAll();
}

function public_get_jobs($limit = null) {
    $conn = pdo_conn();
    if (!$conn) return [];
    $sql = "SELECT j.*, a.name as poster_name FROM jobs j
            LEFT JOIN alumni a ON j.posted_by=a.user_id
            WHERE j.status='open' ORDER BY j.created_at DESC";
    if ($limit) $sql .= " LIMIT " . (int)$limit;
    return $conn->query($sql)->fetchAll();
}

function public_get_announcements($limit = null) {
    $conn = pdo_conn();
    if (!$conn) return [];
    $sql = "SELECT * FROM announcements ORDER BY created_at DESC";
    if ($limit) $sql .= " LIMIT " . (int)$limit;
    return $conn->query($sql)->fetchAll();
}

function public_get_announcement($id) {
    $conn = pdo_conn();
    if (!$conn) return null;
    $stmt = $conn->prepare("SELECT * FROM announcements WHERE announcement_id=?");
    $stmt->execute([(int)$id]);
    return $stmt->fetch();
}

function public_get_event($id) {
    $conn = pdo_conn();
    if (!$conn) return null;
    $stmt = $conn->prepare("SELECT * FROM events WHERE event_id=?");
    $stmt->execute([(int)$id]);
    return $stmt->fetch();
}

function public_get_job($id) {
    $conn = pdo_conn();
    if (!$conn) return null;
    $stmt = $conn->prepare("SELECT j.*, a.name as poster_name FROM jobs j LEFT JOIN alumni a ON j.posted_by=a.user_id WHERE j.job_id=?");
    $stmt->execute([(int)$id]);
    return $stmt->fetch();
}

function public_get_stories($limit = null) {
    $conn = pdo_conn();
    if (!$conn) return [];
    $sql = "SELECT cs.*, a.name, a.graduation_year, a.department, a.profile_picture
            FROM career_stories cs
            LEFT JOIN alumni a ON cs.user_id=a.user_id
            WHERE cs.status='approved'
            ORDER BY cs.is_featured DESC, cs.created_at DESC";
    if ($limit) $sql .= " LIMIT " . (int)$limit;
    return $conn->query($sql)->fetchAll();
}

function public_get_story($id) {
    $conn = pdo_conn();
    if (!$conn) return null;
    $stmt = $conn->prepare("SELECT cs.*, a.name, a.graduation_year, a.department, a.profile_picture
                            FROM career_stories cs LEFT JOIN alumni a ON cs.user_id=a.user_id
                            WHERE cs.story_id=? AND cs.status='approved'");
    $stmt->execute([(int)$id]);
    return $stmt->fetch();
}

function public_get_gallery($limit = null) {
    $conn = pdo_conn();
    if (!$conn) return [];
    $sql = "SELECT g.*, e.title as event_title FROM gallery g
            LEFT JOIN events e ON g.event_id=e.event_id
            ORDER BY g.created_at DESC";
    if ($limit) $sql .= " LIMIT " . (int)$limit;
    return $conn->query($sql)->fetchAll();
}

/**
 * Get distinguished/featured alumni for homepage carousels.
 * Prioritizes: alumni with featured stories, then alumni with most badges,
 * then alumni with detailed profiles (job + bio set).
 */
function public_get_featured_alumni($limit = 5) {
    $conn = pdo_conn();
    if (!$conn) return [];
    $sql = "SELECT a.*, u.email,
                   (SELECT COUNT(*) FROM user_badges ub WHERE ub.user_id = a.user_id) AS badge_count,
                   (SELECT COUNT(*) FROM career_stories cs WHERE cs.user_id = a.user_id AND cs.status='approved') AS story_count
            FROM alumni a
            INNER JOIN users u ON a.user_id = u.user_id
            WHERE u.status='active'
              AND a.current_job IS NOT NULL AND a.current_job != ''
            ORDER BY story_count DESC, badge_count DESC, a.updated_at DESC
            LIMIT " . (int)$limit;
    return $conn->query($sql)->fetchAll();
}

/**
 * Get active mentors for homepage carousel.
 */
function public_get_mentors($limit = 6) {
    $conn = pdo_conn();
    if (!$conn) return [];
    $sql = "SELECT m.*,
                   COALESCE(a.name, ad.name, u.email) as name,
                   a.department,
                   a.graduation_year,
                   a.current_job,
                   a.company,
                   a.profile_picture
            FROM mentorship_profiles m
            INNER JOIN users u ON m.user_id = u.user_id
            LEFT JOIN alumni a ON m.user_id = a.user_id
            LEFT JOIN admin ad ON m.user_id = ad.user_id
            WHERE m.is_active = 1 AND m.approval_status = 'approved' AND u.status = 'active'
            ORDER BY m.created_at DESC
            LIMIT " . (int)$limit;
    return $conn->query($sql)->fetchAll();
}

/**
 * Aggregate counts for feature cards (chapters, associations, etc.).
 * For sections we don't have proper tables for (chapters), derive from alumni
 * locations or use admin-set static counts.
 */
function public_get_feature_counts() {
    $conn = pdo_conn();
    if (!$conn) {
        return ['national_chapters' => 0, 'intl_chapters' => 0, 'associations' => 0,
                'mentors' => 0, 'alumni' => 0, 'departments' => 0];
    }
    return [
        'alumni' => (int)$conn->query("SELECT COUNT(*) FROM alumni a JOIN users u ON a.user_id=u.user_id WHERE u.status='active'")->fetchColumn(),
        'mentors' => (int)$conn->query("SELECT COUNT(*) FROM mentorship_profiles m INNER JOIN users u ON m.user_id=u.user_id WHERE m.is_active=1 AND m.approval_status='approved' AND u.status='active'")->fetchColumn(),
        'departments' => (int)$conn->query("SELECT COUNT(DISTINCT department) FROM alumni WHERE department IS NOT NULL AND department != ''")->fetchColumn(),
        'graduation_years' => (int)$conn->query("SELECT COUNT(DISTINCT graduation_year) FROM alumni WHERE graduation_year IS NOT NULL")->fetchColumn(),
        // National chapters: count distinct cities of geocoded Pakistani alumni
        'national_chapters' => (int)$conn->query("SELECT COUNT(DISTINCT TRIM(SUBSTRING_INDEX(address, ',', 1)))
                                                  FROM alumni
                                                  WHERE address LIKE '%Pakistan%' OR address LIKE '%pakistan%'")->fetchColumn(),
        // International chapters: count distinct non-Pakistani locations
        'intl_chapters' => (int)$conn->query("SELECT COUNT(DISTINCT TRIM(SUBSTRING_INDEX(address, ',', 1)))
                                              FROM alumni
                                              WHERE address IS NOT NULL AND address != ''
                                                AND address NOT LIKE '%Pakistan%' AND address NOT LIKE '%pakistan%'")->fetchColumn(),
        'announcements' => (int)$conn->query("SELECT COUNT(*) FROM announcements")->fetchColumn(),
    ];
}

function public_stats() {
    $conn = pdo_conn();
    if (!$conn) return ['alumni' => 0, 'events' => 0, 'jobs' => 0, 'stories' => 0];
    return [
        'alumni' => (int)$conn->query("SELECT COUNT(*) FROM alumni a JOIN users u ON a.user_id=u.user_id WHERE u.status='active'")->fetchColumn(),
        'events' => (int)$conn->query("SELECT COUNT(*) FROM events")->fetchColumn(),
        'jobs' => (int)$conn->query("SELECT COUNT(*) FROM jobs WHERE status='open'")->fetchColumn(),
        'stories' => (int)$conn->query("SELECT COUNT(*) FROM career_stories WHERE status='approved'")->fetchColumn(),
    ];
}

/**
 * Map admin asset paths (assets/images/...) to public-accessible URLs.
 * Admin saves images with relative path like "assets/images/events/xxx.jpg",
 * but that's relative to /admin/ — for public pages we need to prepend "admin/".
 */
function public_asset($adminPath, $fallback = null) {
    if (empty($adminPath)) return $fallback;
    if (strpos($adminPath, 'http') === 0) return $adminPath;
    if (strpos($adminPath, '/') === 0) return $adminPath;
    // Relative paths like "assets/images/events/xxx.jpg" are stored relative to admin dir
    return 'admin/' . $adminPath;
}
