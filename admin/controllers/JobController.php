<?php
require_once __DIR__ . '/../includes/helpers.php';
require_once __DIR__ . '/../models/Job.php';

class JobController {
    private $model;
    public function __construct() { $this->model = new Job(); }

    public function index() {
        require_login();
        $filters = [
            'keyword' => trim($_GET['q'] ?? ''),
            'job_type' => trim($_GET['type'] ?? ''),
        ];
        $jobs = $this->model->getAll($filters);
        require __DIR__ . '/../views/jobs/index.php';
    }

    public function show() {
        require_login();
        $id = (int)($_GET['id'] ?? 0);
        $job = $this->model->getById($id);
        if (!$job) { header('Location: index.php?action=jobs'); exit; }
        $hasApplied = $this->model->hasApplied($id, $_SESSION['user_id']);
        $applications = [];
        if ($_SESSION['role'] === 'admin' || $job['posted_by'] == $_SESSION['user_id']) {
            $applications = $this->model->getApplications($id);
        }
        require __DIR__ . '/../views/jobs/show.php';
    }

    public function create() {
        require_login();
        require __DIR__ . '/../views/jobs/form.php';
    }

    public function store() {
        require_login();
        if (!csrf_check()) { header('Location: index.php?action=job_create'); exit; }
        $data = [
            'title' => $_POST['title'],
            'company' => $_POST['company'],
            'location' => $_POST['location'] ?? null,
            'job_type' => $_POST['job_type'] ?? 'full-time',
            'description' => $_POST['description'],
            'requirements' => $_POST['requirements'] ?? null,
            'salary_range' => $_POST['salary_range'] ?? null,
            'apply_link' => $_POST['apply_link'] ?? null,
            'deadline' => $_POST['deadline'] ?? null,
            'posted_by' => $_SESSION['user_id'],
        ];
        $id = $this->model->create($data);
        log_activity($_SESSION['user_id'], 'job_posted', "Posted job: " . $data['title'], "index.php?action=job_show&id=$id");
        flash('success', 'Job posted.');
        header('Location: index.php?action=jobs');
        exit;
    }

    public function apply() {
        require_login();
        if (!csrf_check()) { header('Location: index.php?action=jobs'); exit; }
        $jobId = (int)($_POST['job_id'] ?? 0);
        $cover = trim($_POST['cover_letter'] ?? '');
        $resume = null;
        if (!empty($_FILES['resume']['name'])) {
            $dir = __DIR__ . '/../assets/uploads/resumes/';
            if (!is_dir($dir)) mkdir($dir, 0755, true);
            $ext = pathinfo($_FILES['resume']['name'], PATHINFO_EXTENSION);
            $fname = 'resume_' . $_SESSION['user_id'] . '_' . time() . '.' . $ext;
            if (move_uploaded_file($_FILES['resume']['tmp_name'], $dir . $fname)) {
                $resume = 'assets/uploads/resumes/' . $fname;
            }
        }
        $this->model->apply($jobId, $_SESSION['user_id'], $cover, $resume);
        log_activity($_SESSION['user_id'], 'job_applied', "Applied to a job");
        flash('success', 'Application submitted.');
        header('Location: index.php?action=job_show&id=' . $jobId);
        exit;
    }

    public function delete() {
        require_login();
        if (!csrf_check()) { header('Location: index.php?action=jobs'); exit; }
        $id = (int)($_POST['job_id'] ?? 0);
        $job = $this->model->getById($id);
        if ($job && ($_SESSION['role'] === 'admin' || $job['posted_by'] == $_SESSION['user_id'])) {
            $this->model->delete($id);
            flash('success', 'Job removed.');
        }
        header('Location: index.php?action=jobs');
        exit;
    }
}
