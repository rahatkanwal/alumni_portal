<?php $pageTitle = 'Moderate Stories'; ?>
<!DOCTYPE html>
<html lang="en">
<?php include __DIR__ . '/../shared/head.php'; ?>
<body class="bg-gray-50">
<?php include __DIR__ . '/../shared/sidebar.php'; ?>
<?php include __DIR__ . '/../shared/header.php'; ?>
<main class="lg:ml-64 pt-20 min-h-screen">
    <div class="p-6">
        <?php include __DIR__ . '/../shared/flash.php'; ?>
        <h1 class="text-2xl font-bold mb-6">Moderate Career Stories</h1>

        <div class="space-y-4">
            <?php foreach ($stories as $s): ?>
            <div class="bg-white rounded-lg shadow-sm p-5">
                <div class="flex items-start justify-between mb-3">
                    <div>
                        <h3 class="font-bold text-gray-800"><?= e($s['title']) ?></h3>
                        <p class="text-sm text-gray-500">By <?= e($s['name'] ?? 'Unknown') ?> · <?= date('M d, Y', strtotime($s['created_at'])) ?></p>
                    </div>
                    <span class="px-3 py-1 text-xs rounded-full
                        <?= $s['status']==='approved' ? 'bg-green-100 text-green-700' : ($s['status']==='rejected' ? 'bg-red-100 text-red-700' : 'bg-yellow-100 text-yellow-700') ?>">
                        <?= e(ucfirst($s['status'])) ?>
                    </span>
                </div>
                <p class="text-gray-600 mb-4 line-clamp-3"><?= e(substr($s['story'], 0, 300)) ?>...</p>
                <form method="POST" action="index.php?action=admin_story_moderate" class="flex items-center space-x-2">
                    <input type="hidden" name="csrf_token" value="<?= csrf_token() ?>">
                    <input type="hidden" name="story_id" value="<?= e($s['story_id']) ?>">
                    <select name="status" class="px-3 py-2 border rounded-lg text-sm">
                        <option value="pending" <?= $s['status']==='pending'?'selected':'' ?>>Pending</option>
                        <option value="approved" <?= $s['status']==='approved'?'selected':'' ?>>Approve</option>
                        <option value="rejected" <?= $s['status']==='rejected'?'selected':'' ?>>Reject</option>
                    </select>
                    <label class="flex items-center space-x-2 text-sm">
                        <input type="checkbox" name="featured" value="1" <?= $s['is_featured']?'checked':'' ?>>
                        <span>Feature</span>
                    </label>
                    <button class="bg-green-700 text-white px-4 py-2 rounded-lg hover:bg-green-800 text-sm">Update</button>
                </form>
            </div>
            <?php endforeach; ?>
            <?php if (empty($stories)): ?>
                <p class="text-gray-500">No stories submitted yet.</p>
            <?php endif; ?>
        </div>
    </div>
</main>
</body>
</html>
