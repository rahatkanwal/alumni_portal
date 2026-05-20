<?php $pageTitle = $job['title']; ?>
<!DOCTYPE html>
<html lang="en">
<?php include __DIR__ . '/../shared/head.php'; ?>
<body class="bg-gray-50">
<?php include __DIR__ . '/../shared/sidebar.php'; ?>
<?php include __DIR__ . '/../shared/header.php'; ?>
<main class="lg:ml-64 pt-20 min-h-screen">
    <div class="p-6 max-w-4xl mx-auto">
        <?php include __DIR__ . '/../shared/flash.php'; ?>
        <a href="index.php?action=jobs" class="text-green-700 hover:underline mb-4 inline-flex items-center"><i class="ri-arrow-left-line"></i> Back to Jobs</a>

        <div class="bg-white rounded-lg shadow-sm p-6">
            <div class="flex items-start justify-between flex-wrap mb-4">
                <div>
                    <h1 class="text-2xl font-bold text-gray-800"><?= e($job['title']) ?></h1>
                    <p class="text-gray-600"><?= e($job['company']) ?> · <?= e($job['location'] ?: 'Remote') ?></p>
                    <div class="flex items-center space-x-2 mt-2">
                        <span class="text-xs bg-pink-100 text-pink-700 px-2 py-1 rounded-full"><?= e(ucfirst($job['job_type'])) ?></span>
                        <?php if ($job['salary_range']): ?><span class="text-xs bg-green-100 text-green-700 px-2 py-1 rounded-full"><?= e($job['salary_range']) ?></span><?php endif; ?>
                    </div>
                </div>
                <?php if ($_SESSION['role'] === 'admin' || $job['posted_by'] == $_SESSION['user_id']): ?>
                    <form method="POST" action="index.php?action=job_delete" onsubmit="return confirm('Remove this job?')">
                        <input type="hidden" name="csrf_token" value="<?= csrf_token() ?>">
                        <input type="hidden" name="job_id" value="<?= e($job['job_id']) ?>">
                        <button class="bg-red-500 text-white px-3 py-2 rounded-lg hover:bg-red-600 text-sm"><i class="ri-delete-bin-line"></i> Remove</button>
                    </form>
                <?php endif; ?>
            </div>

            <div class="mb-6">
                <h3 class="font-bold text-gray-800 mb-2">Description</h3>
                <p class="text-gray-600 whitespace-pre-line"><?= e($job['description']) ?></p>
            </div>

            <?php if ($job['requirements']): ?>
                <div class="mb-6">
                    <h3 class="font-bold text-gray-800 mb-2">Requirements</h3>
                    <p class="text-gray-600 whitespace-pre-line"><?= e($job['requirements']) ?></p>
                </div>
            <?php endif; ?>

            <?php if ($job['deadline']): ?>
                <p class="text-sm text-gray-500 mb-4"><i class="ri-calendar-line"></i> Deadline: <?= date('M d, Y', strtotime($job['deadline'])) ?></p>
            <?php endif; ?>

            <?php if (!$hasApplied && $job['posted_by'] != $_SESSION['user_id']): ?>
                <div class="border-t pt-6">
                    <h3 class="font-bold text-gray-800 mb-3">Apply for this position</h3>
                    <form method="POST" enctype="multipart/form-data" action="index.php?action=job_apply" class="space-y-3">
                        <input type="hidden" name="csrf_token" value="<?= csrf_token() ?>">
                        <input type="hidden" name="job_id" value="<?= e($job['job_id']) ?>">
                        <textarea name="cover_letter" rows="4" placeholder="Cover letter (optional)" class="w-full px-4 py-2 border rounded-lg"></textarea>
                        <div>
                            <label class="block text-sm font-medium mb-1">Resume (PDF/DOC)</label>
                            <input type="file" name="resume" accept=".pdf,.doc,.docx" class="w-full px-4 py-2 border rounded-lg">
                        </div>
                        <button class="bg-green-700 text-white px-6 py-2 rounded-lg hover:bg-green-800">Submit Application</button>
                    </form>
                </div>
            <?php elseif ($hasApplied): ?>
                <div class="border-t pt-6 bg-green-50 -mx-6 -mb-6 px-6 py-4 rounded-b-lg">
                    <p class="text-green-700"><i class="ri-check-line"></i> You have already applied to this job.</p>
                </div>
            <?php endif; ?>
        </div>

        <?php if (!empty($applications)): ?>
            <div class="bg-white rounded-lg shadow-sm p-6 mt-6">
                <h3 class="font-bold text-gray-800 mb-4">Applications (<?= count($applications) ?>)</h3>
                <div class="space-y-3">
                    <?php foreach ($applications as $app): ?>
                        <div class="border-b pb-3">
                            <div class="flex items-center justify-between">
                                <div>
                                    <p class="font-medium"><?= e($app['name'] ?: 'Anonymous') ?></p>
                                    <p class="text-sm text-gray-500"><?= e($app['email']) ?></p>
                                </div>
                                <?php if ($app['resume']): ?>
                                    <a href="<?= e($app['resume']) ?>" target="_blank" class="text-green-700 hover:underline text-sm"><i class="ri-file-text-line"></i> Resume</a>
                                <?php endif; ?>
                            </div>
                            <?php if ($app['cover_letter']): ?>
                                <p class="text-sm text-gray-600 mt-2"><?= e($app['cover_letter']) ?></p>
                            <?php endif; ?>
                        </div>
                    <?php endforeach; ?>
                </div>
            </div>
        <?php endif; ?>
    </div>
</main>
</body>
</html>
