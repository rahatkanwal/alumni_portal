<?php
/**
 * Newsletters / News Page - University of Agriculture Faisalabad Alumni Portal
 * Displays announcements posted by admin from the database.
 */
require_once __DIR__ . '/includes/public_data.php';
$announcements = public_get_announcements();
?>
<!DOCTYPE html>
<html lang="en" dir="ltr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Newsletters - Alumni Portal - University of Agriculture Faisalabad</title>
    
    <!-- Tailwind CSS -->
    <script src="https://cdn.tailwindcss.com"></script>
    
    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800;900&display=swap" rel="stylesheet">
    
    <!-- Remix Icons -->
    <link href="https://cdn.jsdelivr.net/npm/remixicon@3.5.0/fonts/remixicon.css" rel="stylesheet">
    
    <style>
        :root {
            --primary-green: #1a5f3f;
            --primary-green-dark: #0f4a2f;
            --primary-green-light: #2d7a5a;
        }
        
        body {
            font-family: 'Inter', sans-serif;
        }
        
        /* Sidebar Styles */
        #sidebarMenu {
            max-width: 320px;
        }
        
        .banner-overlay {
            background: linear-gradient(to bottom, rgba(0,0,0,0.3), rgba(0,0,0,0.5));
        }
        
        .newsletter-card {
            transition: transform 0.3s ease, box-shadow 0.3s ease;
        }
        
        .newsletter-card:hover {
            transform: translateY(-4px);
            box-shadow: 0 8px 20px rgba(0,0,0,0.12);
        }
    </style>
</head>
<body class="bg-gray-50">

    <?php include 'includes/header.php'; ?>

    <!-- Main Content -->
    <main>
        
        <!-- Banner Section -->
        <section class="relative h-[60vh] md:h-[70vh] w-full overflow-hidden">
            <!-- Campus Image -->
            <div class="absolute inset-0">
                <img src="admin/assets/images/buildings/building1.png" alt="University Campus" class="w-full h-full object-cover">
                <div class="absolute inset-0 banner-overlay"></div>
            </div>
            
            <!-- Breadcrumb and Title Overlay -->
            <div class="absolute inset-0 flex flex-col justify-center items-center text-white px-4">
                <!-- Breadcrumb -->
                <div class="mb-6 flex items-center gap-2 text-white text-sm md:text-base">
                    <a href="index.php" class="hover:text-green-300 transition">
                        <i class="ri-home-line"></i>
                    </a>
                    <span class="mx-2">/</span>
                    <span>Newsletters</span>
                </div>
                
                <!-- Main Title -->
                <h1 class="text-5xl md:text-6xl lg:text-7xl font-bold text-center">
                    Newsletters
                </h1>
            </div>
        </section>


        <!-- Announcements / News Section -->
        <section class="py-16 bg-white">
            <div class="container mx-auto px-4">
                <div class="max-w-6xl mx-auto">
                    <?php if (!empty($announcements)): ?>
                        <div class="space-y-8">
                            <?php foreach ($announcements as $a): ?>
                            <div class="bg-gray-100 rounded-lg overflow-hidden newsletter-card">
                                <div class="grid grid-cols-1 lg:grid-cols-2">

                                    <!-- Left: Image with overlay -->
                                    <div class="relative aspect-video lg:aspect-auto min-h-[280px]">
                                        <?php $img = !empty($a['image']) ? public_asset($a['image']) : 'admin/assets/images/events/event1.jpg'; ?>
                                        <img src="<?= e($img) ?>" alt="<?= e($a['title']) ?>" class="w-full h-full object-cover">

                                        <div class="absolute inset-0 bg-gradient-to-t from-black/70 via-black/30 to-transparent p-6 flex flex-col justify-between">
                                            <div class="flex justify-between items-start">
                                                <div class="flex items-center gap-3">
                                                    <div class="w-12 h-12 bg-white rounded-full flex items-center justify-center">
                                                        <i class="ri-megaphone-line text-green-700 text-2xl"></i>
                                                    </div>
                                                    <div>
                                                        <h3 class="text-white font-bold text-xl">UAF Alumni News</h3>
                                                        <p class="text-white/80 text-xs">OFFICIAL ANNOUNCEMENT</p>
                                                    </div>
                                                </div>
                                                <div class="text-right">
                                                    <p class="text-white text-xs font-medium"><?= date('F Y', strtotime($a['created_at'])) ?></p>
                                                    <p class="text-white text-xs"><?= date('M d, Y', strtotime($a['created_at'])) ?></p>
                                                </div>
                                            </div>
                                            <div class="mt-auto">
                                                <p class="text-white text-sm leading-relaxed line-clamp-3">
                                                    <?= e(substr($a['body'], 0, 220)) ?><?= strlen($a['body']) > 220 ? '...' : '' ?>
                                                </p>
                                            </div>
                                        </div>
                                    </div>

                                    <!-- Right: Title + Read More -->
                                    <div class="p-8 flex flex-col justify-center bg-white">
                                        <div class="mb-6">
                                            <p class="text-gray-500 text-sm mb-2"><?= strtoupper(date('F Y', strtotime($a['created_at']))) ?></p>
                                            <h2 class="text-3xl md:text-4xl font-bold text-gray-800 mb-4"><?= e($a['title']) ?></h2>
                                            <p class="text-gray-600"><?= e(substr($a['body'], 0, 180)) ?>...</p>
                                        </div>
                                        <a href="admin/index.php?action=news_show&id=<?= $a['announcement_id'] ?>" class="inline-block bg-green-700 text-white px-8 py-3 rounded-lg hover:bg-green-800 transition font-medium text-center">
                                            Read Full Announcement
                                        </a>
                                    </div>
                                </div>
                            </div>
                            <?php endforeach; ?>
                        </div>
                    <?php else: ?>
                        <div class="bg-gray-50 rounded-lg p-16 text-center">
                            <i class="ri-megaphone-line text-6xl text-gray-300"></i>
                            <h2 class="text-2xl font-bold text-gray-700 mt-4">No announcements yet</h2>
                            <p class="text-gray-500 mt-2">Check back soon for the latest UAF alumni news and announcements.</p>
                        </div>
                    <?php endif; ?>
                </div>
            </div>
        </section>

    </main>

    <?php include 'includes/footer.php'; ?>

    <?php include 'includes/scripts.php'; ?>
</body>
</html>

