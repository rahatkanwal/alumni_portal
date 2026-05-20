<?php $pageTitle = 'Admin Dashboard'; ?>
<!DOCTYPE html>
<html lang="en">
<?php include __DIR__ . '/../shared/head.php'; ?>
<body class="bg-gray-50">
<?php include __DIR__ . '/../shared/sidebar.php'; ?>
<?php include __DIR__ . '/../shared/header.php'; ?>
<main class="lg:ml-64 pt-20 min-h-screen">
    <div class="p-6">
        <?php include __DIR__ . '/../shared/flash.php'; ?>

        <div class="bg-gradient-to-r from-green-700 to-green-800 rounded-lg p-8 mb-6 text-white">
            <h1 class="text-3xl font-bold mb-2">Admin Dashboard</h1>
            <p class="text-green-100">Welcome back, <?= e($_SESSION['name']) ?>. Manage the alumni portal from here.</p>
        </div>

        <!-- Stats Grid -->
        <div class="grid grid-cols-2 md:grid-cols-4 lg:grid-cols-8 gap-4 mb-6">
            <?php
            $cards = [
                ['Total Alumni', $stats['total_alumni'], 'ri-group-line', 'bg-blue-100 text-blue-700'],
                ['All Events', $stats['total_events'], 'ri-calendar-line', 'bg-purple-100 text-purple-700'],
                ['Upcoming', $stats['upcoming_events'], 'ri-calendar-event-line', 'bg-green-100 text-green-700'],
                ['Announcements', $stats['total_announcements'], 'ri-article-line', 'bg-yellow-100 text-yellow-700'],
                ['Open Jobs', $stats['open_jobs'], 'ri-briefcase-line', 'bg-pink-100 text-pink-700'],
                ['Newsletter', $stats['newsletter_subs'], 'ri-mail-line', 'bg-indigo-100 text-indigo-700'],
                ['Honor Cards', $stats['honor_card_pending'], 'ri-bank-card-line', 'bg-emerald-100 text-emerald-700'],
                ['Mentors', $stats['mentor_pending'], 'ri-user-star-line', 'bg-orange-100 text-orange-700'],
            ];
            foreach ($cards as $c): ?>
                <div class="bg-white rounded-lg shadow-sm p-4">
                    <div class="flex items-center justify-between mb-2">
                        <div class="<?= $c[3] ?> p-2 rounded-lg"><i class="<?= $c[2] ?> text-xl"></i></div>
                    </div>
                    <p class="text-3xl font-bold text-gray-800"><?= e($c[1]) ?></p>
                    <p class="text-xs text-gray-500"><?= e($c[0]) ?></p>
                </div>
            <?php endforeach; ?>
        </div>

        <!-- Quick Actions -->
        <div class="grid grid-cols-2 md:grid-cols-3 lg:grid-cols-6 gap-4 mb-6">
            <a href="index.php?action=event_create" class="bg-white p-4 rounded-lg shadow-sm hover:shadow-md transition flex items-center space-x-3">
                <div class="bg-purple-100 text-purple-700 p-2 rounded-lg"><i class="ri-add-circle-line text-xl"></i></div>
                <span class="font-medium">New Event</span>
            </a>
            <a href="index.php?action=news_create" class="bg-white p-4 rounded-lg shadow-sm hover:shadow-md transition flex items-center space-x-3">
                <div class="bg-yellow-100 text-yellow-700 p-2 rounded-lg"><i class="ri-add-circle-line text-xl"></i></div>
                <span class="font-medium">Post News</span>
            </a>
            <a href="index.php?action=admin_analytics" class="bg-white p-4 rounded-lg shadow-sm hover:shadow-md transition flex items-center space-x-3">
                <div class="bg-blue-100 text-blue-700 p-2 rounded-lg"><i class="ri-bar-chart-line text-xl"></i></div>
                <span class="font-medium">Analytics</span>
            </a>
            <a href="index.php?action=admin_export" class="bg-white p-4 rounded-lg shadow-sm hover:shadow-md transition flex items-center space-x-3">
                <div class="bg-green-100 text-green-700 p-2 rounded-lg"><i class="ri-download-line text-xl"></i></div>
                <span class="font-medium">Export CSV</span>
            </a>
            <a href="index.php?action=admin_honor_cards" class="bg-white p-4 rounded-lg shadow-sm hover:shadow-md transition flex items-center space-x-3">
                <div class="bg-emerald-100 text-emerald-700 p-2 rounded-lg"><i class="ri-bank-card-line text-xl"></i></div>
                <span class="font-medium">Honor Cards</span>
            </a>
            <a href="index.php?action=admin_mentor_applications" class="bg-white p-4 rounded-lg shadow-sm hover:shadow-md transition flex items-center space-x-3">
                <div class="bg-orange-100 text-orange-700 p-2 rounded-lg"><i class="ri-user-star-line text-xl"></i></div>
                <span class="font-medium">Mentor Approvals</span>
            </a>
        </div>

        <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">
            <!-- Recent Alumni -->
            <div class="bg-white rounded-lg shadow-sm p-6">
                <div class="flex items-center justify-between mb-4">
                    <h3 class="font-bold text-gray-800">Recent Alumni</h3>
                    <a href="index.php?action=admin_users" class="text-sm text-green-700 hover:underline">View all</a>
                </div>
                <div class="space-y-3">
                    <?php foreach ($recentAlumni as $a): ?>
                        <div class="flex items-center space-x-3 p-2 hover:bg-gray-50 rounded">
                            <div class="w-10 h-10 bg-green-100 text-green-700 rounded-full flex items-center justify-center font-semibold">
                                <?= e(strtoupper(substr($a['name'], 0, 1))) ?>
                            </div>
                            <div class="flex-1">
                                <p class="font-medium text-gray-800"><?= e($a['name']) ?></p>
                                <p class="text-xs text-gray-500"><?= e($a['email']) ?> · <?= e($a['department'] ?? 'N/A') ?></p>
                            </div>
                        </div>
                    <?php endforeach; ?>
                    <?php if (empty($recentAlumni)): ?>
                        <p class="text-gray-500 text-sm">No alumni yet.</p>
                    <?php endif; ?>
                </div>
            </div>

            <!-- Upcoming Events -->
            <div class="bg-white rounded-lg shadow-sm p-6">
                <div class="flex items-center justify-between mb-4">
                    <h3 class="font-bold text-gray-800">Upcoming Events</h3>
                    <a href="index.php?action=events" class="text-sm text-green-700 hover:underline">View all</a>
                </div>
                <div class="space-y-3">
                    <?php foreach ($upcoming as $ev): ?>
                        <a href="index.php?action=event_show&id=<?= $ev['event_id'] ?>" class="flex items-start space-x-3 p-2 hover:bg-gray-50 rounded">
                            <div class="bg-purple-100 text-purple-700 px-3 py-2 rounded-lg text-center min-w-[60px]">
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
                        <p class="text-gray-500 text-sm">No upcoming events.</p>
                    <?php endif; ?>
                </div>
            </div>

            <!-- Recent Announcements -->
            <div class="bg-white rounded-lg shadow-sm p-6">
                <div class="flex items-center justify-between mb-4">
                    <h3 class="font-bold text-gray-800">Recent Announcements</h3>
                    <a href="index.php?action=news" class="text-sm text-green-700 hover:underline">View all</a>
                </div>
                <div class="space-y-3">
                    <?php foreach ($recentAnnouncements as $n): ?>
                        <a href="index.php?action=news_show&id=<?= $n['announcement_id'] ?>" class="block p-3 hover:bg-gray-50 rounded border border-gray-100">
                            <p class="font-medium text-gray-800"><?= e($n['title']) ?></p>
                            <p class="text-xs text-gray-500 mt-1"><?= date('M d, Y', strtotime($n['created_at'])) ?></p>
                        </a>
                    <?php endforeach; ?>
                    <?php if (empty($recentAnnouncements)): ?>
                        <p class="text-gray-500 text-sm">No announcements yet.</p>
                    <?php endif; ?>
                </div>
            </div>

            <!-- Recent Activity -->
            <div class="bg-white rounded-lg shadow-sm p-6">
                <div class="flex items-center justify-between mb-4">
                    <h3 class="font-bold text-gray-800">Recent Activity</h3>
                    <a href="index.php?action=activity" class="text-sm text-green-700 hover:underline">View feed</a>
                </div>
                <div class="space-y-3">
                    <?php foreach ($recentActivities as $a): ?>
                        <div class="flex items-start space-x-3 text-sm">
                            <div class="w-2 h-2 bg-green-600 rounded-full mt-2"></div>
                            <div class="flex-1">
                                <p class="text-gray-700"><span class="font-medium"><?= e($a['name'] ?: 'Someone') ?></span> · <?= e($a['description']) ?></p>
                                <p class="text-xs text-gray-400"><?= date('M d, H:i', strtotime($a['created_at'])) ?></p>
                            </div>
                        </div>
                    <?php endforeach; ?>
                    <?php if (empty($recentActivities)): ?>
                        <p class="text-gray-500 text-sm">No activity yet.</p>
                    <?php endif; ?>
                </div>
            </div>
        </div>
    </div>
</main>
</body>
</html>
