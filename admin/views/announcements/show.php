<?php $pageTitle = $announcement['title']; ?>
<!DOCTYPE html>
<html lang="en">
<?php include __DIR__ . '/../shared/head.php'; ?>
<body class="bg-gray-50">
<?php include __DIR__ . '/../shared/sidebar.php'; ?>
<?php include __DIR__ . '/../shared/header.php'; ?>
<main class="lg:ml-64 pt-20 min-h-screen">
    <div class="p-6 max-w-3xl mx-auto">
        <a href="index.php?action=news" class="text-green-700 hover:underline mb-4 inline-flex items-center"><i class="ri-arrow-left-line"></i> Back to News</a>
        <article class="bg-white rounded-lg shadow-sm overflow-hidden">
            <?php if (!empty($announcement['image'])): ?>
                <img src="<?= e($announcement['image']) ?>" class="w-full h-64 object-cover" alt="">
            <?php endif; ?>
            <div class="p-8">
                <p class="text-xs text-gray-500 mb-2"><?= date('F d, Y · g:i A', strtotime($announcement['created_at'])) ?></p>
                <h1 class="text-3xl font-bold text-gray-800 mb-4"><?= e($announcement['title']) ?></h1>
                <div class="prose text-gray-700 whitespace-pre-line"><?= e($announcement['body']) ?></div>
            </div>
        </article>
    </div>
</main>
</body>
</html>
