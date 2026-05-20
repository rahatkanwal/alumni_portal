<?php
require_once __DIR__ . '/../includes/helpers.php';
require_once __DIR__ . '/../models/HonorCardApplication.php';
require_once __DIR__ . '/../models/Alumni.php';

class HonorCardController {
    private $model;

    public function __construct() {
        $this->model = new HonorCardApplication();
    }

    public function applyForm() {
        $profile = null;
        $application = null;

        if (($_SESSION['role'] ?? '') === 'alumni' && !empty($_SESSION['user_id'])) {
            $alumniModel = new Alumni();
            $profile = $alumniModel->getByUserId($_SESSION['user_id']);
            $application = $this->model->getByUser($_SESSION['user_id']);
        }

        require __DIR__ . '/../views/honor_card/apply.php';
    }

    public function submit() {
        if (!csrf_check()) {
            flash('error', 'Invalid form request. Please try again.');
            header('Location: index.php?action=honor_card_apply');
            exit;
        }

        $name = trim($_POST['applicant_name'] ?? '');
        $email = trim($_POST['applicant_email'] ?? '');
        $deliveryAddress = trim($_POST['delivery_address'] ?? '');
        if ($name === '' || $email === '' || $deliveryAddress === '') {
            flash('error', 'Name, email, and delivery address are required.');
            header('Location: index.php?action=honor_card_apply');
            exit;
        }

        $data = [
            'applicant_name' => $name,
            'applicant_email' => $email,
            'department' => trim($_POST['department'] ?? ''),
            'graduation_year' => trim($_POST['graduation_year'] ?? ''),
            'delivery_address' => $deliveryAddress,
            'phone' => trim($_POST['phone'] ?? ''),
            'notes' => trim($_POST['notes'] ?? ''),
        ];

        if (($_SESSION['role'] ?? '') === 'alumni' && !empty($_SESSION['user_id'])) {
            $this->model->createOrUpdate($_SESSION['user_id'], $data);
            log_activity($_SESSION['user_id'], 'honor_card_applied', 'Applied for Alumni Honor Card', 'index.php?action=honor_card_apply');
        } else {
            $this->model->createGuest($data);
        }

        flash('success', 'Honor Card application submitted successfully.');
        header('Location: index.php?action=honor_card_apply');
        exit;
    }

    public function adminIndex() {
        require_admin();
        $applications = $this->model->getAll();
        require __DIR__ . '/../views/honor_card/admin_index.php';
    }

    public function adminUpdate() {
        require_admin();
        if ($_SERVER['REQUEST_METHOD'] !== 'POST' || !csrf_check()) {
            header('Location: index.php?action=admin_honor_cards');
            exit;
        }

        $applicationId = (int)($_POST['application_id'] ?? 0);
        $status = $_POST['status'] ?? 'pending';
        $notes = trim($_POST['admin_notes'] ?? '');

        if ($applicationId && $this->model->updateStatus($applicationId, $status, $notes)) {
            flash('success', 'Honor Card application updated.');
        } else {
            flash('error', 'Unable to update application.');
        }

        header('Location: index.php?action=admin_honor_cards');
        exit;
    }
}
