<?php $pageTitle = 'Newsletter Subscriptions'; ?>
<!DOCTYPE html>
<html lang="en">
<?php include __DIR__ . '/../shared/head.php'; ?>
<body class="bg-gray-50">
<?php include __DIR__ . '/../shared/sidebar.php'; ?>
<?php include __DIR__ . '/../shared/header.php'; ?>
<main class="lg:ml-64 pt-20 min-h-screen">
    <div class="p-6">
        <h1 class="text-2xl font-bold mb-6">Newsletter Subscribers (<?= count($subs) ?>)</h1>
        <div class="bg-white rounded-lg shadow-sm overflow-hidden">
            <table class="min-w-full divide-y divide-gray-200">
                <thead class="bg-gray-50">
                    <tr>
                        <th class="px-4 py-3 text-left text-xs font-semibold text-gray-600 uppercase">Name</th>
                        <th class="px-4 py-3 text-left text-xs font-semibold text-gray-600 uppercase">Email</th>
                        <th class="px-4 py-3 text-left text-xs font-semibold text-gray-600 uppercase">Status</th>
                        <th class="px-4 py-3 text-left text-xs font-semibold text-gray-600 uppercase">Subscribed</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-200">
                    <?php foreach ($subs as $s): ?>
                    <tr>
                        <td class="px-4 py-3"><?= e($s['name'] ?: '—') ?></td>
                        <td class="px-4 py-3"><?= e($s['email']) ?></td>
                        <td class="px-4 py-3">
                            <span class="inline-block px-2 py-1 text-xs rounded-full <?= $s['is_active'] ? 'bg-green-100 text-green-700' : 'bg-gray-100 text-gray-700' ?>">
                                <?= $s['is_active'] ? 'Active' : 'Unsubscribed' ?>
                            </span>
                        </td>
                        <td class="px-4 py-3 text-gray-600"><?= date('M d, Y', strtotime($s['subscribed_at'])) ?></td>
                    </tr>
                    <?php endforeach; ?>
                    <?php if (empty($subs)): ?>
                        <tr><td colspan="4" class="px-4 py-8 text-center text-gray-500">No subscribers yet.</td></tr>
                    <?php endif; ?>
                </tbody>
            </table>
        </div>
    </div>
</main>
</body>
</html>
