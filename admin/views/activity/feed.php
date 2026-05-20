<?php $pageTitle = 'Activity Feed'; ?>
<!DOCTYPE html>
<html lang="en">
<?php include __DIR__ . '/../shared/head.php'; ?>
<body class="bg-gray-50">
<?php include __DIR__ . '/../shared/sidebar.php'; ?>
<?php include __DIR__ . '/../shared/header.php'; ?>
<main class="lg:ml-64 pt-20 min-h-screen">
    <div class="p-6 max-w-3xl mx-auto">
        <h1 class="text-2xl font-bold mb-6">Recent Activity</h1>

        <div class="bg-white rounded-lg shadow-sm divide-y">
            <?php foreach ($activities as $a):
                $icon = [
                    'event_created' => 'ri-calendar-event-line',
                    'event_rsvp' => 'ri-check-line',
                    'announcement_created' => 'ri-article-line',
                    'job_posted' => 'ri-briefcase-line',
                    'job_applied' => 'ri-file-list-line',
                    'mentor_registered' => 'ri-graduation-cap-line',
                    'story_submitted' => 'ri-book-open-line',
                ][$a['activity_type']] ?? 'ri-pulse-line';
            ?>
                <div class="flex items-start space-x-3 p-4">
                    <?php $pic = !empty($a['profile_picture']) ? $a['profile_picture'] : 'assets/images/avatar-with-laptop.png'; ?>
                    <img src="<?= e($pic) ?>" class="w-10 h-10 rounded-full object-cover">
                    <div class="flex-1">
                        <p class="text-gray-800"><span class="font-semibold"><?= e($a['name'] ?? 'Someone') ?></span> <?= e($a['description']) ?></p>
                        <p class="text-xs text-gray-400 mt-1"><i class="<?= e($icon) ?>"></i> <?= date('M d, Y · g:i A', strtotime($a['created_at'])) ?></p>
                        <?php if ($a['link']): ?>
                            <a href="<?= e($a['link']) ?>" class="text-green-700 text-sm hover:underline">View →</a>
                        <?php endif; ?>
                    </div>
                </div>
            <?php endforeach; ?>
            <?php if (empty($activities)): ?>
                <div class="text-center py-12 text-gray-500">
                    <i class="ri-pulse-line text-5xl"></i>
                    <p class="mt-4">No activity yet.</p>
                </div>
            <?php endif; ?>
        </div>
    </div>
</main>
</body>
</html>
