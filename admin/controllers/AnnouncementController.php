<?php
require_once __DIR__ . '/../includes/helpers.php';
require_once __DIR__ . '/../models/Announcement.php';

class AnnouncementController {
    private $model;
    public function __construct() { $this->model = new Announcement(); }

    public function index() {
        require_login();
        $announcements = $this->model->getAll();
        require __DIR__ . '/../views/announcements/index.php';
    }

    public function show() {
        require_login();
        $id = (int)($_GET['id'] ?? 0);
        $announcement = $this->model->getById($id);
        if (!$announcement) { header('Location: index.php?action=news'); exit; }
        require __DIR__ . '/../views/announcements/show.php';
    }

    public function create() {
        require_admin();
        require __DIR__ . '/../views/announcements/form.php';
    }

    public function store() {
        require_admin();
        if (!csrf_check()) { header('Location: index.php?action=news_create'); exit; }
        $image = $this->handleUpload();
        $id = $this->model->create([
            'title' => $_POST['title'],
            'body' => $_POST['body'],
            'image' => $image,
            'created_by' => $_SESSION['user_id'],
        ]);
        log_activity($_SESSION['user_id'], 'announcement_created', "Posted news: " . $_POST['title']);
        flash('success', 'Announcement posted.');
        header('Location: index.php?action=news');
        exit;
    }

    public function edit() {
        require_admin();
        $id = (int)($_GET['id'] ?? 0);
        $announcement = $this->model->getById($id);
        if (!$announcement) { header('Location: index.php?action=news'); exit; }
        require __DIR__ . '/../views/announcements/form.php';
    }

    public function update() {
        require_admin();
        if (!csrf_check()) { header('Location: index.php?action=news'); exit; }
        $id = (int)($_POST['announcement_id'] ?? 0);
        $image = $this->handleUpload();
        $data = ['title' => $_POST['title'], 'body' => $_POST['body']];
        if ($image) $data['image'] = $image;
        $this->model->update($id, $data);
        flash('success', 'Announcement updated.');
        header('Location: index.php?action=news');
        exit;
    }

    public function delete() {
        require_admin();
        if (!csrf_check()) { header('Location: index.php?action=news'); exit; }
        $id = (int)($_POST['announcement_id'] ?? 0);
        $this->model->delete($id);
        flash('success', 'Announcement deleted.');
        header('Location: index.php?action=news');
        exit;
    }

    private function handleUpload() {
        if (empty($_FILES['image']['name'])) return null;
        $dir = __DIR__ . '/../assets/images/announcements/';
        if (!is_dir($dir)) mkdir($dir, 0755, true);
        $ext = pathinfo($_FILES['image']['name'], PATHINFO_EXTENSION);
        $fname = 'ann_' . time() . '_' . bin2hex(random_bytes(4)) . '.' . $ext;
        if (move_uploaded_file($_FILES['image']['tmp_name'], $dir . $fname)) {
            return 'assets/images/announcements/' . $fname;
        }
        return null;
    }
}
