<?php $pageTitle = 'Post a Job'; ?>
<!DOCTYPE html>
<html lang="en">
<?php include __DIR__ . '/../shared/head.php'; ?>
<body class="bg-gray-50">
<?php include __DIR__ . '/../shared/sidebar.php'; ?>
<?php include __DIR__ . '/../shared/header.php'; ?>
<main class="lg:ml-64 pt-20 min-h-screen">
    <div class="p-6 max-w-3xl mx-auto">
        <h1 class="text-2xl font-bold mb-6">Post a Job</h1>
        <form method="POST" action="index.php?action=job_create" class="bg-white rounded-lg shadow-sm p-6 space-y-4">
            <input type="hidden" name="csrf_token" value="<?= csrf_token() ?>">
            <div class="grid grid-cols-2 gap-4">
                <div>
                    <label class="block text-sm font-medium mb-1">Job Title *</label>
                    <input name="title" required class="w-full px-4 py-2 border rounded-lg">
                </div>
                <div>
                    <label class="block text-sm font-medium mb-1">Company *</label>
                    <input name="company" required class="w-full px-4 py-2 border rounded-lg">
                </div>
            </div>
            <div class="grid grid-cols-2 gap-4">
                <div>
                    <label class="block text-sm font-medium mb-1">Location</label>
                    <input name="location" class="w-full px-4 py-2 border rounded-lg">
                </div>
                <div>
                    <label class="block text-sm font-medium mb-1">Job Type</label>
                    <select name="job_type" class="w-full px-4 py-2 border rounded-lg">
                        <?php foreach (['full-time','part-time','contract','internship','remote'] as $t): ?>
                            <option value="<?= $t ?>"><?= ucfirst($t) ?></option>
                        <?php endforeach; ?>
                    </select>
                </div>
            </div>
            <div class="grid grid-cols-2 gap-4">
                <div>
                    <label class="block text-sm font-medium mb-1">Salary Range</label>
                    <input name="salary_range" placeholder="e.g. 80k-120k PKR" class="w-full px-4 py-2 border rounded-lg">
                </div>
                <div>
                    <label class="block text-sm font-medium mb-1">Application Deadline</label>
                    <input type="date" name="deadline" class="w-full px-4 py-2 border rounded-lg">
                </div>
            </div>
            <div>
                <label class="block text-sm font-medium mb-1">Description *</label>
                <textarea name="description" required rows="6" class="w-full px-4 py-2 border rounded-lg"></textarea>
            </div>
            <div>
                <label class="block text-sm font-medium mb-1">Requirements</label>
                <textarea name="requirements" rows="4" class="w-full px-4 py-2 border rounded-lg"></textarea>
            </div>
            <div>
                <label class="block text-sm font-medium mb-1">External Apply Link (optional)</label>
                <input type="url" name="apply_link" placeholder="https://..." class="w-full px-4 py-2 border rounded-lg">
            </div>
            <div class="flex space-x-3 pt-3">
                <button class="bg-green-700 text-white px-6 py-2 rounded-lg hover:bg-green-800">Post Job</button>
                <a href="index.php?action=jobs" class="px-6 py-2 border rounded-lg hover:bg-gray-100">Cancel</a>
            </div>
        </form>
    </div>
</main>
</body>
</html>
