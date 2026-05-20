<?php
$isEdit = isset($event);
$pageTitle = $isEdit ? 'Edit Event' : 'Create Event';
$ev = $isEdit ? $event : [];
?>
<!DOCTYPE html>
<html lang="en">
<?php include __DIR__ . '/../shared/head.php'; ?>
<body class="bg-gray-50">
<?php include __DIR__ . '/../shared/sidebar.php'; ?>
<?php include __DIR__ . '/../shared/header.php'; ?>
<main class="lg:ml-64 pt-20 min-h-screen">
    <div class="p-6 max-w-3xl mx-auto">
        <h1 class="text-2xl font-bold text-gray-800 mb-6"><?= $isEdit ? 'Edit' : 'Create New' ?> Event</h1>

        <form method="POST" enctype="multipart/form-data" action="index.php?action=<?= $isEdit ? 'event_edit&id=' . e($ev['event_id']) : 'event_create' ?>" class="bg-white rounded-lg shadow-sm p-6 space-y-4">
            <input type="hidden" name="csrf_token" value="<?= csrf_token() ?>">
            <?php if ($isEdit): ?><input type="hidden" name="event_id" value="<?= e($ev['event_id']) ?>"><?php endif; ?>

            <div>
                <label class="block text-sm font-medium mb-1">Title *</label>
                <input name="title" required value="<?= e($ev['title'] ?? '') ?>" class="w-full px-4 py-2 border rounded-lg focus:ring-2 focus:ring-green-500">
            </div>
            <div>
                <label class="block text-sm font-medium mb-1">Description *</label>
                <textarea name="description" required rows="5" class="w-full px-4 py-2 border rounded-lg focus:ring-2 focus:ring-green-500"><?= e($ev['description'] ?? '') ?></textarea>
            </div>
            <div class="grid grid-cols-2 gap-4">
                <div>
                    <label class="block text-sm font-medium mb-1">Date &amp; Time *</label>
                    <input type="datetime-local" name="event_date" required value="<?= $isEdit ? date('Y-m-d\TH:i', strtotime($ev['event_date'])) : '' ?>" class="w-full px-4 py-2 border rounded-lg">
                </div>
                <div>
                    <label class="block text-sm font-medium mb-1">Category</label>
                    <select name="category" class="w-full px-4 py-2 border rounded-lg">
                        <?php foreach (['general','reunion','workshop','seminar','networking','sports','cultural'] as $cat): ?>
                            <option value="<?= $cat ?>" <?= (($ev['category'] ?? '') === $cat) ? 'selected' : '' ?>><?= ucfirst($cat) ?></option>
                        <?php endforeach; ?>
                    </select>
                </div>
            </div>
            <div>
                <label class="block text-sm font-medium mb-1">Location</label>
                <input name="location" value="<?= e($ev['location'] ?? '') ?>" class="w-full px-4 py-2 border rounded-lg">
            </div>
            <div class="grid grid-cols-2 gap-4">
                <div>
                    <label class="block text-sm font-medium mb-1">Latitude (optional)</label>
                    <input name="latitude" type="number" step="any" value="<?= e($ev['latitude'] ?? '') ?>" class="w-full px-4 py-2 border rounded-lg">
                </div>
                <div>
                    <label class="block text-sm font-medium mb-1">Longitude (optional)</label>
                    <input name="longitude" type="number" step="any" value="<?= e($ev['longitude'] ?? '') ?>" class="w-full px-4 py-2 border rounded-lg">
                </div>
            </div>
            <div>
                <label class="block text-sm font-medium mb-1">Cover Image</label>
                <input type="file" name="image" accept="image/*" class="w-full px-4 py-2 border rounded-lg">
                <?php if (!empty($ev['image'])): ?>
                    <p class="text-xs text-gray-500 mt-1">Current: <?= e($ev['image']) ?></p>
                <?php endif; ?>
            </div>
            <div class="flex space-x-3 pt-3">
                <button class="bg-green-700 text-white px-6 py-2 rounded-lg hover:bg-green-800"><?= $isEdit ? 'Update' : 'Create' ?> Event</button>
                <a href="index.php?action=events" class="px-6 py-2 border rounded-lg hover:bg-gray-100">Cancel</a>
            </div>
        </form>
    </div>
</main>
</body>
</html>
