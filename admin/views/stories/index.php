<?php $pageTitle = 'Success Stories'; ?>
<!DOCTYPE html>
<html lang="en">
<?php include __DIR__ . '/../shared/head.php'; ?>
<body class="bg-gray-50">
<?php include __DIR__ . '/../shared/sidebar.php'; ?>
<?php include __DIR__ . '/../shared/header.php'; ?>
<main class="lg:ml-64 pt-20 min-h-screen">
    <div class="p-6 max-w-5xl mx-auto">
        <?php include __DIR__ . '/../shared/flash.php'; ?>
        <div class="flex items-center justify-between mb-6">
            <div>
                <h1 class="text-2xl font-bold text-gray-800">Success Stories</h1>
                <p class="text-gray-500">Inspirational stories from UAF alumni</p>
            </div>
            <?php if (isset($_SESSION['user_id'])): ?>
                <a href="index.php?action=story_create" class="bg-green-700 text-white px-4 py-2 rounded-lg hover:bg-green-800 flex items-center space-x-2">
                    <i class="ri-add-line"></i><span>Share My Story</span>
                </a>
            <?php endif; ?>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
            <?php foreach ($stories as $s): ?>
                <a href="index.php?action=story_show&id=<?= $s['story_id'] ?>" class="bg-white rounded-lg shadow-sm overflow-hidden hover:shadow-md transition block">
                    <?php if (!empty($s['image'])): ?>
                        <img src="<?= e($s['image']) ?>" class="w-full h-48 object-cover">
                    <?php endif; ?>
                    <div class="p-5">
                        <?php if ($s['is_featured']): ?>
                            <span class="inline-block text-xs bg-yellow-100 text-yellow-700 px-2 py-1 rounded-full mb-2"><i class="ri-star-fill"></i> Featured</span>
                        <?php endif; ?>
                        <h3 class="font-bold text-lg text-gray-800 mb-2"><?= e($s['title']) ?></h3>
                        <p class="text-gray-600 text-sm mb-3"><?= e(substr($s['story'], 0, 150)) ?>...</p>
                        <div class="flex items-center space-x-2 text-sm text-gray-500">
                            <?php $pic = !empty($s['profile_picture']) ? $s['profile_picture'] : 'assets/images/avatar-with-laptop.png'; ?>
                            <img src="<?= e($pic) ?>" class="w-8 h-8 rounded-full">
                            <span><?= e($s['name']) ?> · <?= e($s['department'] ?: 'UAF') ?>, '<?= e(substr($s['graduation_year'] ?? '', -2)) ?></span>
                        </div>
                    </div>
                </a>
            <?php endforeach; ?>
            <?php if (empty($stories)): ?>
                <div class="col-span-full text-center py-12 text-gray-500">
                    <i class="ri-book-open-line text-5xl"></i>
                    <p class="mt-4">No stories yet. <a href="index.php?action=story_create" class="text-green-700 hover:underline">Share yours</a>!</p>
                </div>
            <?php endif; ?>
        </div>
    </div>
</main>
</body>
</html>
