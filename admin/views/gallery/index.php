<?php $pageTitle = 'Photo Gallery'; ?>
<!DOCTYPE html>
<html lang="en">
<?php include __DIR__ . '/../shared/head.php'; ?>
<body class="bg-gray-50">
<?php include __DIR__ . '/../shared/sidebar.php'; ?>
<?php include __DIR__ . '/../shared/header.php'; ?>
<main class="lg:ml-64 pt-20 min-h-screen">
    <div class="p-6">
        <?php include __DIR__ . '/../shared/flash.php'; ?>
        <h1 class="text-2xl font-bold mb-6">Photo Gallery</h1>

        <!-- Upload Form -->
        <div class="bg-white rounded-lg shadow-sm p-4 mb-6">
            <form method="POST" enctype="multipart/form-data" action="index.php?action=gallery_upload" class="grid grid-cols-1 md:grid-cols-4 gap-3 items-end">
                <input type="hidden" name="csrf_token" value="<?= csrf_token() ?>">
                <div>
                    <label class="block text-xs font-medium mb-1">Photo</label>
                    <input type="file" name="image" accept="image/*" required class="w-full px-3 py-2 border rounded text-sm">
                </div>
                <div>
                    <label class="block text-xs font-medium mb-1">Title (optional)</label>
                    <input name="title" class="w-full px-3 py-2 border rounded text-sm">
                </div>
                <div>
                    <label class="block text-xs font-medium mb-1">Link to Event (optional)</label>
                    <select name="event_id" class="w-full px-3 py-2 border rounded text-sm">
                        <option value="">— None —</option>
                        <?php foreach ($events as $ev): ?>
                            <option value="<?= $ev['event_id'] ?>"><?= e($ev['title']) ?></option>
                        <?php endforeach; ?>
                    </select>
                </div>
                <button class="bg-green-700 text-white py-2 rounded hover:bg-green-800 text-sm">Upload Photo</button>
            </form>
        </div>

        <!-- Photo Grid -->
        <div class="grid grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-4">
            <?php foreach ($photos as $p): ?>
                <div class="bg-white rounded-lg shadow-sm overflow-hidden group relative">
                    <img src="<?= e($p['image']) ?>" class="w-full h-48 object-cover cursor-pointer" onclick="openLightbox('<?= e($p['image']) ?>', '<?= e($p['title'] ?? '') ?>')">
                    <?php if (!empty($p['title']) || !empty($p['event_title'])): ?>
                        <div class="p-2 text-sm">
                            <?php if (!empty($p['title'])): ?><p class="font-medium"><?= e($p['title']) ?></p><?php endif; ?>
                            <?php if (!empty($p['event_title'])): ?><p class="text-xs text-gray-500"><?= e($p['event_title']) ?></p><?php endif; ?>
                        </div>
                    <?php endif; ?>
                    <?php if ($p['uploaded_by'] == $_SESSION['user_id'] || $_SESSION['role'] === 'admin'): ?>
                        <form method="POST" action="index.php?action=gallery_delete" class="absolute top-2 right-2 opacity-0 group-hover:opacity-100 transition" onsubmit="return confirm('Delete?')">
                            <input type="hidden" name="csrf_token" value="<?= csrf_token() ?>">
                            <input type="hidden" name="photo_id" value="<?= e($p['photo_id']) ?>">
                            <button class="bg-red-500 text-white p-1 rounded text-xs"><i class="ri-delete-bin-line"></i></button>
                        </form>
                    <?php endif; ?>
                </div>
            <?php endforeach; ?>
            <?php if (empty($photos)): ?>
                <div class="col-span-full text-center py-12 text-gray-500">
                    <i class="ri-gallery-line text-5xl"></i>
                    <p class="mt-4">No photos yet. Upload the first one!</p>
                </div>
            <?php endif; ?>
        </div>
    </div>
</main>

<div id="lightbox" class="hidden fixed inset-0 bg-black bg-opacity-90 z-50 flex items-center justify-center p-4" onclick="closeLightbox()">
    <img id="lightboxImg" class="max-w-full max-h-full object-contain">
</div>
<script>
function openLightbox(src, title) {
    document.getElementById('lightboxImg').src = src;
    document.getElementById('lightbox').classList.remove('hidden');
}
function closeLightbox() { document.getElementById('lightbox').classList.add('hidden'); }
</script>
</body>
</html>
