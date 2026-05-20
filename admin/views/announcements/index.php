<?php $pageTitle = 'News & Announcements'; ?>
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
            <h1 class="text-2xl font-bold text-gray-800">News &amp; Announcements</h1>
            <?php if (($_SESSION['role'] ?? '') === 'admin'): ?>
                <a href="index.php?action=news_create" class="bg-green-700 text-white px-4 py-2 rounded-lg hover:bg-green-800 flex items-center space-x-2">
                    <i class="ri-add-line"></i><span>Post Announcement</span>
                </a>
            <?php endif; ?>
        </div>

        <div class="space-y-4">
            <?php foreach ($announcements as $a): ?>
                <article class="bg-white rounded-lg shadow-sm overflow-hidden hover:shadow-md transition">
                    <div class="md:flex">
                        <?php if (!empty($a['image'])): ?>
                            <img src="<?= e($a['image']) ?>" class="md:w-64 h-48 md:h-auto object-cover" alt="">
                        <?php endif; ?>
                        <div class="p-6 flex-1">
                            <p class="text-xs text-gray-500 mb-1"><?= date('M d, Y · g:i A', strtotime($a['created_at'])) ?></p>
                            <h2 class="text-xl font-bold text-gray-800 mb-2"><?= e($a['title']) ?></h2>
                            <p class="text-gray-600 mb-3"><?= e(substr($a['body'], 0, 200)) ?><?= strlen($a['body']) > 200 ? '...' : '' ?></p>
                            <div class="flex items-center justify-between">
                                <a href="index.php?action=news_show&id=<?= $a['announcement_id'] ?>" class="text-green-700 font-medium hover:underline">Read More →</a>
                                <?php if (($_SESSION['role'] ?? '') === 'admin'): ?>
                                    <div class="flex space-x-2">
                                        <a href="index.php?action=news_edit&id=<?= $a['announcement_id'] ?>" class="text-yellow-600 hover:underline text-sm"><i class="ri-edit-line"></i></a>
                                        <form method="POST" action="index.php?action=news_delete" class="inline" onsubmit="return confirm('Delete?')">
                                            <input type="hidden" name="csrf_token" value="<?= csrf_token() ?>">
                                            <input type="hidden" name="announcement_id" value="<?= e($a['announcement_id']) ?>">
                                            <button class="text-red-600 hover:underline text-sm"><i class="ri-delete-bin-line"></i></button>
                                        </form>
                                    </div>
                                <?php endif; ?>
                            </div>
                        </div>
                    </div>
                </article>
            <?php endforeach; ?>
            <?php if (empty($announcements)): ?>
                <div class="text-center py-12 text-gray-500">
                    <i class="ri-article-line text-5xl"></i>
                    <p class="mt-4">No announcements yet.</p>
                </div>
            <?php endif; ?>
        </div>
    </div>
</main>
</body>
</html>
