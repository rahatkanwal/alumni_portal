<?php $pageTitle = $event['title']; ?>
<!DOCTYPE html>
<html lang="en">
<?php include __DIR__ . '/../shared/head.php'; ?>
<body class="bg-gray-50">
<?php include __DIR__ . '/../shared/sidebar.php'; ?>
<?php include __DIR__ . '/../shared/header.php'; ?>
<main class="lg:ml-64 pt-20 min-h-screen">
    <div class="p-6 max-w-4xl mx-auto">
        <?php include __DIR__ . '/../shared/flash.php'; ?>
        <a href="index.php?action=events" class="text-green-700 hover:underline mb-4 inline-flex items-center"><i class="ri-arrow-left-line"></i> Back to Events</a>

        <div class="bg-white rounded-lg shadow-sm overflow-hidden">
            <?php $img = !empty($event['image']) ? $event['image'] : 'assets/images/cards-bg.jpg'; ?>
            <img src="<?= e($img) ?>" class="w-full h-64 object-cover" alt="">
            <div class="p-6">
                <div class="flex items-start justify-between flex-wrap mb-4">
                    <div>
                        <span class="text-xs bg-purple-100 text-purple-700 px-2 py-1 rounded-full"><?= e(ucfirst($event['category'])) ?></span>
                        <h1 class="text-3xl font-bold text-gray-800 mt-2"><?= e($event['title']) ?></h1>
                    </div>
                    <?php if (($_SESSION['role'] ?? '') === 'admin'): ?>
                        <div class="flex space-x-2">
                            <a href="index.php?action=event_edit&id=<?= $event['event_id'] ?>" class="bg-yellow-500 text-white px-3 py-2 rounded-lg hover:bg-yellow-600 text-sm">
                                <i class="ri-edit-line"></i> Edit
                            </a>
                            <form method="POST" action="index.php?action=event_delete" onsubmit="return confirm('Delete this event?')">
                                <input type="hidden" name="csrf_token" value="<?= csrf_token() ?>">
                                <input type="hidden" name="event_id" value="<?= e($event['event_id']) ?>">
                                <button class="bg-red-500 text-white px-3 py-2 rounded-lg hover:bg-red-600 text-sm"><i class="ri-delete-bin-line"></i> Delete</button>
                            </form>
                        </div>
                    <?php endif; ?>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-3 gap-4 mb-6">
                    <div class="bg-gray-50 p-4 rounded-lg">
                        <p class="text-xs text-gray-500">DATE &amp; TIME</p>
                        <p class="font-semibold"><?= date('M d, Y · g:i A', strtotime($event['event_date'])) ?></p>
                    </div>
                    <div class="bg-gray-50 p-4 rounded-lg">
                        <p class="text-xs text-gray-500">LOCATION</p>
                        <p class="font-semibold"><?= e($event['location'] ?: 'TBA') ?></p>
                    </div>
                    <div class="bg-gray-50 p-4 rounded-lg">
                        <p class="text-xs text-gray-500">ATTENDEES</p>
                        <p class="font-semibold"><?= e($rsvpCount) ?> going</p>
                    </div>
                </div>

                <h3 class="font-bold text-gray-800 mb-2">About this event</h3>
                <p class="text-gray-600 whitespace-pre-line"><?= e($event['description']) ?></p>

                <?php if (strtotime($event['event_date']) >= time()): ?>
                    <div class="mt-6 pt-6 border-t border-gray-200">
                        <h3 class="font-bold text-gray-800 mb-3">Will you attend?</h3>
                        <form method="POST" action="index.php?action=event_rsvp" class="flex space-x-2">
                            <input type="hidden" name="csrf_token" value="<?= csrf_token() ?>">
                            <input type="hidden" name="event_id" value="<?= e($event['event_id']) ?>">
                            <button name="status" value="going" class="px-4 py-2 rounded-lg <?= ($rsvp && $rsvp['status']==='going') ? 'bg-green-700 text-white' : 'bg-gray-100 hover:bg-gray-200' ?>">
                                <i class="ri-check-line"></i> Going
                            </button>
                            <button name="status" value="maybe" class="px-4 py-2 rounded-lg <?= ($rsvp && $rsvp['status']==='maybe') ? 'bg-yellow-500 text-white' : 'bg-gray-100 hover:bg-gray-200' ?>">
                                <i class="ri-question-line"></i> Maybe
                            </button>
                            <button name="status" value="not_going" class="px-4 py-2 rounded-lg <?= ($rsvp && $rsvp['status']==='not_going') ? 'bg-red-500 text-white' : 'bg-gray-100 hover:bg-gray-200' ?>">
                                <i class="ri-close-line"></i> Not Going
                            </button>
                        </form>
                    </div>
                <?php endif; ?>
            </div>
        </div>
    </div>
</main>
</body>
</html>
