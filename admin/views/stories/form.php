<?php $pageTitle = 'Share Your Story'; ?>
<!DOCTYPE html>
<html lang="en">
<?php include __DIR__ . '/../shared/head.php'; ?>
<body class="bg-gray-50">
<?php include __DIR__ . '/../shared/sidebar.php'; ?>
<?php include __DIR__ . '/../shared/header.php'; ?>
<main class="lg:ml-64 pt-20 min-h-screen">
    <div class="p-6 max-w-3xl mx-auto">
        <h1 class="text-2xl font-bold mb-2">Share Your Success Story</h1>
        <p class="text-gray-500 mb-6">Inspire current students and fellow alumni. Stories are reviewed before publishing.</p>
        <form method="POST" enctype="multipart/form-data" action="index.php?action=story_create" class="bg-white rounded-lg shadow-sm p-6 space-y-4">
            <input type="hidden" name="csrf_token" value="<?= csrf_token() ?>">
            <div>
                <label class="block text-sm font-medium mb-1">Story Title *</label>
                <input name="title" required class="w-full px-4 py-2 border rounded-lg">
            </div>
            <div>
                <label class="block text-sm font-medium mb-1">Your Story *</label>
                <textarea name="story" required rows="12" placeholder="Tell us about your journey..." class="w-full px-4 py-2 border rounded-lg"></textarea>
            </div>
            <div>
                <label class="block text-sm font-medium mb-1">Cover Image (optional)</label>
                <input type="file" name="image" accept="image/*" class="w-full px-4 py-2 border rounded-lg">
            </div>
            <div class="flex space-x-3 pt-3">
                <button class="bg-green-700 text-white px-6 py-2 rounded-lg hover:bg-green-800">Submit for Review</button>
                <a href="index.php?action=stories" class="px-6 py-2 border rounded-lg hover:bg-gray-100">Cancel</a>
            </div>
        </form>
    </div>
</main>
</body>
</html>
