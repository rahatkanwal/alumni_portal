<?php
/**
 * Success Stories Page - Public listing of approved alumni career stories
 */
require_once __DIR__ . '/includes/public_data.php';
$stories = public_get_stories();
?>
<!DOCTYPE html>
<html lang="en" dir="ltr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Success Stories - Alumni Portal - University of Agriculture Faisalabad</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800;900&display=swap" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/remixicon@3.5.0/fonts/remixicon.css" rel="stylesheet">
    <style>
        :root { --primary-green: #1a5f3f; }
        body { font-family: 'Inter', sans-serif; }
    </style>
</head>
<body class="bg-white">
    <?php include 'includes/header.php'; ?>

    <main>
        <!-- Hero -->
        <section class="relative h-[50vh] w-full overflow-hidden">
            <img src="admin/assets/images/events/slide4.svg" alt="Success Stories" class="w-full h-full object-cover">
            <div class="absolute inset-0 bg-black/40 flex items-center justify-center">
                <div class="text-center text-white px-4">
                    <h1 class="text-5xl md:text-6xl font-bold mb-3">Success Stories</h1>
                    <p class="text-lg md:text-xl text-green-100">Inspirational journeys from UAF alumni making impact worldwide</p>
                </div>
            </div>
        </section>

        <!-- Stories Grid -->
        <section class="py-16 bg-gray-50">
            <div class="container mx-auto px-4">
                <div class="max-w-6xl mx-auto">
                    <?php if (!empty($stories)): ?>
                        <p class="text-gray-600 mb-8"><?= count($stories) ?> alumni stor<?= count($stories) === 1 ? 'y' : 'ies' ?> · Want to share yours? <a href="admin/index.php?action=story_create" class="text-green-700 hover:underline font-medium">Submit your story</a></p>
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
                            <?php foreach ($stories as $s): ?>
                                <a href="admin/index.php?action=story_show&id=<?= $s['story_id'] ?>" class="bg-white rounded-lg shadow-md overflow-hidden hover:shadow-xl transition block">
                                    <?php if (!empty($s['image'])): ?>
                                        <img src="<?= e(public_asset($s['image'])) ?>" alt="<?= e($s['title']) ?>" class="w-full h-56 object-cover">
                                    <?php else: ?>
                                        <div class="h-56 bg-gradient-to-br from-green-600 to-green-800 flex items-center justify-center">
                                            <i class="ri-book-open-line text-white text-7xl"></i>
                                        </div>
                                    <?php endif; ?>
                                    <div class="p-6">
                                        <?php if ($s['is_featured']): ?>
                                            <span class="inline-block bg-yellow-100 text-yellow-700 text-xs font-semibold px-3 py-1 rounded-full mb-3"><i class="ri-star-fill"></i> Featured Story</span>
                                        <?php endif; ?>
                                        <h2 class="font-bold text-xl text-gray-800 mb-2"><?= e($s['title']) ?></h2>
                                        <p class="text-gray-600 mb-4"><?= e(substr($s['story'], 0, 200)) ?>...</p>
                                        <div class="flex items-center space-x-3 pt-3 border-t border-gray-100">
                                            <?php $pic = !empty($s['profile_picture']) ? public_asset($s['profile_picture']) : 'admin/assets/images/avatar-with-laptop.png'; ?>
                                            <img src="<?= e($pic) ?>" class="w-10 h-10 rounded-full object-cover" alt="">
                                            <div>
                                                <p class="font-medium text-gray-800 text-sm"><?= e($s['name']) ?></p>
                                                <p class="text-xs text-gray-500"><?= e($s['department'] ?? 'UAF') ?> · Class of <?= e($s['graduation_year'] ?? 'N/A') ?></p>
                                            </div>
                                        </div>
                                    </div>
                                </a>
                            <?php endforeach; ?>
                        </div>
                    <?php else: ?>
                        <div class="text-center py-16">
                            <i class="ri-book-open-line text-7xl text-gray-300"></i>
                            <h2 class="text-2xl font-bold text-gray-700 mt-4">No stories published yet</h2>
                            <p class="text-gray-500 mt-2">Be the first to share your journey!</p>
                            <a href="admin/index.php?action=story_create" class="inline-block mt-6 bg-green-700 text-white px-6 py-3 rounded-lg hover:bg-green-800 font-medium">Submit Your Story</a>
                        </div>
                    <?php endif; ?>
                </div>
            </div>
        </section>
    </main>

    <?php include 'includes/footer.php'; ?>
    <?php include 'includes/scripts.php'; ?>
</body>
</html>
