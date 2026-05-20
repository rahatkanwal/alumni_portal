<?php $pageTitle = 'My Achievements'; ?>
<!DOCTYPE html>
<html lang="en">
<?php include __DIR__ . '/../shared/head.php'; ?>
<body class="bg-gray-50">
<?php include __DIR__ . '/../shared/sidebar.php'; ?>
<?php include __DIR__ . '/../shared/header.php'; ?>
<main class="lg:ml-64 pt-20 min-h-screen">
    <div class="p-6 max-w-4xl mx-auto">
        <h1 class="text-2xl font-bold mb-2">My Achievements</h1>
        <p class="text-gray-500 mb-6"><?= count($badges) ?> of <?= count($allBadges) ?> badges earned</p>

        <h3 class="font-bold mb-3">Earned Badges</h3>
        <div class="grid grid-cols-2 md:grid-cols-4 gap-4 mb-8">
            <?php foreach ($badges as $b): ?>
                <div class="bg-white rounded-lg shadow-sm p-5 text-center">
                    <div class="w-16 h-16 mx-auto bg-yellow-100 text-yellow-600 rounded-full flex items-center justify-center mb-3">
                        <i class="<?= e($b['icon']) ?> text-3xl"></i>
                    </div>
                    <p class="font-bold text-gray-800"><?= e($b['name']) ?></p>
                    <p class="text-xs text-gray-500 mt-1"><?= e($b['description']) ?></p>
                    <p class="text-xs text-gray-400 mt-2">Earned <?= date('M d, Y', strtotime($b['awarded_at'])) ?></p>
                </div>
            <?php endforeach; ?>
            <?php if (empty($badges)): ?>
                <p class="col-span-full text-gray-500 text-sm">No badges earned yet. Keep engaging with the community!</p>
            <?php endif; ?>
        </div>

        <h3 class="font-bold mb-3">Available Badges</h3>
        <div class="grid grid-cols-2 md:grid-cols-3 gap-4">
            <?php
            $earnedIds = array_column($badges, 'badge_id');
            foreach ($allBadges as $b):
                if (in_array($b['badge_id'], $earnedIds)) continue;
            ?>
                <div class="bg-white rounded-lg shadow-sm p-4 opacity-60">
                    <div class="flex items-center space-x-3">
                        <div class="w-12 h-12 bg-gray-100 text-gray-400 rounded-full flex items-center justify-center">
                            <i class="<?= e($b['icon']) ?> text-2xl"></i>
                        </div>
                        <div>
                            <p class="font-semibold text-gray-700"><?= e($b['name']) ?></p>
                            <p class="text-xs text-gray-500"><?= e($b['description']) ?></p>
                        </div>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>
    </div>
</main>
</body>
</html>
