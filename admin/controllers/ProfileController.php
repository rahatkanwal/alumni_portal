<?php
/**
 * Profile Controller
 * Handles alumni profile management (FR03)
 */

require_once __DIR__ . '/../models/Alumni.php';
require_once __DIR__ . '/../includes/helpers.php';

class ProfileController {
    private $alumniModel;

    public function __construct() {
        $this->alumniModel = new Alumni();
    }

    /**
     * Show profile
     */
    public function show() {
        // Check if user is logged in
        if (!isset($_SESSION['user_id']) || $_SESSION['role'] !== 'alumni') {
            header('Location: index.php?action=login');
            exit;
        }

        $profile = $this->alumniModel->getByUserId($_SESSION['user_id']);
        
        if (!$profile) {
            $_SESSION['error_message'] = 'Profile not found';
            header('Location: index.php?action=dashboard');
            exit;
        }

        require_once __DIR__ . '/../views/profile/view.php';
    }

    /**
     * Show edit profile form
     */
    public function edit() {
        // Check if user is logged in
        if (!isset($_SESSION['user_id']) || $_SESSION['role'] !== 'alumni') {
            header('Location: index.php?action=login');
            exit;
        }

        $profile = $this->alumniModel->getByUserId($_SESSION['user_id']);
        
        if (!$profile) {
            $_SESSION['error_message'] = 'Profile not found';
            header('Location: index.php?action=dashboard');
            exit;
        }

        require_once __DIR__ . '/../views/profile/edit.php';
    }

    /**
     * Handle profile update
     */
    public function update() {
        // Check if user is logged in
        if (!isset($_SESSION['user_id']) || $_SESSION['role'] !== 'alumni') {
            header('Location: index.php?action=login');
            exit;
        }

        $errors = [];
        $data = [];

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            // Validate required fields
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

            // Handle profile picture upload
            if (isset($_FILES['profile_picture']) && $_FILES['profile_picture']['error'] === UPLOAD_ERR_OK) {
                $uploadResult = $this->handleFileUpload($_FILES['profile_picture']);
                if ($uploadResult['success']) {
                    $data['profile_picture'] = $uploadResult['file_path'];
                } else {
                    $errors['profile_picture'] = $uploadResult['error'];
                }
            }

            // If no errors, update profile
            if (empty($errors)) {
                if ($this->alumniModel->updateProfile($_SESSION['user_id'], $data)) {
                    // Geocode address if it changed
                    $this->maybeGeocode($_SESSION['user_id'], $data['address']);

                    $_SESSION['success_message'] = 'Profile updated successfully!';
                    header('Location: index.php?action=profile');
                    exit;
                } else {
                    $errors['general'] = 'Failed to update profile. Please try again.';
                }
            }
        }

        // Get profile data for form
        $profile = $this->alumniModel->getByUserId($_SESSION['user_id']);
        require_once __DIR__ . '/../views/profile/edit.php';
    }

    /**
     * Handle file upload
     * @param array $file
     * @return array
     */
    private function handleFileUpload($file) {
        $uploadDir = __DIR__ . '/../assets/images/profiles/';
        
        // Create directory if it doesn't exist
        if (!is_dir($uploadDir)) {
            mkdir($uploadDir, 0755, true);
        }

        // Validate file type
        $allowedTypes = ['image/jpeg', 'image/jpg', 'image/png', 'image/gif'];
        $fileType = $file['type'];
        
        if (!in_array($fileType, $allowedTypes)) {
            return ['success' => false, 'error' => 'Invalid file type. Only JPG, PNG, and GIF are allowed.'];
        }

        // Validate file size (max 5MB)
        $maxSize = 5 * 1024 * 1024; // 5MB
        if ($file['size'] > $maxSize) {
            return ['success' => false, 'error' => 'File size exceeds 5MB limit.'];
        }

        // Generate unique filename
        $extension = pathinfo($file['name'], PATHINFO_EXTENSION);
        $filename = 'profile_' . $_SESSION['user_id'] . '_' . time() . '.' . $extension;
        $filePath = $uploadDir . $filename;

        // Move uploaded file
        if (move_uploaded_file($file['tmp_name'], $filePath)) {
            // Return relative path
            return [
                'success' => true,
                'file_path' => 'assets/images/profiles/' . $filename
            ];
        } else {
            return ['success' => false, 'error' => 'Failed to upload file.'];
        }
    }

    /**
     * Geocode the address only if it changed from the last-geocoded value.
     * Saves lat/lng to the alumni row. Clears coords when address is removed.
     */
    private function maybeGeocode($userId, $address) {
        $profile = $this->alumniModel->getByUserId($userId);
        $currentGeocoded = $profile['geocoded_address'] ?? '';

        // Address cleared → wipe coords
        if (empty($address)) {
            if (!empty($profile['latitude'])) {
                $this->alumniModel->clearCoordinates($userId);
            }
            return;
        }

        // Already geocoded with same address → skip API call
        if ($currentGeocoded === $address) {
            return;
        }

        // Geocode and persist
        $result = geocode_address($address);
        if ($result) {
            $this->alumniModel->setCoordinates($userId, $result['lat'], $result['lng'], $address);
        }
        // If geocoding fails, we leave coords as-is (silent failure — error is logged)
    }
}

