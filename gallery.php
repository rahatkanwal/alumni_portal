<?php
/**
 * Photo Gallery Page - Public photos from UAF Alumni events
 */
require_once __DIR__ . '/includes/public_data.php';
$photos = public_get_gallery();
?>
<!DOCTYPE html>
<html lang="en" dir="ltr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Photo Gallery - Alumni Portal - University of Agriculture Faisalabad</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800;900&display=swap" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/remixicon@3.5.0/fonts/remixicon.css" rel="stylesheet">
    <style>body { font-family: 'Inter', sans-serif; }</style>
</head>
<body class="bg-white">
    <?php include 'includes/header.php'; ?>

    <main>
        <section class="relative h-[40vh] w-full overflow-hidden">
            <img src="admin/assets/images/events/slide1.svg" alt="Photo Gallery" class="w-full h-full object-cover">
            <div class="absolute inset-0 bg-black/40 flex items-center justify-center">
                <div class="text-center text-white px-4">
                    <h1 class="text-5xl md:text-6xl font-bold mb-3">Photo Gallery</h1>
                    <p class="text-lg text-green-100">Moments from UAF alumni events &amp; gatherings</p>
                </div>
            </div>
        </section>

        <section class="py-16 bg-gray-50">
            <div class="container mx-auto px-4">
                <?php if (!empty($photos)): ?>
                    <p class="text-gray-600 mb-8 text-center"><?= count($photos) ?> photo<?= count($photos) === 1 ? '' : 's' ?> in the gallery</p>
                    <div class="grid grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-4">
                        <?php foreach ($photos as $p): ?>
                            <div class="bg-white rounded-lg shadow-sm overflow-hidden group cursor-pointer"
                                 onclick="openLightbox('<?= e(public_asset($p['image'])) ?>', '<?= e($p['title'] ?? '') ?>', '<?= e($p['event_title'] ?? '') ?>')">
                                <img src="<?= e(public_asset($p['image'])) ?>" alt="<?= e($p['title'] ?? 'Gallery photo') ?>" class="w-full h-56 object-cover group-hover:scale-105 transition duration-300">
                                <?php if (!empty($p['title']) || !empty($p['event_title'])): ?>
                                    <div class="p-3 text-sm">
                                        <?php if (!empty($p['title'])): ?><p class="font-medium text-gray-800"><?= e($p['title']) ?></p><?php endif; ?>
                                        <?php if (!empty($p['event_title'])): ?><p class="text-xs text-gray-500"><i class="ri-calendar-line"></i> <?= e($p['event_title']) ?></p><?php endif; ?>
                                    </div>
                                <?php endif; ?>
                            </div>
                        <?php endforeach; ?>
                    </div>
                <?php else: ?>
                    <div class="text-center py-16">
                        <i class="ri-gallery-line text-7xl text-gray-300"></i>
                        <h2 class="text-2xl font-bold text-gray-700 mt-4">No photos yet</h2>
                        <p class="text-gray-500 mt-2">Photos from upcoming alumni events will appear here.</p>
                    </div>
                <?php endif; ?>
            </div>
        </section>
    </main>

    <!-- Lightbox -->
    <div id="lightbox" class="hidden fixed inset-0 bg-black/90 z-50 items-center justify-center p-4" onclick="closeLightbox()">
        <div class="text-center max-w-5xl">
            <img id="lightboxImg" class="max-w-full max-h-[80vh] object-contain mx-auto">
            <p id="lightboxTitle" class="text-white mt-4 font-medium"></p>
            <p id="lightboxEvent" class="text-gray-300 text-sm"></p>
            <button onclick="closeLightbox()" class="mt-4 text-white bg-white/20 px-4 py-2 rounded-lg hover:bg-white/30">Close</button>
        </div>
    </div>

    <script>
        function openLightbox(src, title, event) {
            document.getElementById('lightboxImg').src = src;
            document.getElementById('lightboxTitle').textContent = title || '';
            document.getElementById('lightboxEvent').textContent = event ? '📅 ' + event : '';
            const lb = document.getElementById('lightbox');
            lb.classList.remove('hidden');
            lb.classList.add('flex');
        }
        function closeLightbox() {
            const lb = document.getElementById('lightbox');
            lb.classList.add('hidden');
            lb.classList.remove('flex');
        }
    </script>

    <?php include 'includes/footer.php'; ?>
    <?php include 'includes/scripts.php'; ?>
</body>
</html>
