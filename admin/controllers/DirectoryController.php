<?php
require_once __DIR__ . '/../includes/helpers.php';
require_once __DIR__ . '/../models/Alumni.php';

class DirectoryController {
    public function index() {
        require_login();
        $alumniModel = new Alumni();
        $filters = [
            'name' => trim($_GET['name'] ?? ''),
            'department' => trim($_GET['department'] ?? ''),
            'graduation_year' => trim($_GET['graduation_year'] ?? ''),
        ];
        $alumni = $alumniModel->getAll($filters);
        $departments = $alumniModel->getDepartments();
        $years = $alumniModel->getGraduationYears();
        require __DIR__ . '/../views/directory/index.php';
    }

    public function profile() {
        require_login();
        $userId = (int)($_GET['id'] ?? 0);
        $alumniModel = new Alumni();
        $profile = $alumniModel->getByUserId($userId);
        if (!$profile) {
            flash('error', 'Alumni not found.');
            header('Location: index.php?action=directory');
            exit;
        }
        require __DIR__ . '/../views/directory/profile.php';
    }

    public function mapView() {
        require_login();
        $alumniModel = new Alumni();
        $alumni = $alumniModel->getAll();
        require __DIR__ . '/../views/directory/map.php';
    }
}
