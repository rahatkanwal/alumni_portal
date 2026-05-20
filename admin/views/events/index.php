<?php $pageTitle = 'Events'; ?>
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
            <h1 class="text-2xl font-bold text-gray-800">Events</h1>
            <?php if (($_SESSION['role'] ?? '') === 'admin'): ?>
                <a href="index.php?action=event_create" class="bg-green-700 text-white px-4 py-2 rounded-lg hover:bg-green-800 flex items-center space-x-2">
                    <i class="ri-add-line"></i><span>New Event</span>
                </a>
            <?php endif; ?>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
            <?php foreach ($events as $ev): ?>
                <div class="bg-white rounded-lg shadow-sm overflow-hidden hover:shadow-md transition">
                    <?php $img = !empty($ev['image']) ? $ev['image'] : 'assets/images/cards-bg.jpg'; ?>
                    <img src="<?= e($img) ?>" class="w-full h-40 object-cover" alt="">
                    <div class="p-5">
                        <div class="flex items-center space-x-2 mb-2">
                            <span class="text-xs bg-purple-100 text-purple-700 px-2 py-1 rounded-full"><?= e(ucfirst($ev['category'])) ?></span>
                            <?php if (strtotime($ev['event_date']) >= time()): ?>
                                <span class="text-xs bg-green-100 text-green-700 px-2 py-1 rounded-full">Upcoming</span>
                            <?php else: ?>
                                <span class="text-xs bg-gray-100 text-gray-700 px-2 py-1 rounded-full">Past</span>
                            <?php endif; ?>
                        </div>
                        <h3 class="font-bold text-gray-800 mb-2"><?= e($ev['title']) ?></h3>
                        <p class="text-sm text-gray-500 mb-1"><i class="ri-calendar-line"></i> <?= date('M d, Y · g:i A', strtotime($ev['event_date'])) ?></p>
                        <p class="text-sm text-gray-500 mb-3"><i class="ri-map-pin-line"></i> <?= e($ev['location'] ?: 'TBA') ?></p>
                        <a href="index.php?action=event_show&id=<?= $ev['event_id'] ?>" class="text-green-700 font-medium hover:underline">View Details →</a>
                    </div>
                </div>
            <?php endforeach; ?>
            <?php if (empty($events)): ?>
                <div class="col-span-full text-center py-12 text-gray-500">
                    <i class="ri-calendar-line text-5xl"></i>
                    <p class="mt-4">No events yet.</p>
                </div>
            <?php endif; ?>
        </div>
    </div>
</main>
</body>
</html>
