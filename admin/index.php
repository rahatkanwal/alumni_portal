<?php
/**
 * Main Entry Point - Router
 * University Alumni Portal
 */

session_start();

require_once __DIR__ . '/config/database.php';
require_once __DIR__ . '/includes/helpers.php';

$db = new Database();
$db->initializeDatabase();

$action = $_GET['action'] ?? 'login';
$method = $_SERVER['REQUEST_METHOD'];

switch ($action) {
    // --- Auth ---
    case 'register':
        require_once __DIR__ . '/controllers/RegisterController.php';
        $c = new RegisterController();
        $method === 'POST' ? $c->register() : $c->show();
        break;

    case 'login':
        require_once __DIR__ . '/controllers/LoginController.php';
        $c = new LoginController();
        $method === 'POST' ? $c->login() : $c->show();
        break;

    case 'logout':
        require_once __DIR__ . '/controllers/LoginController.php';
        (new LoginController())->logout();
        break;

    // --- Alumni Dashboard ---
    case 'dashboard':
        require_alumni();
        require_once __DIR__ . '/views/dashboard/alumni_dashboard.php';
        break;

    // --- Profile ---
    case 'profile':
        require_once __DIR__ . '/controllers/ProfileController.php';
        (new ProfileController())->show();
        break;
    case 'profile_edit':
        require_once __DIR__ . '/controllers/ProfileController.php';
        (new ProfileController())->edit();
        break;
    case 'profile_update':
        require_once __DIR__ . '/controllers/ProfileController.php';
        (new ProfileController())->update();
        break;

    // --- Admin ---
    case 'admin_dashboard':
        require_once __DIR__ . '/controllers/AdminController.php';
        (new AdminController())->dashboard();
        break;
    case 'admin_users':
        require_once __DIR__ . '/controllers/AdminController.php';
        (new AdminController())->users();
        break;
    case 'admin_user_action':
        require_once __DIR__ . '/controllers/AdminController.php';
        (new AdminController())->userAction();
        break;
    case 'admin_export':
        require_once __DIR__ . '/controllers/AdminController.php';
        (new AdminController())->exportCsv();
        break;
    case 'admin_analytics':
        require_once __DIR__ . '/controllers/AdminController.php';
        (new AdminController())->analytics();
        break;
    case 'admin_geocode_batch':
        require_once __DIR__ . '/controllers/AdminController.php';
        (new AdminController())->geocodeBatch();
        break;
    case 'admin_newsletter':
        require_once __DIR__ . '/controllers/NewsletterController.php';
        (new NewsletterController())->adminList();
        break;
    case 'admin_stories':
        require_once __DIR__ . '/controllers/CareerStoryController.php';
        (new CareerStoryController())->adminIndex();
        break;
    case 'admin_story_moderate':
        require_once __DIR__ . '/controllers/CareerStoryController.php';
        (new CareerStoryController())->adminModerate();
        break;

    // --- Alumni Directory ---
    case 'directory':
        require_once __DIR__ . '/controllers/DirectoryController.php';
        (new DirectoryController())->index();
        break;
    case 'directory_profile':
        require_once __DIR__ . '/controllers/DirectoryController.php';
        (new DirectoryController())->profile();
        break;
    case 'directory_map':
        require_once __DIR__ . '/controllers/DirectoryController.php';
        (new DirectoryController())->mapView();
        break;

    // --- Events ---
    case 'events':
        require_once __DIR__ . '/controllers/EventController.php';
        (new EventController())->index();
        break;
    case 'event_show':
        require_once __DIR__ . '/controllers/EventController.php';
        (new EventController())->show();
        break;
    case 'event_create':
        require_once __DIR__ . '/controllers/EventController.php';
        $c = new EventController();
        $method === 'POST' ? $c->store() : $c->create();
        break;
    case 'event_edit':
        require_once __DIR__ . '/controllers/EventController.php';
        $c = new EventController();
        $method === 'POST' ? $c->update() : $c->edit();
        break;
    case 'event_delete':
        require_once __DIR__ . '/controllers/EventController.php';
        (new EventController())->delete();
        break;
    case 'event_rsvp':
        require_once __DIR__ . '/controllers/EventController.php';
        (new EventController())->rsvp();
        break;

    // --- Announcements / News ---
    case 'news':
        require_once __DIR__ . '/controllers/AnnouncementController.php';
        (new AnnouncementController())->index();
        break;
    case 'news_show':
        require_once __DIR__ . '/controllers/AnnouncementController.php';
        (new AnnouncementController())->show();
        break;
    case 'news_create':
        require_once __DIR__ . '/controllers/AnnouncementController.php';
        $c = new AnnouncementController();
        $method === 'POST' ? $c->store() : $c->create();
        break;
    case 'news_edit':
        require_once __DIR__ . '/controllers/AnnouncementController.php';
        $c = new AnnouncementController();
        $method === 'POST' ? $c->update() : $c->edit();
        break;
    case 'news_delete':
        require_once __DIR__ . '/controllers/AnnouncementController.php';
        (new AnnouncementController())->delete();
        break;

    // --- Jobs ---
    case 'jobs':
        require_once __DIR__ . '/controllers/JobController.php';
        (new JobController())->index();
        break;
    case 'job_show':
        require_once __DIR__ . '/controllers/JobController.php';
        (new JobController())->show();
        break;
    case 'job_create':
        require_once __DIR__ . '/controllers/JobController.php';
        $c = new JobController();
        $method === 'POST' ? $c->store() : $c->create();
        break;
    case 'job_apply':
        require_once __DIR__ . '/controllers/JobController.php';
        (new JobController())->apply();
        break;
    case 'job_delete':
        require_once __DIR__ . '/controllers/JobController.php';
        (new JobController())->delete();
        break;

    // --- Alumni Honor Card ---
    case 'honor_card_apply':
        require_once __DIR__ . '/controllers/HonorCardController.php';
        (new HonorCardController())->applyForm();
        break;
    case 'honor_card_submit':
        require_once __DIR__ . '/controllers/HonorCardController.php';
        (new HonorCardController())->submit();
        break;
    case 'admin_honor_cards':
        require_once __DIR__ . '/controllers/HonorCardController.php';
        (new HonorCardController())->adminIndex();
        break;
    case 'admin_honor_card_update':
        require_once __DIR__ . '/controllers/HonorCardController.php';
        (new HonorCardController())->adminUpdate();
        break;

    // --- Mentorship ---
    case 'mentorship':
        require_once __DIR__ . '/controllers/MentorshipController.php';
        (new MentorshipController())->index();
        break;
    case 'mentorship_become':
        require_once __DIR__ . '/controllers/MentorshipController.php';
        (new MentorshipController())->become();
        break;
    case 'mentorship_request':
        require_once __DIR__ . '/controllers/MentorshipController.php';
        (new MentorshipController())->request();
        break;
    case 'mentorship_requests':
        require_once __DIR__ . '/controllers/MentorshipController.php';
        (new MentorshipController())->requests();
        break;
    case 'mentorship_respond':
        require_once __DIR__ . '/controllers/MentorshipController.php';
        (new MentorshipController())->respond();
        break;
    case 'admin_mentor_applications':
        require_once __DIR__ . '/controllers/MentorshipController.php';
        (new MentorshipController())->adminApplications();
        break;
    case 'admin_mentor_approve':
        require_once __DIR__ . '/controllers/MentorshipController.php';
        (new MentorshipController())->adminApprove();
        break;

    // --- Messages ---
    case 'messages':
        require_once __DIR__ . '/controllers/MessageController.php';
        (new MessageController())->inbox();
        break;
    case 'conversation':
        require_once __DIR__ . '/controllers/MessageController.php';
        (new MessageController())->conversation();
        break;
    case 'message_send':
        require_once __DIR__ . '/controllers/MessageController.php';
        (new MessageController())->send();
        break;

    // --- Gallery ---
    case 'gallery':
        require_once __DIR__ . '/controllers/GalleryController.php';
        (new GalleryController())->index();
        break;
    case 'gallery_upload':
        require_once __DIR__ . '/controllers/GalleryController.php';
        (new GalleryController())->upload();
        break;
    case 'gallery_delete':
        require_once __DIR__ . '/controllers/GalleryController.php';
        (new GalleryController())->delete();
        break;

    // --- Career Stories ---
    case 'stories':
        require_once __DIR__ . '/controllers/CareerStoryController.php';
        (new CareerStoryController())->index();
        break;
    case 'story_show':
        require_once __DIR__ . '/controllers/CareerStoryController.php';
        (new CareerStoryController())->show();
        break;
    case 'story_create':
        require_once __DIR__ . '/controllers/CareerStoryController.php';
        $c = new CareerStoryController();
        $method === 'POST' ? $c->store() : $c->create();
        break;

    // --- Badges ---
    case 'badges':
        require_once __DIR__ . '/controllers/BadgeController.php';
        (new BadgeController())->myBadges();
        break;

    // --- Activity Feed ---
    case 'activity':
        require_once __DIR__ . '/controllers/ActivityController.php';
        (new ActivityController())->feed();
        break;

    // --- Newsletter (public subscribe) ---
    case 'newsletter_subscribe':
        require_once __DIR__ . '/controllers/NewsletterController.php';
        (new NewsletterController())->subscribe();
        break;

    default:
        header('Location: index.php?action=login');
        exit;
}
