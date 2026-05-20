<?php $pageTitle = $story['title']; ?>
<!DOCTYPE html>
<html lang="en">
<?php include __DIR__ . '/../shared/head.php'; ?>
<body class="bg-gray-50">
<?php include __DIR__ . '/../shared/sidebar.php'; ?>
<?php include __DIR__ . '/../shared/header.php'; ?>
<main class="lg:ml-64 pt-20 min-h-screen">
    <div class="p-6 max-w-3xl mx-auto">
        <a href="index.php?action=stories" class="text-green-700 hover:underline mb-4 inline-flex items-center"><i class="ri-arrow-left-line"></i> Back to Stories</a>
        <article class="bg-white rounded-lg shadow-sm overflow-hidden">
            <?php if (!empty($story['image'])): ?>
                <img src="<?= e($story['image']) ?>" class="w-full h-64 object-cover">
            <?php endif; ?>
            <div class="p-8">
                <h1 class="text-3xl font-bold text-gray-800 mb-4"><?= e($story['title']) ?></h1>
                <div class="flex items-center space-x-3 mb-6 pb-6 border-b">
                    <?php $pic = !empty($story['profile_picture']) ? $story['profile_picture'] : 'assets/images/avatar-with-laptop.png'; ?>
                    <img src="<?= e($pic) ?>" class="w-12 h-12 rounded-full">
                    <div>
                        <p class="font-bold"><?= e($story['name']) ?></p>
                        <p class="text-sm text-gray-500"><?= e($story['department'] ?: 'UAF') ?> · Class of <?= e($story['graduation_year'] ?: 'N/A') ?></p>
                    </div>
                </div>
                <div class="text-gray-700 whitespace-pre-line leading-relaxed"><?= e($story['story']) ?></div>
            </div>
        </article>
    </div>
</main>
</body>
</html>
