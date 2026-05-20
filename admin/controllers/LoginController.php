<?php
/**
 * Login Controller
 * Handles user login for both Alumni and Admin (FR02)
 */

require_once __DIR__ . '/../models/Alumni.php';
require_once __DIR__ . '/../models/Admin.php';

class LoginController {
    private $alumniModel;
    private $adminModel;

    public function __construct() {
        $this->alumniModel = new Alumni();
        $this->adminModel = new Admin();
    }

    /**
     * Show login form
     */
    public function show() {
        // Check if user is already logged in
        if (isset($_SESSION['user_id']) && isset($_SESSION['role'])) {
            // Only redirect if we have valid session data
            $this->redirectToDashboard();
            exit;
        }
        
        // Clear any invalid session data
        if (isset($_SESSION['user_id']) && !isset($_SESSION['role'])) {
            session_unset();
            session_destroy();
            session_start();
        }
        
        require_once __DIR__ . '/../views/auth/login.php';
    }

    /**
     * Handle login form submission
     */
    public function login() {
        $errors = [];

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $email = filter_var($_POST['email'] ?? '', FILTER_SANITIZE_EMAIL);
            $password = $_POST['password'] ?? '';

            // Validate input
            if (empty($email)) {
                $errors['email'] = 'Email is required';
            }

            if (empty($password)) {
                $errors['password'] = 'Password is required';
            }

            // If no validation errors, check credentials
            if (empty($errors)) {
                // Try to find user as Alumni first
                $user = $this->alumniModel->getByEmail($email);
                
                // If not found, try Admin
                if (!$user) {
                    $user = $this->adminModel->getByEmail($email);
                }

                // Verify password
                if ($user && password_verify($password, $user['password'])) {
                    // Check if account is active
                    if ($user['status'] !== 'active') {
                        $errors['general'] = 'Your account is inactive. Please contact administrator.';
                    } else {
                        // Create session
                        $_SESSION['user_id'] = $user['user_id'];
                        $_SESSION['email'] = $user['email'];
                        $_SESSION['role'] = $user['role'];
                        $_SESSION['name'] = $user['name'] ?? 'User';
                        
                        // Store additional info based on role
                        if ($user['role'] === 'alumni') {
                            $_SESSION['alumni_id'] = $user['alumni_id'] ?? null;
                        } elseif ($user['role'] === 'admin') {
                            $_SESSION['admin_id'] = $user['admin_id'] ?? null;
                        }

                        // Redirect to appropriate dashboard
                        $this->redirectToDashboard();
                        exit;
                    }
                } else {
                    $errors['general'] = 'Invalid email or password';
                }
            }
        }

        // Show form with errors
        $errors = $errors ?? [];
        require_once __DIR__ . '/../views/auth/login.php';
    }

    /**
     * Handle logout
     */
    public function logout() {
        // Destroy session
        session_unset();
        session_destroy();
        
        // Redirect to login
        header('Location: index.php?action=login');
        exit;
    }

    /**
     * Redirect to appropriate dashboard based on user role
     */
    private function redirectToDashboard() {
        if (isset($_SESSION['role']) && isset($_SESSION['user_id'])) {
            if ($_SESSION['role'] === 'admin') {
                header('Location: index.php?action=admin_dashboard');
            } else {
                header('Location: index.php?action=dashboard');
            }
        } else {
            // Clear invalid session and redirect to login
            session_unset();
            session_destroy();
            session_start();
            header('Location: index.php?action=login');
        }
        exit;
    }
}

