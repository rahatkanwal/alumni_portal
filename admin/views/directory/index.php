<?php $pageTitle = 'Alumni Directory'; ?>
<!DOCTYPE html>
<html lang="en">
<?php include __DIR__ . '/../shared/head.php'; ?>
<body class="bg-gray-50">
<?php include __DIR__ . '/../shared/sidebar.php'; ?>
<?php include __DIR__ . '/../shared/header.php'; ?>
<main class="lg:ml-64 pt-20 min-h-screen">
    <div class="p-6">
        <div class="flex items-center justify-between mb-6">
            <div>
                <h1 class="text-2xl font-bold text-gray-800">Alumni Directory</h1>
                <p class="text-gray-500"><?= count($alumni) ?> alumni found</p>
            </div>
            <a href="index.php?action=directory_map" class="bg-green-700 text-white px-4 py-2 rounded-lg hover:bg-green-800 flex items-center space-x-2">
                <i class="ri-map-pin-line"></i><span>Map View</span>
            </a>
        </div>

        <!-- Search/Filter Bar -->
        <form method="GET" class="bg-white rounded-lg shadow-sm p-4 mb-6">
            <input type="hidden" name="action" value="directory">
            <div class="grid grid-cols-1 md:grid-cols-4 gap-3">
                <input type="text" name="name" value="<?= e($filters['name']) ?>" placeholder="Search by name..." class="px-4 py-2 border rounded-lg focus:ring-2 focus:ring-green-500 outline-none">
                <select name="department" class="px-4 py-2 border rounded-lg focus:ring-2 focus:ring-green-500 outline-none">
                    <option value="">All Departments</option>
                    <?php foreach ($departments as $d): ?>
                        <option value="<?= e($d) ?>" <?= $filters['department'] === $d ? 'selected' : '' ?>><?= e($d) ?></option>
                    <?php endforeach; ?>
                </select>
                <select name="graduation_year" class="px-4 py-2 border rounded-lg focus:ring-2 focus:ring-green-500 outline-none">
                    <option value="">All Years</option>
                    <?php foreach ($years as $y): ?>
                        <option value="<?= e($y) ?>" <?= $filters['graduation_year'] == $y ? 'selected' : '' ?>><?= e($y) ?></option>
                    <?php endforeach; ?>
                </select>
                <div class="flex space-x-2">
                    <button type="submit" class="flex-1 bg-green-700 text-white px-4 py-2 rounded-lg hover:bg-green-800">Search</button>
                    <a href="index.php?action=directory" class="px-4 py-2 border rounded-lg hover:bg-gray-100">Reset</a>
                </div>
            </div>
        </form>

        <!-- Alumni Grid -->
        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-4">
            <?php foreach ($alumni as $a): ?>
                <div class="bg-white rounded-lg shadow-sm hover:shadow-md transition p-5">
                    <div class="flex flex-col items-center text-center">
                        <?php $pic = !empty($a['profile_picture']) ? $a['profile_picture'] : 'assets/images/avatar-with-laptop.png'; ?>
                        <img src="<?= e($pic) ?>" class="w-20 h-20 rounded-full object-cover border-4 border-green-100 mb-3" alt="<?= e($a['name']) ?>">
                        <h3 class="font-bold text-gray-800"><?= e($a['name']) ?></h3>
                        <p class="text-xs text-gray-500 mb-2"><?= e($a['department'] ?: 'Department N/A') ?></p>
                        <?php if ($a['current_job']): ?>
                            <p class="text-sm text-gray-600 mb-1"><i class="ri-briefcase-line"></i> <?= e($a['current_job']) ?></p>
                        <?php endif; ?>
                        <?php if ($a['company']): ?>
                            <p class="text-xs text-gray-500 mb-2"><?= e($a['company']) ?></p>
                        <?php endif; ?>
                        <?php if ($a['graduation_year']): ?>
                            <span class="inline-block bg-green-100 text-green-700 text-xs px-2 py-1 rounded-full mb-3">Class of <?= e($a['graduation_year']) ?></span>
                        <?php endif; ?>
                        <div class="flex space-x-2 w-full">
                            <a href="index.php?action=directory_profile&id=<?= $a['user_id'] ?>" class="flex-1 bg-gray-100 text-gray-700 text-sm py-2 rounded hover:bg-gray-200">View</a>
                            <?php if ($a['user_id'] != $_SESSION['user_id']): ?>
                                <a href="index.php?action=conversation&with=<?= $a['user_id'] ?>" class="flex-1 bg-green-700 text-white text-sm py-2 rounded hover:bg-green-800">Message</a>
                            <?php endif; ?>
                        </div>
                    </div>
                </div>
            <?php endforeach; ?>
            <?php if (empty($alumni)): ?>
                <div class="col-span-full text-center py-12 text-gray-500">
                    <i class="ri-search-line text-5xl"></i>
                    <p class="mt-4">No alumni found matching your criteria.</p>
                </div>
            <?php endif; ?>
        </div>
    </div>
</main>
</body>
</html>
