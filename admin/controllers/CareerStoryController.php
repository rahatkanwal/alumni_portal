<?php
require_once __DIR__ . '/../includes/helpers.php';
require_once __DIR__ . '/../models/CareerStory.php';

class CareerStoryController {
    private $model;
    public function __construct() { $this->model = new CareerStory(); }

    public function index() {
        $stories = $this->model->getAllApproved();
        require __DIR__ . '/../views/stories/index.php';
    }

    public function show() {
        $id = (int)($_GET['id'] ?? 0);
        $story = $this->model->getById($id);
        if (!$story || $story['status'] !== 'approved') {
            header('Location: index.php?action=stories'); exit;
        }
        require __DIR__ . '/../views/stories/show.php';
    }

    public function create() {
        require_login();
        require __DIR__ . '/../views/stories/form.php';
    }

    public function store() {
        require_login();
        if (!csrf_check()) { header('Location: index.php?action=story_create'); exit; }
        $image = null;
        if (!empty($_FILES['image']['name'])) {
            $dir = __DIR__ . '/../assets/images/stories/';
            if (!is_dir($dir)) mkdir($dir, 0755, true);
            $ext = pathinfo($_FILES['image']['name'], PATHINFO_EXTENSION);
            $fname = 's_' . time() . '_' . bin2hex(random_bytes(4)) . '.' . $ext;
            if (move_uploaded_file($_FILES['image']['tmp_name'], $dir . $fname)) {
                $image = 'assets/images/stories/' . $fname;
            }
        }
        $this->model->create([
            'user_id' => $_SESSION['user_id'],
            'title' => $_POST['title'],
            'story' => $_POST['story'],
            'image' => $image,
        ]);
        award_badge_if_eligible($_SESSION['user_id'], 'Storyteller');
        log_activity($_SESSION['user_id'], 'story_submitted', "Submitted a career story");
        flash('success', 'Story submitted! Awaiting admin approval.');
        header('Location: index.php?action=stories');
        exit;
    }

    public function adminIndex() {
        require_admin();
        $stories = $this->model->getAll();
        require __DIR__ . '/../views/admin/stories.php';
    }

    public function adminModerate() {
        require_admin();
        if (!csrf_check()) { header('Location: index.php?action=admin_stories'); exit; }
        $id = (int)($_POST['story_id'] ?? 0);
        $status = $_POST['status'] ?? 'pending';
        $featured = isset($_POST['featured']) ? 1 : 0;
        $this->model->updateStatus($id, $status, $featured);
        flash('success', 'Story updated.');
        header('Location: index.php?action=admin_stories');
        exit;
    }
}
