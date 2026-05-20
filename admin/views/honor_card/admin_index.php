<?php $pageTitle = 'Honor Card Applications'; ?>
<!DOCTYPE html>
<html lang="en">
<?php include __DIR__ . '/../shared/head.php'; ?>
<body class="bg-gray-50">
<?php include __DIR__ . '/../shared/sidebar.php'; ?>
<?php include __DIR__ . '/../shared/header.php'; ?>
<main class="lg:ml-64 pt-20 min-h-screen">
    <div class="p-6">
        <?php include __DIR__ . '/../shared/flash.php'; ?>

        <div class="bg-white rounded-lg shadow-sm p-6 mb-6">
            <h1 class="text-3xl font-bold text-gray-800">Honor Card Applications</h1>
            <p class="text-gray-600 mt-2">Review alumni card requests and update their status.</p>
        </div>

        <div class="bg-white rounded-lg shadow-sm overflow-hidden">
            <div class="overflow-x-auto">
                <table class="w-full text-sm">
                    <thead class="bg-gray-100 text-gray-700">
                        <tr>
                            <th class="text-left px-4 py-3">Alumni</th>
                            <th class="text-left px-4 py-3">Contact</th>
                            <th class="text-left px-4 py-3">Address</th>
                            <th class="text-left px-4 py-3">Status</th>
                            <th class="text-left px-4 py-3">Applied</th>
                            <th class="text-left px-4 py-3">Action</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-100">
                        <?php foreach ($applications as $app): ?>
                            <tr class="align-top">
                                <td class="px-4 py-3">
                                    <p class="font-semibold text-gray-800"><?= e($app['name'] ?: 'Alumni') ?></p>
                                    <p class="text-xs text-gray-500"><?= e($app['display_department'] ?: 'N/A') ?><?= $app['display_graduation_year'] ? ' &middot; Class of ' . e($app['display_graduation_year']) : '' ?></p>
                                </td>
                                <td class="px-4 py-3 text-gray-600">
                                    <p><?= e($app['email']) ?></p>
                                    <p><?= e($app['phone'] ?: 'No phone') ?></p>
                                </td>
                                <td class="px-4 py-3 text-gray-600 max-w-xs">
                                    <p><?= e($app['delivery_address']) ?></p>
                                    <?php if ($app['notes']): ?>
                                        <p class="text-xs text-gray-500 mt-2">Note: <?= e($app['notes']) ?></p>
                                    <?php endif; ?>
                                </td>
                                <td class="px-4 py-3">
                                    <span class="px-2 py-1 rounded-full text-xs font-semibold bg-gray-100 text-gray-700"><?= e(ucfirst($app['status'])) ?></span>
                                </td>
                                <td class="px-4 py-3 text-gray-600"><?= date('M d, Y', strtotime($app['applied_at'])) ?></td>
                                <td class="px-4 py-3 min-w-[240px]">
                                    <form method="POST" action="index.php?action=admin_honor_card_update" class="space-y-2">
                                        <input type="hidden" name="csrf_token" value="<?= csrf_token() ?>">
                                        <input type="hidden" name="application_id" value="<?= e($app['application_id']) ?>">
                                        <select name="status" class="w-full px-3 py-2 border border-gray-300 rounded-lg">
                                            <?php foreach (['pending', 'approved', 'issued', 'rejected'] as $status): ?>
                                                <option value="<?= e($status) ?>" <?= $app['status'] === $status ? 'selected' : '' ?>><?= e(ucfirst($status)) ?></option>
                                            <?php endforeach; ?>
                                        </select>
                                        <input type="text" name="admin_notes" value="<?= e($app['admin_notes'] ?? '') ?>" placeholder="Admin notes" class="w-full px-3 py-2 border border-gray-300 rounded-lg">
                                        <button class="bg-green-700 text-white px-4 py-2 rounded-lg hover:bg-green-800">Update</button>
                                    </form>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                        <?php if (empty($applications)): ?>
                            <tr>
                                <td colspan="6" class="px-4 py-8 text-center text-gray-500">No Honor Card applications yet.</td>
                            </tr>
                        <?php endif; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</main>
</body>
</html>
