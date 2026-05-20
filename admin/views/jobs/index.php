<?php $pageTitle = 'Job Board'; ?>
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
            <div>
                <h1 class="text-2xl font-bold text-gray-800">Job Board</h1>
                <p class="text-gray-500"><?= count($jobs) ?> opportunities</p>
            </div>
            <a href="index.php?action=job_create" class="bg-green-700 text-white px-4 py-2 rounded-lg hover:bg-green-800 flex items-center space-x-2">
                <i class="ri-add-line"></i><span>Post Job</span>
            </a>
        </div>

        <form method="GET" class="bg-white rounded-lg shadow-sm p-4 mb-6">
            <input type="hidden" name="action" value="jobs">
            <div class="grid grid-cols-1 md:grid-cols-3 gap-3">
                <input type="text" name="q" value="<?= e($_GET['q'] ?? '') ?>" placeholder="Search jobs..." class="px-4 py-2 border rounded-lg">
                <select name="type" class="px-4 py-2 border rounded-lg">
                    <option value="">All Types</option>
                    <?php foreach (['full-time','part-time','contract','internship','remote'] as $t): ?>
                        <option value="<?= $t ?>" <?= ($_GET['type'] ?? '') === $t ? 'selected' : '' ?>><?= ucfirst($t) ?></option>
                    <?php endforeach; ?>
                </select>
                <button class="bg-green-700 text-white py-2 rounded-lg hover:bg-green-800">Search</button>
            </div>
        </form>

        <div class="space-y-4">
            <?php foreach ($jobs as $j): ?>
                <div class="bg-white rounded-lg shadow-sm p-5 hover:shadow-md transition">
                    <div class="flex items-start justify-between flex-wrap">
                        <div class="flex-1">
                            <h3 class="font-bold text-lg text-gray-800"><?= e($j['title']) ?></h3>
                            <p class="text-gray-600"><?= e($j['company']) ?> · <?= e($j['location'] ?: 'Remote') ?></p>
                            <div class="flex items-center space-x-2 mt-2">
                                <span class="text-xs bg-pink-100 text-pink-700 px-2 py-1 rounded-full"><?= e(ucfirst($j['job_type'])) ?></span>
                                <?php if ($j['salary_range']): ?>
                                    <span class="text-xs bg-green-100 text-green-700 px-2 py-1 rounded-full"><?= e($j['salary_range']) ?></span>
                                <?php endif; ?>
                                <span class="text-xs text-gray-500">Posted <?= date('M d', strtotime($j['created_at'])) ?></span>
                            </div>
                        </div>
                        <a href="index.php?action=job_show&id=<?= $j['job_id'] ?>" class="bg-green-700 text-white px-4 py-2 rounded-lg hover:bg-green-800 text-sm">View Details</a>
                    </div>
                </div>
            <?php endforeach; ?>
            <?php if (empty($jobs)): ?>
                <div class="text-center py-12 text-gray-500">
                    <i class="ri-briefcase-line text-5xl"></i>
                    <p class="mt-4">No jobs posted yet. Be the first to <a href="index.php?action=job_create" class="text-green-700 hover:underline">post one</a>!</p>
                </div>
            <?php endif; ?>
        </div>
    </div>
</main>
</body>
</html>
