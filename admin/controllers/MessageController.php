<?php
require_once __DIR__ . '/../includes/helpers.php';
require_once __DIR__ . '/../models/Message.php';
require_once __DIR__ . '/../models/Alumni.php';

class MessageController {
    private $model;
    public function __construct() { $this->model = new Message(); }

    public function inbox() {
        require_login();
        $threads = $this->model->getInbox($_SESSION['user_id']);
        require __DIR__ . '/../views/messages/inbox.php';
    }

    public function conversation() {
        require_login();
        $partnerId = (int)($_GET['with'] ?? 0);
        if (!$partnerId) { header('Location: index.php?action=messages'); exit; }
        if ($partnerId === (int)$_SESSION['user_id']) {
            flash('error', "You can't chat with yourself.");
            header('Location: index.php?action=messages');
            exit;
        }
        // Works for both alumni and admin (and falls back gracefully for any user)
        $partner = get_user_display($partnerId);
        if (!$partner) {
            flash('error', 'User not found.');
            header('Location: index.php?action=messages');
            exit;
        }
        $messages = $this->model->getConversation($_SESSION['user_id'], $partnerId);
        $this->model->markRead($partnerId, $_SESSION['user_id']);
        require __DIR__ . '/../views/messages/conversation.php';
    }

    public function send() {
        require_login();
        if (!csrf_check()) { header('Location: index.php?action=messages'); exit; }
        $receiverId = (int)($_POST['receiver_id'] ?? 0);
        $body = trim($_POST['body'] ?? '');

        if (!$receiverId) {
            flash('error', 'Invalid recipient.');
            header('Location: index.php?action=messages');
            exit;
        }
        if ($receiverId === (int)$_SESSION['user_id']) {
            flash('error', "You can't message yourself.");
            header('Location: index.php?action=messages');
            exit;
        }
        if ($body === '') {
            header('Location: index.php?action=conversation&with=' . $receiverId);
            exit;
        }

        $this->model->send($_SESSION['user_id'], $receiverId, $body);
        $sent = $this->model->sentCount($_SESSION['user_id']);
        if ($sent >= 10) award_badge_if_eligible($_SESSION['user_id'], 'Networker');
        log_activity($_SESSION['user_id'], 'message_sent', 'sent a message');

        header('Location: index.php?action=conversation&with=' . $receiverId);
        exit;
    }
}
