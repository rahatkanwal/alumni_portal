<?php
/**
 * Database Configuration
 * University Alumni Portal
 */

class Database {
    private $host = 'localhost';
    private $db_name = 'alumni_portal';
    private $username = 'root';
    private $password = '';
    private $conn;

    /**
     * Get database connection
     * @return PDO|null
     */
    public function getConnection() {
        $this->conn = null;

        try {
            $this->conn = new PDO(
                "mysql:host=" . $this->host . ";dbname=" . $this->db_name . ";charset=utf8mb4",
                $this->username,
                $this->password,
                [
                    PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
                    PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
                    PDO::ATTR_EMULATE_PREPARES => false
                ]
            );
        } catch(PDOException $exception) {
            error_log("Connection error: " . $exception->getMessage());
            // For development, you might want to show error
            // die("Connection error: " . $exception->getMessage());
        }

        return $this->conn;
    }

    /**
     * Create database and tables if they don't exist
     */
    public function initializeDatabase() {
        try {
            // Connect without database first
            $pdo = new PDO(
                "mysql:host=" . $this->host . ";charset=utf8mb4",
                $this->username,
                $this->password
            );
            $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

            // Create database if not exists
            $pdo->exec("CREATE DATABASE IF NOT EXISTS `{$this->db_name}` CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci");
            $pdo->exec("USE `{$this->db_name}`");

            // Create users table
            $pdo->exec("CREATE TABLE IF NOT EXISTS `users` (
                `user_id` INT(11) NOT NULL AUTO_INCREMENT,
                `email` VARCHAR(255) NOT NULL UNIQUE,
                `password` VARCHAR(255) NOT NULL,
                `role` VARCHAR(50) NOT NULL DEFAULT 'alumni',
                `created_at` DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP,
                `status` VARCHAR(20) DEFAULT 'active',
                PRIMARY KEY (`user_id`),
                INDEX `idx_email` (`email`),
                INDEX `idx_role` (`role`)
            ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci");

            // Create alumni table
            $pdo->exec("CREATE TABLE IF NOT EXISTS `alumni` (
                `alumni_id` INT(11) NOT NULL AUTO_INCREMENT,
                `user_id` INT(11) NOT NULL UNIQUE,
                `name` VARCHAR(255) NOT NULL,
                `phone` VARCHAR(20) DEFAULT NULL,
                `graduation_year` INT(4) DEFAULT NULL,
                `department` VARCHAR(100) DEFAULT NULL,
                `degree` VARCHAR(100) DEFAULT NULL,
                `current_job` VARCHAR(255) DEFAULT NULL,
                `company` VARCHAR(255) DEFAULT NULL,
                `address` TEXT DEFAULT NULL,
                `profile_picture` VARCHAR(255) DEFAULT NULL,
                `bio` TEXT DEFAULT NULL,
                `achievements` TEXT DEFAULT NULL,
                `skills` TEXT DEFAULT NULL,
                `latitude` DECIMAL(10,7) DEFAULT NULL,
                `longitude` DECIMAL(10,7) DEFAULT NULL,
                `geocoded_address` VARCHAR(500) DEFAULT NULL,
                `updated_at` DATETIME DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP,
                PRIMARY KEY (`alumni_id`),
                FOREIGN KEY (`user_id`) REFERENCES `users`(`user_id`) ON DELETE CASCADE,
                INDEX `idx_user_id` (`user_id`),
                INDEX `idx_graduation_year` (`graduation_year`),
                INDEX `idx_department` (`department`)
            ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci");

            // Idempotent column additions (for existing installs upgraded from earlier schema)
            try { $pdo->exec("ALTER TABLE alumni ADD COLUMN latitude DECIMAL(10,7) DEFAULT NULL"); } catch (Exception $e) {}
            try { $pdo->exec("ALTER TABLE alumni ADD COLUMN longitude DECIMAL(10,7) DEFAULT NULL"); } catch (Exception $e) {}
            try { $pdo->exec("ALTER TABLE alumni ADD COLUMN geocoded_address VARCHAR(500) DEFAULT NULL"); } catch (Exception $e) {}

            // Create admin table
            $pdo->exec("CREATE TABLE IF NOT EXISTS `admin` (
                `admin_id` INT(11) NOT NULL AUTO_INCREMENT,
                `user_id` INT(11) NOT NULL UNIQUE,
                `name` VARCHAR(255) NOT NULL,
                `email` VARCHAR(255) NOT NULL,
                PRIMARY KEY (`admin_id`),
                FOREIGN KEY (`user_id`) REFERENCES `users`(`user_id`) ON DELETE CASCADE,
                INDEX `idx_user_id` (`user_id`)
            ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci");

            // Events table
            $pdo->exec("CREATE TABLE IF NOT EXISTS `events` (
                `event_id` INT(11) NOT NULL AUTO_INCREMENT,
                `title` VARCHAR(255) NOT NULL,
                `description` TEXT NOT NULL,
                `event_date` DATETIME NOT NULL,
                `location` VARCHAR(255) DEFAULT NULL,
                `image` VARCHAR(255) DEFAULT NULL,
                `category` VARCHAR(100) DEFAULT 'general',
                `created_by` INT(11) NOT NULL,
                `latitude` DECIMAL(10,7) DEFAULT NULL,
                `longitude` DECIMAL(10,7) DEFAULT NULL,
                `created_at` DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP,
                `updated_at` DATETIME DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP,
                PRIMARY KEY (`event_id`),
                FOREIGN KEY (`created_by`) REFERENCES `users`(`user_id`) ON DELETE CASCADE,
                INDEX `idx_event_date` (`event_date`)
            ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci");

            // Event RSVPs
            $pdo->exec("CREATE TABLE IF NOT EXISTS `event_rsvps` (
                `rsvp_id` INT(11) NOT NULL AUTO_INCREMENT,
                `event_id` INT(11) NOT NULL,
                `user_id` INT(11) NOT NULL,
                `status` ENUM('going','maybe','not_going') DEFAULT 'going',
                `created_at` DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP,
                PRIMARY KEY (`rsvp_id`),
                UNIQUE KEY `uniq_event_user` (`event_id`,`user_id`),
                FOREIGN KEY (`event_id`) REFERENCES `events`(`event_id`) ON DELETE CASCADE,
                FOREIGN KEY (`user_id`) REFERENCES `users`(`user_id`) ON DELETE CASCADE
            ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci");

            // Announcements/News
            $pdo->exec("CREATE TABLE IF NOT EXISTS `announcements` (
                `announcement_id` INT(11) NOT NULL AUTO_INCREMENT,
                `title` VARCHAR(255) NOT NULL,
                `body` TEXT NOT NULL,
                `image` VARCHAR(255) DEFAULT NULL,
                `created_by` INT(11) NOT NULL,
                `created_at` DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP,
                `updated_at` DATETIME DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP,
                PRIMARY KEY (`announcement_id`),
                FOREIGN KEY (`created_by`) REFERENCES `users`(`user_id`) ON DELETE CASCADE,
                INDEX `idx_created_at` (`created_at`)
            ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci");

            // Jobs
            $pdo->exec("CREATE TABLE IF NOT EXISTS `jobs` (
                `job_id` INT(11) NOT NULL AUTO_INCREMENT,
                `title` VARCHAR(255) NOT NULL,
                `company` VARCHAR(255) NOT NULL,
                `location` VARCHAR(255) DEFAULT NULL,
                `job_type` ENUM('full-time','part-time','contract','internship','remote') DEFAULT 'full-time',
                `description` TEXT NOT NULL,
                `requirements` TEXT DEFAULT NULL,
                `salary_range` VARCHAR(100) DEFAULT NULL,
                `apply_link` VARCHAR(500) DEFAULT NULL,
                `posted_by` INT(11) NOT NULL,
                `status` ENUM('open','closed') DEFAULT 'open',
                `created_at` DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP,
                `deadline` DATE DEFAULT NULL,
                PRIMARY KEY (`job_id`),
                FOREIGN KEY (`posted_by`) REFERENCES `users`(`user_id`) ON DELETE CASCADE,
                INDEX `idx_status` (`status`),
                INDEX `idx_created_at` (`created_at`)
            ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci");

            // Job applications
            $pdo->exec("CREATE TABLE IF NOT EXISTS `job_applications` (
                `application_id` INT(11) NOT NULL AUTO_INCREMENT,
                `job_id` INT(11) NOT NULL,
                `user_id` INT(11) NOT NULL,
                `cover_letter` TEXT DEFAULT NULL,
                `resume` VARCHAR(255) DEFAULT NULL,
                `status` ENUM('applied','shortlisted','rejected','hired') DEFAULT 'applied',
                `applied_at` DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP,
                PRIMARY KEY (`application_id`),
                UNIQUE KEY `uniq_job_user` (`job_id`,`user_id`),
                FOREIGN KEY (`job_id`) REFERENCES `jobs`(`job_id`) ON DELETE CASCADE,
                FOREIGN KEY (`user_id`) REFERENCES `users`(`user_id`) ON DELETE CASCADE
            ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci");

            // Alumni Honor Card applications
            $pdo->exec("CREATE TABLE IF NOT EXISTS `honor_card_applications` (
                `application_id` INT(11) NOT NULL AUTO_INCREMENT,
                `user_id` INT(11) DEFAULT NULL,
                `applicant_name` VARCHAR(255) DEFAULT NULL,
                `applicant_email` VARCHAR(255) DEFAULT NULL,
                `department` VARCHAR(100) DEFAULT NULL,
                `graduation_year` INT(4) DEFAULT NULL,
                `delivery_address` TEXT NOT NULL,
                `phone` VARCHAR(20) DEFAULT NULL,
                `notes` TEXT DEFAULT NULL,
                `status` ENUM('pending','approved','rejected','issued') DEFAULT 'pending',
                `admin_notes` TEXT DEFAULT NULL,
                `applied_at` DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP,
                `updated_at` DATETIME DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP,
                PRIMARY KEY (`application_id`),
                UNIQUE KEY `uniq_honor_card_user` (`user_id`),
                INDEX `idx_status` (`status`),
                FOREIGN KEY (`user_id`) REFERENCES `users`(`user_id`) ON DELETE CASCADE
            ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci");
            try { $pdo->exec("ALTER TABLE honor_card_applications MODIFY user_id INT(11) DEFAULT NULL"); } catch (Exception $e) {}
            try { $pdo->exec("ALTER TABLE honor_card_applications ADD COLUMN applicant_name VARCHAR(255) DEFAULT NULL AFTER user_id"); } catch (Exception $e) {}
            try { $pdo->exec("ALTER TABLE honor_card_applications ADD COLUMN applicant_email VARCHAR(255) DEFAULT NULL AFTER applicant_name"); } catch (Exception $e) {}
            try { $pdo->exec("ALTER TABLE honor_card_applications ADD COLUMN department VARCHAR(100) DEFAULT NULL AFTER applicant_email"); } catch (Exception $e) {}
            try { $pdo->exec("ALTER TABLE honor_card_applications ADD COLUMN graduation_year INT(4) DEFAULT NULL AFTER department"); } catch (Exception $e) {}

            // Mentorships - alumni offering to mentor + requests
            $pdo->exec("CREATE TABLE IF NOT EXISTS `mentorship_profiles` (
                `mentor_id` INT(11) NOT NULL AUTO_INCREMENT,
                `user_id` INT(11) NOT NULL UNIQUE,
                `expertise` VARCHAR(500) NOT NULL,
                `availability` VARCHAR(255) DEFAULT NULL,
                `bio` TEXT DEFAULT NULL,
                `is_active` TINYINT(1) DEFAULT 1,
                `approval_status` ENUM('pending','approved','rejected') DEFAULT 'pending',
                `admin_notes` TEXT DEFAULT NULL,
                `created_at` DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP,
                `updated_at` DATETIME DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP,
                PRIMARY KEY (`mentor_id`),
                FOREIGN KEY (`user_id`) REFERENCES `users`(`user_id`) ON DELETE CASCADE
            ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci");
            try { $pdo->exec("ALTER TABLE mentorship_profiles ADD COLUMN approval_status ENUM('pending','approved','rejected') DEFAULT 'pending' AFTER is_active"); } catch (Exception $e) {}
            try { $pdo->exec("ALTER TABLE mentorship_profiles ADD COLUMN admin_notes TEXT DEFAULT NULL AFTER approval_status"); } catch (Exception $e) {}
            try { $pdo->exec("ALTER TABLE mentorship_profiles ADD COLUMN updated_at DATETIME DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP AFTER created_at"); } catch (Exception $e) {}

            $pdo->exec("CREATE TABLE IF NOT EXISTS `mentorship_requests` (
                `request_id` INT(11) NOT NULL AUTO_INCREMENT,
                `mentor_user_id` INT(11) NOT NULL,
                `mentee_user_id` INT(11) NOT NULL,
                `message` TEXT DEFAULT NULL,
                `status` ENUM('pending','accepted','declined','completed') DEFAULT 'pending',
                `created_at` DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP,
                PRIMARY KEY (`request_id`),
                FOREIGN KEY (`mentor_user_id`) REFERENCES `users`(`user_id`) ON DELETE CASCADE,
                FOREIGN KEY (`mentee_user_id`) REFERENCES `users`(`user_id`) ON DELETE CASCADE
            ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci");

            // Messages (alumni-to-alumni)
            $pdo->exec("CREATE TABLE IF NOT EXISTS `messages` (
                `message_id` INT(11) NOT NULL AUTO_INCREMENT,
                `sender_id` INT(11) NOT NULL,
                `receiver_id` INT(11) NOT NULL,
                `body` TEXT NOT NULL,
                `is_read` TINYINT(1) DEFAULT 0,
                `created_at` DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP,
                PRIMARY KEY (`message_id`),
                FOREIGN KEY (`sender_id`) REFERENCES `users`(`user_id`) ON DELETE CASCADE,
                FOREIGN KEY (`receiver_id`) REFERENCES `users`(`user_id`) ON DELETE CASCADE,
                INDEX `idx_sender_receiver` (`sender_id`,`receiver_id`),
                INDEX `idx_created_at` (`created_at`)
            ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci");

            // Photo gallery (event-linked or general)
            $pdo->exec("CREATE TABLE IF NOT EXISTS `gallery` (
                `photo_id` INT(11) NOT NULL AUTO_INCREMENT,
                `event_id` INT(11) DEFAULT NULL,
                `title` VARCHAR(255) DEFAULT NULL,
                `image` VARCHAR(255) NOT NULL,
                `caption` TEXT DEFAULT NULL,
                `uploaded_by` INT(11) NOT NULL,
                `created_at` DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP,
                PRIMARY KEY (`photo_id`),
                FOREIGN KEY (`event_id`) REFERENCES `events`(`event_id`) ON DELETE SET NULL,
                FOREIGN KEY (`uploaded_by`) REFERENCES `users`(`user_id`) ON DELETE CASCADE
            ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci");

            // Newsletter subscriptions
            $pdo->exec("CREATE TABLE IF NOT EXISTS `newsletter_subscriptions` (
                `subscription_id` INT(11) NOT NULL AUTO_INCREMENT,
                `email` VARCHAR(255) NOT NULL UNIQUE,
                `name` VARCHAR(255) DEFAULT NULL,
                `is_active` TINYINT(1) DEFAULT 1,
                `subscribed_at` DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP,
                PRIMARY KEY (`subscription_id`)
            ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci");

            // Activity feed
            $pdo->exec("CREATE TABLE IF NOT EXISTS `activities` (
                `activity_id` INT(11) NOT NULL AUTO_INCREMENT,
                `user_id` INT(11) NOT NULL,
                `activity_type` VARCHAR(50) NOT NULL,
                `description` TEXT NOT NULL,
                `link` VARCHAR(500) DEFAULT NULL,
                `created_at` DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP,
                PRIMARY KEY (`activity_id`),
                FOREIGN KEY (`user_id`) REFERENCES `users`(`user_id`) ON DELETE CASCADE,
                INDEX `idx_created_at` (`created_at`),
                INDEX `idx_user_id` (`user_id`)
            ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci");

            // Achievement badges - definitions
            $pdo->exec("CREATE TABLE IF NOT EXISTS `badges` (
                `badge_id` INT(11) NOT NULL AUTO_INCREMENT,
                `name` VARCHAR(100) NOT NULL UNIQUE,
                `description` TEXT DEFAULT NULL,
                `icon` VARCHAR(255) DEFAULT NULL,
                `criteria` VARCHAR(255) DEFAULT NULL,
                PRIMARY KEY (`badge_id`)
            ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci");

            // User badges - earned
            $pdo->exec("CREATE TABLE IF NOT EXISTS `user_badges` (
                `user_badge_id` INT(11) NOT NULL AUTO_INCREMENT,
                `user_id` INT(11) NOT NULL,
                `badge_id` INT(11) NOT NULL,
                `awarded_at` DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP,
                PRIMARY KEY (`user_badge_id`),
                UNIQUE KEY `uniq_user_badge` (`user_id`,`badge_id`),
                FOREIGN KEY (`user_id`) REFERENCES `users`(`user_id`) ON DELETE CASCADE,
                FOREIGN KEY (`badge_id`) REFERENCES `badges`(`badge_id`) ON DELETE CASCADE
            ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci");

            // Career stories / Success spotlight
            $pdo->exec("CREATE TABLE IF NOT EXISTS `career_stories` (
                `story_id` INT(11) NOT NULL AUTO_INCREMENT,
                `user_id` INT(11) NOT NULL,
                `title` VARCHAR(255) NOT NULL,
                `story` TEXT NOT NULL,
                `image` VARCHAR(255) DEFAULT NULL,
                `is_featured` TINYINT(1) DEFAULT 0,
                `status` ENUM('pending','approved','rejected') DEFAULT 'pending',
                `created_at` DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP,
                PRIMARY KEY (`story_id`),
                FOREIGN KEY (`user_id`) REFERENCES `users`(`user_id`) ON DELETE CASCADE,
                INDEX `idx_status` (`status`),
                INDEX `idx_featured` (`is_featured`)
            ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci");

            // Seed default admin if none exists
            $checkAdmin = $pdo->query("SELECT COUNT(*) FROM users WHERE role = 'admin'")->fetchColumn();
            if ($checkAdmin == 0) {
                $defaultEmail = 'admin@uaf.edu.pk';
                $defaultPass = password_hash('admin123', PASSWORD_DEFAULT);
                $pdo->exec("INSERT INTO users (email, password, role, status) VALUES ('{$defaultEmail}', '{$defaultPass}', 'admin', 'active')");
                $adminUserId = $pdo->lastInsertId();
                $pdo->exec("INSERT INTO admin (user_id, name, email) VALUES ({$adminUserId}, 'Administrator', '{$defaultEmail}')");
            }

            // Seed default badges
            $checkBadges = $pdo->query("SELECT COUNT(*) FROM badges")->fetchColumn();
            if ($checkBadges == 0) {
                $pdo->exec("INSERT INTO badges (name, description, icon, criteria) VALUES
                    ('Pioneer', 'One of the first 50 alumni to register', 'ri-medal-line', 'first_50_register'),
                    ('Profile Complete', 'Filled all profile fields', 'ri-user-star-line', 'profile_complete'),
                    ('Event Enthusiast', 'Attended 3 or more events', 'ri-calendar-check-line', 'attended_3_events'),
                    ('Mentor', 'Registered as a mentor', 'ri-graduation-cap-line', 'is_mentor'),
                    ('Networker', 'Sent 10 or more messages', 'ri-chat-3-line', 'sent_10_messages'),
                    ('Storyteller', 'Published a career story', 'ri-book-open-line', 'published_story')");
            }

            return true;
        } catch(PDOException $exception) {
            error_log("Database initialization error: " . $exception->getMessage());
            return false;
        }
    }
}

