<?php
require_once __DIR__ . '/../includes/helpers.php';
require_once __DIR__ . '/../models/Mentorship.php';

class MentorshipController {
    private $model;
    public function __construct() { $this->model = new Mentorship(); }

    public function index() {
        require_login();
        $mentors = $this->model->getAllMentors();
        $myProfile = $this->model->getMentorProfile($_SESSION['user_id']);
        require __DIR__ . '/../views/mentorship/index.php';
    }

    public function become() {
        require_login();
        if (!csrf_check()) { header('Location: index.php?action=mentorship'); exit; }
        $this->model->becomeOrUpdateMentor(
            $_SESSION['user_id'],
            $_POST['expertise'] ?? '',
            $_POST['availability'] ?? '',
            $_POST['bio'] ?? ''
        );
        log_activity($_SESSION['user_id'], 'mentor_application_submitted', "Applied to become a mentor");
        flash('success', 'Mentor application submitted. It will show on the site after admin approval.');
        header('Location: index.php?action=mentorship');
        exit;
    }

    public function request() {
        require_login();
        if (!csrf_check()) { header('Location: index.php?action=mentorship'); exit; }
        $mentorId = (int)($_POST['mentor_user_id'] ?? 0);
        $message = trim($_POST['message'] ?? '');
        if ($mentorId && $mentorId !== (int)$_SESSION['user_id']) {
            if ($this->model->sendRequest($mentorId, $_SESSION['user_id'], $message)) {
                flash('success', 'Mentorship request sent.');
            } else {
                flash('error', 'This mentor is not available for requests.');
            }
        }
        header('Location: index.php?action=mentorship');
        exit;
    }

    public function requests() {
        require_login();
        $incoming = $this->model->getIncomingRequests($_SESSION['user_id']);
        $outgoing = $this->model->getOutgoingRequests($_SESSION['user_id']);
        require __DIR__ . '/../views/mentorship/requests.php';
    }

    public function respond() {
        require_login();
        if (!csrf_check()) { header('Location: index.php?action=mentorship_requests'); exit; }
        $reqId = (int)($_POST['request_id'] ?? 0);
        $status = $_POST['status'] ?? '';
        if (in_array($status, ['accepted', 'declined', 'completed'])) {
            $this->model->updateRequestStatus($reqId, $status, $_SESSION['user_id']);
            flash('success', 'Request ' . $status);
        }
        header('Location: index.php?action=mentorship_requests');
        exit;
    }

    public function adminApplications() {
        require_admin();
        $applications = $this->model->getAllMentorApplications();
        require __DIR__ . '/../views/mentorship/admin_applications.php';
    }

    public function adminApprove() {
        require_admin();
        if ($_SERVER['REQUEST_METHOD'] !== 'POST' || !csrf_check()) {
            header('Location: index.php?action=admin_mentor_applications');
            exit;
        }

        $mentorId = (int)($_POST['mentor_id'] ?? 0);
        $userId = (int)($_POST['user_id'] ?? 0);
        $status = $_POST['approval_status'] ?? 'pending';
        $notes = trim($_POST['admin_notes'] ?? '');

        if ($mentorId && $this->model->updateMentorApproval($mentorId, $status, $notes)) {
            if ($status === 'approved' && $userId) {
                award_badge_if_eligible($userId, 'Mentor');
                log_activity($userId, 'mentor_approved', 'Was approved as a mentor', 'index.php?action=mentorship');
            }
            flash('success', 'Mentor application updated.');
        } else {
            flash('error', 'Unable to update mentor application.');
        }

        header('Location: index.php?action=admin_mentor_applications');
        exit;
    }
}
