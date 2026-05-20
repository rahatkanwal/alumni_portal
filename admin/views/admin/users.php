<?php $pageTitle = 'Manage Users'; ?>
<!DOCTYPE html>
<html lang="en">
<?php include __DIR__ . '/../shared/head.php'; ?>
<body class="bg-gray-50">
<?php include __DIR__ . '/../shared/sidebar.php'; ?>
<?php include __DIR__ . '/../shared/header.php'; ?>
<main class="lg:ml-64 pt-20 min-h-screen">
    <div class="p-6">
        <?php include __DIR__ . '/../shared/flash.php'; ?>

        <div class="flex items-center justify-between mb-6">
            <h1 class="text-2xl font-bold text-gray-800">Manage Users</h1>
            <a href="index.php?action=admin_export" class="bg-green-700 text-white px-4 py-2 rounded-lg hover:bg-green-800 flex items-center space-x-2">
                <i class="ri-download-line"></i><span>Export CSV</span>
            </a>
        </div>

        <div class="bg-white rounded-lg shadow-sm overflow-hidden">
            <table class="min-w-full divide-y divide-gray-200">
                <thead class="bg-gray-50">
                    <tr>
                        <th class="px-4 py-3 text-left text-xs font-semibold text-gray-600 uppercase">Name</th>
                        <th class="px-4 py-3 text-left text-xs font-semibold text-gray-600 uppercase">Email</th>
                        <th class="px-4 py-3 text-left text-xs font-semibold text-gray-600 uppercase">Department</th>
                        <th class="px-4 py-3 text-left text-xs font-semibold text-gray-600 uppercase">Year</th>
                        <th class="px-4 py-3 text-left text-xs font-semibold text-gray-600 uppercase">Status</th>
                        <th class="px-4 py-3 text-left text-xs font-semibold text-gray-600 uppercase">Actions</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-200">
                    <?php foreach ($users as $u): ?>
                    <tr class="hover:bg-gray-50">
                        <td class="px-4 py-3 font-medium text-gray-800"><?= e($u['name']) ?></td>
                        <td class="px-4 py-3 text-gray-600"><?= e($u['email']) ?></td>
                        <td class="px-4 py-3 text-gray-600"><?= e($u['department'] ?: '—') ?></td>
                        <td class="px-4 py-3 text-gray-600"><?= e($u['graduation_year'] ?: '—') ?></td>
                        <td class="px-4 py-3">
                            <?php $st = $u['status'] ?? 'active'; ?>
                            <span class="inline-block px-2 py-1 text-xs rounded-full <?= $st === 'active' ? 'bg-green-100 text-green-700' : 'bg-red-100 text-red-700' ?>"><?= e(ucfirst($st)) ?></span>
                        </td>
                        <td class="px-4 py-3">
                            <form method="POST" action="index.php?action=admin_user_action" class="inline-flex space-x-1">
                                <input type="hidden" name="csrf_token" value="<?= csrf_token() ?>">
                                <input type="hidden" name="user_id" value="<?= e($u['user_id']) ?>">
                                <?php if ($st === 'active'): ?>
                                    <button name="op" value="suspend" class="text-yellow-600 hover:text-yellow-800 text-sm"><i class="ri-pause-circle-line"></i> Suspend</button>
                                <?php else: ?>
                                    <button name="op" value="activate" class="text-green-600 hover:text-green-800 text-sm"><i class="ri-play-circle-line"></i> Activate</button>
                                <?php endif; ?>
                                <button name="op" value="delete" onclick="return confirm('Delete this user permanently?')" class="text-red-600 hover:text-red-800 text-sm ml-2"><i class="ri-delete-bin-line"></i> Delete</button>
                            </form>
                        </td>
                    </tr>
                    <?php endforeach; ?>
                    <?php if (empty($users)): ?>
                        <tr><td colspan="6" class="px-4 py-8 text-center text-gray-500">No alumni registered yet.</td></tr>
                    <?php endif; ?>
                </tbody>
            </table>
        </div>
    </div>
</main>
</body>
</html>
