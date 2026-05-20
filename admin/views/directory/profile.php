<?php
$pageTitle = $profile['name'] . ' - Profile';
require_once __DIR__ . '/../../models/Badge.php';
$badgeModel = new Badge();
$userBadges = $badgeModel->getByUser($profile['user_id']);
?>
<!DOCTYPE html>
<html lang="en">
<?php include __DIR__ . '/../shared/head.php'; ?>
<body class="bg-gray-50">
<?php include __DIR__ . '/../shared/sidebar.php'; ?>
<?php include __DIR__ . '/../shared/header.php'; ?>
<main class="lg:ml-64 pt-20 min-h-screen">
    <div class="p-6 max-w-4xl mx-auto">
        <a href="index.php?action=directory" class="text-green-700 hover:underline mb-4 inline-flex items-center"><i class="ri-arrow-left-line"></i> Back to Directory</a>

        <div class="bg-white rounded-lg shadow-sm overflow-hidden">
            <div class="bg-gradient-to-r from-green-700 to-green-800 h-32"></div>
            <div class="px-6 pb-6">
                <?php $pic = !empty($profile['profile_picture']) ? $profile['profile_picture'] : 'assets/images/avatar-with-laptop.png'; ?>
                <img src="<?= e($pic) ?>" class="w-32 h-32 rounded-full border-4 border-white -mt-16 mb-4 object-cover" alt="">
                <div class="flex items-start justify-between flex-wrap">
                    <div>
                        <h1 class="text-2xl font-bold text-gray-800"><?= e($profile['name']) ?></h1>
                        <p class="text-gray-600"><?= e($profile['current_job'] ?: 'Alumni') ?> <?= $profile['company'] ? '@ ' . e($profile['company']) : '' ?></p>
                        <p class="text-sm text-gray-500 mt-1"><?= e($profile['department'] ?: '') ?> · Class of <?= e($profile['graduation_year'] ?: 'N/A') ?></p>
                    </div>
                    <?php if ($profile['user_id'] != $_SESSION['user_id']): ?>
                        <a href="index.php?action=conversation&with=<?= $profile['user_id'] ?>" class="bg-green-700 text-white px-4 py-2 rounded-lg hover:bg-green-800 flex items-center space-x-2">
                            <i class="ri-message-3-line"></i><span>Send Message</span>
                        </a>
                    <?php endif; ?>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mt-6">
                    <div class="space-y-3">
                        <div><i class="ri-mail-line text-gray-400"></i> <?= e($profile['email']) ?></div>
                        <?php if ($profile['phone']): ?><div><i class="ri-phone-line text-gray-400"></i> <?= e($profile['phone']) ?></div><?php endif; ?>
                        <?php if ($profile['address']): ?><div><i class="ri-map-pin-line text-gray-400"></i> <?= e($profile['address']) ?></div><?php endif; ?>
                        <?php if ($profile['degree']): ?><div><i class="ri-graduation-cap-line text-gray-400"></i> <?= e($profile['degree']) ?></div><?php endif; ?>
                    </div>
                    <div>
                        <?php if (!empty($userBadges)): ?>
                            <h3 class="font-bold mb-2">Achievements</h3>
                            <div class="flex flex-wrap gap-2">
                                <?php foreach ($userBadges as $b): ?>
                                    <span class="inline-flex items-center space-x-1 bg-yellow-50 text-yellow-700 px-2 py-1 rounded-full text-xs">
                                        <i class="<?= e($b['icon']) ?>"></i><span><?= e($b['name']) ?></span>
                                    </span>
                                <?php endforeach; ?>
                            </div>
                        <?php endif; ?>
                    </div>
                </div>

                <?php if ($profile['bio']): ?>
                    <div class="mt-6">
                        <h3 class="font-bold text-gray-800 mb-2">About</h3>
                        <p class="text-gray-600"><?= nl2br(e($profile['bio'])) ?></p>
                    </div>
                <?php endif; ?>

                <?php if ($profile['skills']): ?>
                    <div class="mt-6">
                        <h3 class="font-bold text-gray-800 mb-2">Skills</h3>
                        <div class="flex flex-wrap gap-2">
                            <?php foreach (explode(',', $profile['skills']) as $s): ?>
                                <span class="bg-gray-100 text-gray-700 px-3 py-1 rounded-full text-sm"><?= e(trim($s)) ?></span>
                            <?php endforeach; ?>
                        </div>
                    </div>
                <?php endif; ?>

                <?php if ($profile['achievements']): ?>
                    <div class="mt-6">
                        <h3 class="font-bold text-gray-800 mb-2">Achievements</h3>
                        <p class="text-gray-600"><?= nl2br(e($profile['achievements'])) ?></p>
                    </div>
                <?php endif; ?>
            </div>
        </div>
    </div>
</main>
</body>
</html>
