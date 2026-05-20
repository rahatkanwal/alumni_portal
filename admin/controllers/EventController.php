<?php
require_once __DIR__ . '/../includes/helpers.php';
require_once __DIR__ . '/../models/Event.php';

class EventController {
    private $model;
    public function __construct() { $this->model = new Event(); }

    public function index() {
        require_login();
        $events = $this->model->getAll();
        require __DIR__ . '/../views/events/index.php';
    }

    public function show() {
        require_login();
        $id = (int)($_GET['id'] ?? 0);
        $event = $this->model->getById($id);
        if (!$event) { flash('error', 'Event not found'); header('Location: index.php?action=events'); exit; }
        $rsvp = $this->model->getRsvp($id, $_SESSION['user_id']);
        $rsvpCount = $this->model->getRsvpCount($id);
        require __DIR__ . '/../views/events/show.php';
    }

    public function create() {
        require_admin();
        require __DIR__ . '/../views/events/form.php';
    }

    public function store() {
        require_admin();
        if (!csrf_check()) { header('Location: index.php?action=event_create'); exit; }
        $image = $this->handleUpload();
        $data = [
            'title' => $_POST['title'],
            'description' => $_POST['description'],
            'event_date' => $_POST['event_date'],
            'location' => $_POST['location'] ?? null,
            'category' => $_POST['category'] ?? 'general',
            'image' => $image,
            'created_by' => $_SESSION['user_id'],
            'latitude' => !empty($_POST['latitude']) ? (float)$_POST['latitude'] : null,
            'longitude' => !empty($_POST['longitude']) ? (float)$_POST['longitude'] : null,
        ];
        $id = $this->model->create($data);
        log_activity($_SESSION['user_id'], 'event_created', "Created event: {$data['title']}", "index.php?action=event_show&id=$id");
        flash('success', 'Event created.');
        header('Location: index.php?action=events');
        exit;
    }

    public function edit() {
        require_admin();
        $id = (int)($_GET['id'] ?? 0);
        $event = $this->model->getById($id);
        if (!$event) { header('Location: index.php?action=events'); exit; }
        require __DIR__ . '/../views/events/form.php';
    }

    public function update() {
        require_admin();
        if (!csrf_check()) { header('Location: index.php?action=events'); exit; }
        $id = (int)($_POST['event_id'] ?? 0);
        $image = $this->handleUpload();
        $data = [
            'title' => $_POST['title'],
            'description' => $_POST['description'],
            'event_date' => $_POST['event_date'],
            'location' => $_POST['location'] ?? null,
            'category' => $_POST['category'] ?? 'general',
            'latitude' => !empty($_POST['latitude']) ? (float)$_POST['latitude'] : null,
            'longitude' => !empty($_POST['longitude']) ? (float)$_POST['longitude'] : null,
        ];
        if ($image) $data['image'] = $image;
        $this->model->update($id, $data);
        flash('success', 'Event updated.');
        header('Location: index.php?action=events');
        exit;
    }

    public function delete() {
        require_admin();
        if (!csrf_check()) { header('Location: index.php?action=events'); exit; }
        $id = (int)($_POST['event_id'] ?? 0);
        $this->model->delete($id);
        flash('success', 'Event deleted.');
        header('Location: index.php?action=events');
        exit;
    }

    public function rsvp() {
        require_login();
        if (!csrf_check()) { header('Location: index.php?action=events'); exit; }
        $eventId = (int)($_POST['event_id'] ?? 0);
        $status = $_POST['status'] ?? 'going';
        $this->model->rsvp($eventId, $_SESSION['user_id'], $status);
        $attendCount = $this->model->getAttendeeCount($_SESSION['user_id']);
        if ($attendCount >= 3) award_badge_if_eligible($_SESSION['user_id'], 'Event Enthusiast');
        log_activity($_SESSION['user_id'], 'event_rsvp', "RSVP'd to an event");
        flash('success', 'RSVP recorded.');
        header('Location: index.php?action=event_show&id=' . $eventId);
        exit;
    }

    private function handleUpload() {
        if (empty($_FILES['image']['name'])) return null;
        $dir = __DIR__ . '/../assets/images/events/';
        if (!is_dir($dir)) mkdir($dir, 0755, true);
        $ext = pathinfo($_FILES['image']['name'], PATHINFO_EXTENSION);
        $fname = 'event_' . time() . '_' . bin2hex(random_bytes(4)) . '.' . $ext;
        if (move_uploaded_file($_FILES['image']['tmp_name'], $dir . $fname)) {
            return 'assets/images/events/' . $fname;
        }
        return null;
    }
}
