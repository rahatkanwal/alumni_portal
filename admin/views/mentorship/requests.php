<?php $pageTitle = 'Mentorship Requests'; ?>
<!DOCTYPE html>
<html lang="en">
<?php include __DIR__ . '/../shared/head.php'; ?>
<body class="bg-gray-50">
<?php include __DIR__ . '/../shared/sidebar.php'; ?>
<?php include __DIR__ . '/../shared/header.php'; ?>
<main class="lg:ml-64 pt-20 min-h-screen">
    <div class="p-6 max-w-5xl mx-auto">
        <?php include __DIR__ . '/../shared/flash.php'; ?>
        <h1 class="text-2xl font-bold mb-6">Mentorship Requests</h1>

        <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">
            <!-- Incoming -->
            <div>
                <h3 class="font-bold text-gray-800 mb-3">Incoming Requests</h3>
                <div class="space-y-3">
                    <?php foreach ($incoming as $r): ?>
                        <div class="bg-white rounded-lg shadow-sm p-4">
                            <p class="font-medium"><?= e($r['mentee_name'] ?? 'Mentee') ?></p>
                            <p class="text-sm text-gray-600 mt-2"><?= e($r['message']) ?></p>
                            <div class="flex items-center justify-between mt-3">
                                <span class="text-xs px-2 py-1 rounded-full
                                    <?= $r['status']==='accepted'?'bg-green-100 text-green-700':($r['status']==='declined'?'bg-red-100 text-red-700':'bg-yellow-100 text-yellow-700') ?>">
                                    <?= e(ucfirst($r['status'])) ?>
                                </span>
                                <?php if ($r['status'] === 'pending'): ?>
                                    <form method="POST" action="index.php?action=mentorship_respond" class="flex space-x-2">
                                        <input type="hidden" name="csrf_token" value="<?= csrf_token() ?>">
                                        <input type="hidden" name="request_id" value="<?= e($r['request_id']) ?>">
                                        <button name="status" value="accepted" class="text-green-700 text-sm hover:underline">Accept</button>
                                        <button name="status" value="declined" class="text-red-600 text-sm hover:underline">Decline</button>
                                    </form>
                                <?php endif; ?>
                            </div>
                        </div>
                    <?php endforeach; ?>
                    <?php if (empty($incoming)): ?>
                        <p class="text-gray-500 text-sm">No incoming requests.</p>
                    <?php endif; ?>
                </div>
            </div>
            <!-- Outgoing -->
            <div>
                <h3 class="font-bold text-gray-800 mb-3">My Requests</h3>
                <div class="space-y-3">
                    <?php foreach ($outgoing as $r): ?>
                        <div class="bg-white rounded-lg shadow-sm p-4">
                            <p class="font-medium">To: <?= e($r['mentor_name']) ?></p>
                            <p class="text-xs text-gray-500"><?= e($r['expertise']) ?></p>
                            <p class="text-sm text-gray-600 mt-2"><?= e($r['message']) ?></p>
                            <span class="inline-block mt-2 text-xs px-2 py-1 rounded-full
                                <?= $r['status']==='accepted'?'bg-green-100 text-green-700':($r['status']==='declined'?'bg-red-100 text-red-700':'bg-yellow-100 text-yellow-700') ?>">
                                <?= e(ucfirst($r['status'])) ?>
                            </span>
                        </div>
                    <?php endforeach; ?>
                    <?php if (empty($outgoing)): ?>
                        <p class="text-gray-500 text-sm">No requests sent.</p>
                    <?php endif; ?>
                </div>
            </div>
        </div>
    </div>
</main>
</body>
</html>
