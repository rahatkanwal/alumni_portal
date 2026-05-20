<?php $pageTitle = 'Batch Geocode Alumni'; ?>
<!DOCTYPE html>
<html lang="en">
<?php include __DIR__ . '/../shared/head.php'; ?>
<body class="bg-gray-50">
<?php include __DIR__ . '/../shared/sidebar.php'; ?>
<?php include __DIR__ . '/../shared/header.php'; ?>
<main class="lg:ml-64 pt-20 min-h-screen">
    <div class="p-6 max-w-3xl mx-auto">
        <a href="index.php?action=directory_map" class="text-green-700 hover:underline mb-4 inline-flex items-center"><i class="ri-arrow-left-line"></i> Back to Map</a>

        <h1 class="text-2xl font-bold mb-6">Batch Geocode Results</h1>

        <div class="bg-white rounded-lg shadow-sm p-6 mb-6">
            <div class="grid grid-cols-3 gap-4 text-center">
                <div>
                    <p class="text-3xl font-bold text-gray-700"><?= e($totalPending) ?></p>
                    <p class="text-sm text-gray-500">Total Processed</p>
                </div>
                <div>
                    <p class="text-3xl font-bold text-green-700"><?= e($succeeded) ?></p>
                    <p class="text-sm text-gray-500">Successfully Geocoded</p>
                </div>
                <div>
                    <p class="text-3xl font-bold text-red-600"><?= e($failed) ?></p>
                    <p class="text-sm text-gray-500">Failed</p>
                </div>
            </div>
        </div>

        <?php if ($succeeded > 0): ?>
            <div class="bg-green-50 border border-green-200 rounded-lg p-4 mb-4">
                <p class="text-green-800"><i class="ri-checkbox-circle-line"></i> <strong><?= e($succeeded) ?> alumni</strong> are now visible on the map with real coordinates.</p>
            </div>
        <?php endif; ?>

        <?php if (!empty($failedItems)): ?>
            <div class="bg-white rounded-lg shadow-sm p-6">
                <h3 class="font-bold text-gray-800 mb-4">Could Not Geocode (<?= count($failedItems) ?>)</h3>
                <p class="text-sm text-gray-500 mb-4">These addresses returned no result from OpenStreetMap. Often the address is too vague or has typos. Alumni can edit their profile and try again.</p>
                <ul class="divide-y divide-gray-200">
                    <?php foreach ($failedItems as $item): ?>
                        <li class="py-3">
                            <p class="font-medium text-gray-800"><?= e($item['name']) ?></p>
                            <p class="text-sm text-gray-500"><?= e($item['address']) ?></p>
                        </li>
                    <?php endforeach; ?>
                </ul>
            </div>
        <?php endif; ?>

        <?php if ($totalPending === 0): ?>
            <div class="bg-blue-50 border border-blue-200 rounded-lg p-6 text-center">
                <i class="ri-checkbox-circle-line text-5xl text-blue-600"></i>
                <p class="text-blue-900 font-medium mt-3">All alumni with addresses have been geocoded! 🎉</p>
                <a href="index.php?action=directory_map" class="inline-block mt-4 bg-green-700 text-white px-6 py-2 rounded-lg hover:bg-green-800">View Map</a>
            </div>
        <?php endif; ?>
    </div>
</main>
</body>
</html>
