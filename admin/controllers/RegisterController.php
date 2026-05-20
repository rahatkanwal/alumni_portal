<?php
/**
 * Register Controller
 * Handles user registration (FR01)
 */

require_once __DIR__ . '/../models/Alumni.php';

class RegisterController {
    private $alumniModel;

    public function __construct() {
        $this->alumniModel = new Alumni();
    }

    /**
     * Show registration form
     */
    public function show() {
        // Check if user is already logged in
        if (isset($_SESSION['user_id'])) {
            header('Location: index.php?action=dashboard');
            exit;
        }
        
        require_once __DIR__ . '/../views/auth/register.php';
    }

    /**
     * Handle registration form submission
     */
    public function register() {
        $errors = [];
        $data = [];

        // Validate input
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            // Email validation
            if (empty($_POST['email'])) {
                $errors['email'] = 'Email is required';
            } elseif (!filter_var($_POST['email'], FILTER_VALIDATE_EMAIL)) {
                $errors['email'] = 'Invalid email format';
            } elseif ($this->alumniModel->emailExists($_POST['email'])) {
                $errors['email'] = 'Email already registered';
            } else {
                $data['email'] = filter_var($_POST['email'], FILTER_SANITIZE_EMAIL);
            }

            // Password validation
            if (empty($_POST['password'])) {
                $errors['password'] = 'Password is required';
            } elseif (strlen($_POST['password']) < 8) {
                $errors['password'] = 'Password must be at least 8 characters';
            } elseif ($_POST['password'] !== $_POST['confirm_password']) {
                $errors['confirm_password'] = 'Passwords do not match';
            } else {
                $data['password'] = $_POST['password'];
            }

            // Name validation
            if (empty($_POST['name'])) {
                $errors['name'] = 'Name is required';
            } else {
                $data['name'] = filter_var($_POST['name'], FILTER_SANITIZE_STRING);
            }

            // Optional fields
            $data['phone'] = !empty($_POST['phone']) ? filter_var($_POST['phone'], FILTER_SANITIZE_STRING) : null;
            $data['graduation_year'] = !empty($_POST['graduation_year']) ? (int)$_POST['graduation_year'] : null;
            $data['department'] = !empty($_POST['department']) ? filter_var($_POST['department'], FILTER_SANITIZE_STRING) : null;
            $data['degree'] = !empty($_POST['degree']) ? filter_var($_POST['degree'], FILTER_SANITIZE_STRING) : null;
            $data['current_job'] = !empty($_POST['current_job']) ? filter_var($_POST['current_job'], FILTER_SANITIZE_STRING) : null;
            $data['company'] = !empty($_POST['company']) ? filter_var($_POST['company'], FILTER_SANITIZE_STRING) : null;
            $data['address'] = !empty($_POST['address']) ? filter_var($_POST['address'], FILTER_SANITIZE_STRING) : null;
            $data['bio'] = !empty($_POST['bio']) ? filter_var($_POST['bio'], FILTER_SANITIZE_STRING) : null;
            $data['achievements'] = !empty($_POST['achievements']) ? filter_var($_POST['achievements'], FILTER_SANITIZE_STRING) : null;
            $data['skills'] = !empty($_POST['skills']) ? filter_var($_POST['skills'], FILTER_SANITIZE_STRING) : null;

            // If no errors, register user
            if (empty($errors)) {
                $result = $this->alumniModel->register($data);

                if ($result['success']) {
                    require_once __DIR__ . '/../includes/helpers.php';
                    // Award Pioneer badge to first 50 alumni
                    if ($this->alumniModel->count(false) <= 50) {
                        award_badge_if_eligible($result['user_id'], 'Pioneer');
                    }
                    log_activity($result['user_id'], 'registered', 'joined the alumni network');
                    send_notification_email($data['email'], 'Welcome to UAF Alumni Portal',
                        '<h2>Welcome ' . htmlspecialchars($data['name'] ?? '') . '!</h2><p>Your alumni account has been created. Login at <a href="http://localhost/alumni_portal/admin/index.php?action=login">the portal</a> to get started.</p>');

                    $_SESSION['success_message'] = 'Registration successful! Please login.';
                    header('Location: index.php?action=login');
                    exit;
                } else {
                    $errors['general'] = $result['error'] ?? 'Registration failed. Please try again.';
                }
            }
        }

        // Show form with errors
        $errors = $errors ?? [];
        require_once __DIR__ . '/../views/auth/register.php';
    }
}

