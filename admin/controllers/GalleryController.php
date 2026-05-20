<?php
require_once __DIR__ . '/../includes/helpers.php';
require_once __DIR__ . '/../models/Gallery.php';
require_once __DIR__ . '/../models/Event.php';

class GalleryController {
    private $model;
    public function __construct() { $this->model = new Gallery(); }

    public function index() {
        require_login();
        $eventId = !empty($_GET['event']) ? (int)$_GET['event'] : null;
        $photos = $this->model->getAll($eventId);
        $eventModel = new Event();
        $events = $eventModel->getAll();
        require __DIR__ . '/../views/gallery/index.php';
    }

    public function upload() {
        require_login();
        if (!csrf_check()) { header('Location: index.php?action=gallery'); exit; }
        if (empty($_FILES['image']['name'])) {
            flash('error', 'Please select an image.');
            header('Location: index.php?action=gallery');
            exit;
        }
        $dir = __DIR__ . '/../assets/images/gallery/';
        if (!is_dir($dir)) mkdir($dir, 0755, true);
        $ext = pathinfo($_FILES['image']['name'], PATHINFO_EXTENSION);
        $fname = 'g_' . time() . '_' . bin2hex(random_bytes(4)) . '.' . $ext;
        if (move_uploaded_file($_FILES['image']['tmp_name'], $dir . $fname)) {
            $this->model->add([
                'event_id' => !empty($_POST['event_id']) ? (int)$_POST['event_id'] : null,
                'title' => $_POST['title'] ?? null,
                'image' => 'assets/images/gallery/' . $fname,
                'caption' => $_POST['caption'] ?? null,
                'uploaded_by' => $_SESSION['user_id'],
            ]);
            flash('success', 'Photo uploaded.');
        }
        header('Location: index.php?action=gallery');
        exit;
    }

    public function delete() {
        require_login();
        if (!csrf_check()) { header('Location: index.php?action=gallery'); exit; }
        $id = (int)($_POST['photo_id'] ?? 0);
        $this->model->delete($id);
        header('Location: index.php?action=gallery');
        exit;
    }
}
