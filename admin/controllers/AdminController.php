<?php
require_once __DIR__ . '/../includes/helpers.php';
require_once __DIR__ . '/../models/Alumni.php';
require_once __DIR__ . '/../models/Event.php';
require_once __DIR__ . '/../models/Announcement.php';
require_once __DIR__ . '/../models/Job.php';
require_once __DIR__ . '/../models/Newsletter.php';
require_once __DIR__ . '/../models/Activity.php';
require_once __DIR__ . '/../models/HonorCardApplication.php';
require_once __DIR__ . '/../models/Mentorship.php';

class AdminController {

    public function dashboard() {
        require_admin();
        $alumniModel = new Alumni();
        $eventModel = new Event();
        $annModel = new Announcement();
        $jobModel = new Job();
        $newsletterModel = new Newsletter();
        $activityModel = new Activity();
        $honorCardModel = new HonorCardApplication();
        $mentorshipModel = new Mentorship();

        $stats = [
            'total_alumni' => $alumniModel->count(),
            'total_events' => count($eventModel->getAll()),
            'upcoming_events' => count($eventModel->getUpcoming(100)),
            'total_announcements' => count($annModel->getAll()),
            'open_jobs' => count($jobModel->getAll()),
            'newsletter_subs' => $newsletterModel->getActiveCount(),
            'honor_card_pending' => $honorCardModel->countByStatus('pending'),
            'mentor_pending' => $mentorshipModel->countByApprovalStatus('pending'),
        ];
        $recentAlumni = $alumniModel->getAll();
        $recentAlumni = array_slice($recentAlumni, 0, 5);
        $upcoming = $eventModel->getUpcoming(5);
        $recentAnnouncements = $annModel->getRecent(5);
        $recentActivities = $activityModel->getRecent(10);

        require __DIR__ . '/../views/admin/dashboard.php';
    }

    public function users() {
        require_admin();
        $alumniModel = new Alumni();
        $users = $alumniModel->getAll();
        require __DIR__ . '/../views/admin/users.php';
    }

    public function userAction() {
        require_admin();
        if ($_SERVER['REQUEST_METHOD'] !== 'POST' || !csrf_check()) {
            header('Location: index.php?action=admin_users');
            exit;
        }
        $alumniModel = new Alumni();
        $userId = (int)($_POST['user_id'] ?? 0);
        $op = $_POST['op'] ?? '';
        if ($userId && $userId !== (int)$_SESSION['user_id']) {
            if ($op === 'suspend') $alumniModel->setStatus($userId, 'suspended');
            elseif ($op === 'activate') $alumniModel->setStatus($userId, 'active');
            elseif ($op === 'delete') $alumniModel->delete($userId);
            flash('success', 'User updated successfully.');
        }
        header('Location: index.php?action=admin_users');
        exit;
    }

    public function exportCsv() {
        require_admin();
        $alumniModel = new Alumni();
        $alumni = $alumniModel->getAll();
        header('Content-Type: text/csv; charset=utf-8');
        header('Content-Disposition: attachment; filename=alumni_export_' . date('Y-m-d') . '.csv');
        $out = fopen('php://output', 'w');
        fputcsv($out, ['ID', 'Name', 'Email', 'Phone', 'Graduation Year', 'Department', 'Degree', 'Job', 'Company', 'Address']);
        foreach ($alumni as $a) {
            fputcsv($out, [
                $a['alumni_id'], $a['name'], $a['email'], $a['phone'],
                $a['graduation_year'], $a['department'], $a['degree'],
                $a['current_job'], $a['company'], $a['address']
            ]);
        }
        fclose($out);
        exit;
    }

    public function geocodeBatch() {
        require_admin();
        @set_time_limit(0);
        $alumniModel = new Alumni();
        $pending = $alumniModel->getNeedsGeocoding();

        $succeeded = 0;
        $failed = 0;
        $failedItems = [];

        foreach ($pending as $row) {
            $result = geocode_address($row['address']);
            if ($result) {
                $alumniModel->setCoordinates($row['user_id'], $result['lat'], $result['lng'], $row['address']);
                $succeeded++;
            } else {
                $failed++;
                $failedItems[] = $row;
            }
            // Respect Nominatim usage policy: max 1 request/second
            sleep(1);
        }

        $totalPending = count($pending);
        require __DIR__ . '/../views/admin/geocode_batch.php';
    }

    public function analytics() {
        require_admin();
        $alumniModel = new Alumni();
        $eventModel = new Event();
        $jobModel = new Job();
        $newsletterModel = new Newsletter();

        $byYear = $alumniModel->countByYear();
        $byDept = $alumniModel->countByDepartment();
        $totalAlumni = $alumniModel->count();
        $totalEvents = count($eventModel->getAll());
        $totalJobs = count($jobModel->getAll());
        $newsletterCount = $newsletterModel->getActiveCount();

        require __DIR__ . '/../views/admin/analytics.php';
    }
}
