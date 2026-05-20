<?php
require_once __DIR__ . '/../../includes/helpers.php';
require_once __DIR__ . '/../../models/Alumni.php';
require_once __DIR__ . '/../../models/Event.php';
require_once __DIR__ . '/../../models/Announcement.php';
require_once __DIR__ . '/../../models/Badge.php';
require_once __DIR__ . '/../../models/Job.php';
require_once __DIR__ . '/../../models/Message.php';

$pageTitle = 'Alumni Portal - Dashboard';
$alumniModel = new Alumni();
$myProfile = $alumniModel->getByUserId($_SESSION['user_id']);
$completeness = calc_profile_completeness($myProfile);

$eventModel = new Event();
$upcoming = $eventModel->getUpcoming(3);

$annModel = new Announcement();
$recentNews = $annModel->getRecent(3);

$badgeModel = new Badge();
$myBadges = $badgeModel->getByUser($_SESSION['user_id']);

$jobModel = new Job();
$openJobs = $jobModel->getAll();

$messageModel = new Message();
$unread = $messageModel->unreadCount($_SESSION['user_id']);
?>
<!DOCTYPE html>
<html lang="en" dir="ltr">
<?php include __DIR__ . '/../shared/head.php'; ?>
<body class="bg-gray-50">
    <?php include __DIR__ . '/../shared/sidebar.php'; ?>
    <?php include __DIR__ . '/../shared/header.php'; ?>

    <main class="lg:ml-64 pt-20 min-h-screen">
        <div class="p-6">
            <!-- Welcome Section -->
            <div class="bg-gradient-to-r from-green-700 to-green-800 rounded-lg p-6 mb-6 text-white">
                <h1 class="text-2xl md:text-3xl font-bold mb-1">
                    Good <?php $h = date('H'); echo $h<12 ? 'Morning' : ($h<17 ? 'Afternoon' : 'Evening'); ?>, <?= e($_SESSION['name'] ?? 'Alumni') ?>!
                </h1>
                <p class="text-green-100">Welcome back to your Alumni Portal.</p>

                <div class="mt-4 bg-white/10 rounded-lg p-4">
                    <div class="flex items-center justify-between mb-2">
                        <span class="text-sm">Profile <?= $completeness ?>% complete</span>
                        <?php if ($completeness < 100): ?><a href="index.php?action=profile_edit" class="text-xs underline">Complete now</a><?php endif; ?>
                    </div>
                    <div class="w-full bg-white/20 rounded-full h-2"><div class="h-2 bg-white rounded-full transition-all" style="width: <?= $completeness ?>%"></div></div>
                </div>
            </div>

            <!-- Quick stats -->
            <div class="grid grid-cols-2 md:grid-cols-4 gap-4 mb-6">
                <a href="index.php?action=directory" class="bg-white p-4 rounded-lg shadow-sm hover:shadow-md transition">
                    <div class="text-blue-700 mb-1"><i class="ri-group-line text-2xl"></i></div>
                    <p class="text-2xl font-bold"><?= $alumniModel->count() ?></p>
                    <p class="text-xs text-gray-500">Alumni</p>
                </a>
                <a href="index.php?action=events" class="bg-white p-4 rounded-lg shadow-sm hover:shadow-md transition">
                    <div class="text-purple-700 mb-1"><i class="ri-calendar-event-line text-2xl"></i></div>
                    <p class="text-2xl font-bold"><?= count($upcoming) ?></p>
                    <p class="text-xs text-gray-500">Upcoming Events</p>
                </a>
                <a href="index.php?action=jobs" class="bg-white p-4 rounded-lg shadow-sm hover:shadow-md transition">
                    <div class="text-pink-700 mb-1"><i class="ri-briefcase-line text-2xl"></i></div>
                    <p class="text-2xl font-bold"><?= count($openJobs) ?></p>
                    <p class="text-xs text-gray-500">Open Jobs</p>
                </a>
                <a href="index.php?action=messages" class="bg-white p-4 rounded-lg shadow-sm hover:shadow-md transition">
                    <div class="text-green-700 mb-1"><i class="ri-message-3-line text-2xl"></i></div>
                    <p class="text-2xl font-bold"><?= $unread ?></p>
                    <p class="text-xs text-gray-500">Unread Messages</p>
                </a>
            </div>

            <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
                <!-- Upcoming Events -->
                <div class="bg-white rounded-lg shadow-sm p-6 lg:col-span-2">
                    <div class="flex items-center justify-between mb-4">
                        <h3 class="font-bold text-gray-800">Upcoming Events</h3>
                        <a href="index.php?action=events" class="text-sm text-green-700 hover:underline">View all</a>
                    </div>
                    <div class="space-y-3">
                        <?php foreach ($upcoming as $ev): ?>
                            <a href="index.php?action=event_show&id=<?= $ev['event_id'] ?>" class="flex items-start space-x-3 p-3 hover:bg-gray-50 rounded border border-gray-100">
                                <div class="bg-purple-100 text-purple-700 px-3 py-2 rounded text-center min-w-[60px]">
                                    <p class="text-xs font-semibold"><?= date('M', strtotime($ev['event_date'])) ?></p>
                                    <p class="text-xl font-bold"><?= date('d', strtotime($ev['event_date'])) ?></p>
                                </div>
                                <div class="flex-1">
                                    <p class="font-medium text-gray-800"><?= e($ev['title']) ?></p>
                                    <p class="text-xs text-gray-500"><i class="ri-map-pin-line"></i> <?= e($ev['location'] ?: 'TBA') ?></p>
                                </div>
                            </a>
                        <?php endforeach; ?>
                        <?php if (empty($upcoming)): ?>
                            <p class="text-gray-500 text-sm">No upcoming events scheduled.</p>
                        <?php endif; ?>
                    </div>
                </div>

                <!-- My Badges -->
                <div class="bg-white rounded-lg shadow-sm p-6">
                    <div class="flex items-center justify-between mb-4">
                        <h3 class="font-bold text-gray-800">My Badges</h3>
                        <a href="index.php?action=badges" class="text-sm text-green-700 hover:underline">All</a>
                    </div>
                    <div class="grid grid-cols-3 gap-2">
                        <?php foreach (array_slice($myBadges, 0, 6) as $b): ?>
                            <div class="text-center p-2" title="<?= e($b['description']) ?>">
                                <div class="w-10 h-10 mx-auto bg-yellow-100 text-yellow-600 rounded-full flex items-center justify-center mb-1">
                                    <i class="<?= e($b['icon']) ?>"></i>
                                </div>
                                <p class="text-xs font-medium"><?= e($b['name']) ?></p>
                            </div>
                        <?php endforeach; ?>
                        <?php if (empty($myBadges)): ?>
                            <p class="col-span-3 text-gray-500 text-xs text-center py-3">No badges yet — keep engaging!</p>
                        <?php endif; ?>
                    </div>
                </div>

                <!-- Recent News -->
                <div class="bg-white rounded-lg shadow-sm p-6 lg:col-span-2">
                    <div class="flex items-center justify-between mb-4">
                        <h3 class="font-bold text-gray-800">Latest News</h3>
                        <a href="index.php?action=news" class="text-sm text-green-700 hover:underline">View all</a>
                    </div>
                    <div class="space-y-3">
                        <?php foreach ($recentNews as $n): ?>
                            <a href="index.php?action=news_show&id=<?= $n['announcement_id'] ?>" class="block p-3 hover:bg-gray-50 rounded border border-gray-100">
                                <p class="font-medium text-gray-800"><?= e($n['title']) ?></p>
                                <p class="text-sm text-gray-600 mt-1"><?= e(substr($n['body'], 0, 100)) ?>...</p>
                                <p class="text-xs text-gray-400 mt-1"><?= date('M d, Y', strtotime($n['created_at'])) ?></p>
                            </a>
                        <?php endforeach; ?>
                        <?php if (empty($recentNews)): ?>
                            <p class="text-gray-500 text-sm">No announcements yet.</p>
                        <?php endif; ?>
                    </div>
                </div>

                <!-- Quick Links -->
                <div class="bg-white rounded-lg shadow-sm p-6">
                    <h3 class="font-bold text-gray-800 mb-4">Quick Links</h3>
                    <div class="space-y-2">
                        <a href="index.php?action=mentorship" class="flex items-center space-x-3 p-2 hover:bg-gray-50 rounded">
                            <i class="ri-graduation-cap-line text-xl text-green-700"></i>
                            <span class="text-sm font-medium">Mentorship</span>
                        </a>
                        <a href="index.php?action=stories" class="flex items-center space-x-3 p-2 hover:bg-gray-50 rounded">
                            <i class="ri-book-open-line text-xl text-yellow-600"></i>
                            <span class="text-sm font-medium">Success Stories</span>
                        </a>
                        <a href="index.php?action=gallery" class="flex items-center space-x-3 p-2 hover:bg-gray-50 rounded">
                            <i class="ri-gallery-line text-xl text-pink-600"></i>
                            <span class="text-sm font-medium">Photo Gallery</span>
                        </a>
                        <a href="index.php?action=activity" class="flex items-center space-x-3 p-2 hover:bg-gray-50 rounded">
                            <i class="ri-pulse-line text-xl text-blue-600"></i>
                            <span class="text-sm font-medium">Activity Feed</span>
                        </a>
                        <a href="index.php?action=directory_map" class="flex items-center space-x-3 p-2 hover:bg-gray-50 rounded">
                            <i class="ri-map-pin-line text-xl text-red-600"></i>
                            <span class="text-sm font-medium">Alumni Map</span>
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </main>
</body>
</html>
