<?php
require_once __DIR__ . '/../includes/helpers.php';
require_once __DIR__ . '/../models/Badge.php';

class BadgeController {
    private $model;
    public function __construct() { $this->model = new Badge(); }

    public function myBadges() {
        require_login();
        $badges = $this->model->getByUser($_SESSION['user_id']);
        $allBadges = $this->model->getAll();
        require __DIR__ . '/../views/badges/index.php';
    }
}
