<?php $pageTitle = 'Mentor Applications'; ?>
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
            <h1 class="text-3xl font-bold text-gray-800">Mentor Applications</h1>
            <p class="text-gray-600 mt-2">Approve alumni before they appear in the mentor directory.</p>
        </div>

        <div class="bg-white rounded-lg shadow-sm overflow-hidden">
            <div class="overflow-x-auto">
                <table class="w-full text-sm">
                    <thead class="bg-gray-100 text-gray-700">
                        <tr>
                            <th class="text-left px-4 py-3">Applicant</th>
                            <th class="text-left px-4 py-3">Expertise</th>
                            <th class="text-left px-4 py-3">Bio</th>
                            <th class="text-left px-4 py-3">Status</th>
                            <th class="text-left px-4 py-3">Action</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-100">
                        <?php foreach ($applications as $app): ?>
                            <tr class="align-top">
                                <td class="px-4 py-3">
                                    <p class="font-semibold text-gray-800"><?= e($app['name']) ?></p>
                                    <p class="text-xs text-gray-500"><?= e($app['email']) ?></p>
                                    <p class="text-xs text-gray-500"><?= e(ucfirst($app['role'] ?? 'user')) ?><?= !empty($app['department']) ? ' &middot; ' . e($app['department']) : '' ?><?= $app['graduation_year'] ? ' &middot; Class of ' . e($app['graduation_year']) : '' ?></p>
                                </td>
                                <td class="px-4 py-3 text-gray-700">
                                    <p class="font-medium"><?= e($app['expertise']) ?></p>
                                    <?php if ($app['availability']): ?>
                                        <p class="text-xs text-gray-500 mt-1"><i class="ri-time-line"></i> <?= e($app['availability']) ?></p>
                                    <?php endif; ?>
                                </td>
                                <td class="px-4 py-3 text-gray-600 max-w-sm"><?= e($app['bio']) ?></td>
                                <td class="px-4 py-3">
                                    <?php
                                    $status = $app['approval_status'] ?? 'pending';
                                    $statusClass = $status === 'approved' ? 'bg-green-100 text-green-700' : ($status === 'rejected' ? 'bg-red-100 text-red-700' : 'bg-yellow-100 text-yellow-700');
                                    ?>
                                    <span class="px-2 py-1 rounded-full text-xs font-semibold <?= $statusClass ?>"><?= e(ucfirst($status)) ?></span>
                                </td>
                                <td class="px-4 py-3 min-w-[240px]">
                                    <form method="POST" action="index.php?action=admin_mentor_approve" class="space-y-2">
                                        <input type="hidden" name="csrf_token" value="<?= csrf_token() ?>">
                                        <input type="hidden" name="mentor_id" value="<?= e($app['mentor_id']) ?>">
                                        <input type="hidden" name="user_id" value="<?= e($app['user_id']) ?>">
                                        <select name="approval_status" class="w-full px-3 py-2 border border-gray-300 rounded-lg">
                                            <?php foreach (['pending', 'approved', 'rejected'] as $statusOption): ?>
                                                <option value="<?= e($statusOption) ?>" <?= $status === $statusOption ? 'selected' : '' ?>><?= e(ucfirst($statusOption)) ?></option>
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
                                <td colspan="5" class="px-4 py-8 text-center text-gray-500">No mentor applications yet.</td>
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
