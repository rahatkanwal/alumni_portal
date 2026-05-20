<?php
$isEdit = isset($announcement);
$pageTitle = $isEdit ? 'Edit Announcement' : 'Post Announcement';
$a = $isEdit ? $announcement : [];
?>
<!DOCTYPE html>
<html lang="en">
<?php include __DIR__ . '/../shared/head.php'; ?>
<body class="bg-gray-50">
<?php include __DIR__ . '/../shared/sidebar.php'; ?>
<?php include __DIR__ . '/../shared/header.php'; ?>
<main class="lg:ml-64 pt-20 min-h-screen">
    <div class="p-6 max-w-3xl mx-auto">
        <h1 class="text-2xl font-bold mb-6"><?= $isEdit ? 'Edit' : 'Post' ?> Announcement</h1>
        <form method="POST" enctype="multipart/form-data" action="index.php?action=<?= $isEdit ? 'news_edit&id=' . e($a['announcement_id']) : 'news_create' ?>" class="bg-white rounded-lg shadow-sm p-6 space-y-4">
            <input type="hidden" name="csrf_token" value="<?= csrf_token() ?>">
            <?php if ($isEdit): ?><input type="hidden" name="announcement_id" value="<?= e($a['announcement_id']) ?>"><?php endif; ?>
            <div>
                <label class="block text-sm font-medium mb-1">Title *</label>
                <input name="title" required value="<?= e($a['title'] ?? '') ?>" class="w-full px-4 py-2 border rounded-lg">
            </div>
            <div>
                <label class="block text-sm font-medium mb-1">Content *</label>
                <textarea name="body" required rows="10" class="w-full px-4 py-2 border rounded-lg"><?= e($a['body'] ?? '') ?></textarea>
            </div>
            <div>
                <label class="block text-sm font-medium mb-1">Cover Image (optional)</label>
                <input type="file" name="image" accept="image/*" class="w-full px-4 py-2 border rounded-lg">
            </div>
            <div class="flex space-x-3 pt-3">
                <button class="bg-green-700 text-white px-6 py-2 rounded-lg hover:bg-green-800"><?= $isEdit ? 'Update' : 'Publish' ?></button>
                <a href="index.php?action=news" class="px-6 py-2 border rounded-lg hover:bg-gray-100">Cancel</a>
            </div>
        </form>
    </div>
</main>
</body>
</html>
