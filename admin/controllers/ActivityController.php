<?php
require_once __DIR__ . '/../includes/helpers.php';
require_once __DIR__ . '/../models/Activity.php';

class ActivityController {
    public function feed() {
        require_login();
        $model = new Activity();
        $activities = $model->getRecent(50);
        require __DIR__ . '/../views/activity/feed.php';
    }
}
