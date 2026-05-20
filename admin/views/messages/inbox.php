<?php $pageTitle = 'Messages'; ?>
<!DOCTYPE html>
<html lang="en">
<?php include __DIR__ . '/../shared/head.php'; ?>
<body class="bg-gray-50">
<?php include __DIR__ . '/../shared/sidebar.php'; ?>
<?php include __DIR__ . '/../shared/header.php'; ?>
<main class="lg:ml-64 pt-20 min-h-screen">
    <div class="p-6 max-w-3xl mx-auto">
        <h1 class="text-2xl font-bold mb-6">Inbox</h1>

        <div class="bg-white rounded-lg shadow-sm divide-y">
            <?php foreach ($threads as $t): ?>
                <a href="index.php?action=conversation&with=<?= $t['partner_id'] ?>" class="flex items-center space-x-3 p-4 hover:bg-gray-50">
                    <?php $pic = !empty($t['profile_picture']) ? $t['profile_picture'] : 'assets/images/avatar-with-laptop.png'; ?>
                    <img src="<?= e($pic) ?>" class="w-10 h-10 rounded-full object-cover">
                    <div class="flex-1 min-w-0">
                        <p class="font-medium truncate"><?= e($t['partner_name'] ?: 'Alumni') ?></p>
                        <p class="text-sm text-gray-500 truncate"><?= e($t['body']) ?></p>
                    </div>
                    <p class="text-xs text-gray-400"><?= date('M d', strtotime($t['created_at'])) ?></p>
                </a>
            <?php endforeach; ?>
            <?php if (empty($threads)): ?>
                <div class="text-center py-12 text-gray-500">
                    <i class="ri-message-3-line text-5xl"></i>
                    <p class="mt-4">No messages yet. Start a conversation from the <a href="index.php?action=directory" class="text-green-700 hover:underline">Alumni Directory</a>.</p>
                </div>
            <?php endif; ?>
        </div>
    </div>
</main>
</body>
</html>
