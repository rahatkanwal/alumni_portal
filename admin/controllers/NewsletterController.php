<?php
require_once __DIR__ . '/../includes/helpers.php';
require_once __DIR__ . '/../models/Newsletter.php';

class NewsletterController {
    private $model;
    public function __construct() { $this->model = new Newsletter(); }

    public function subscribe() {
        $email = trim($_POST['email'] ?? '');
        $name = trim($_POST['name'] ?? '');
        if (filter_var($email, FILTER_VALIDATE_EMAIL)) {
            $this->model->subscribe($email, $name ?: null);
            flash('success', 'Subscribed to newsletter!');
            send_notification_email($email, 'Welcome to UAF Alumni Newsletter', "<p>Hi " . e($name ?: 'there') . ",</p><p>Thanks for subscribing to the UAF Alumni Portal newsletter.</p>");
        } else {
            flash('error', 'Invalid email.');
        }
        $redirect = $_POST['redirect'] ?? '/alumni_portal/';
        header('Location: ' . $redirect);
        exit;
    }

    public function adminList() {
        require_admin();
        $subs = $this->model->getAll();
        require __DIR__ . '/../views/admin/newsletter.php';
    }
}
