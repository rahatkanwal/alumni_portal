<?php
/**
 * Events Page - University of Agriculture Faisalabad Alumni Portal
 */
require_once __DIR__ . '/includes/public_data.php';
$dbEvents = public_get_events(false);
$dbUpcoming = public_get_events(true);
$featuredEvent = $dbEvents[0] ?? null;
$otherEvents = array_slice($dbEvents, 1);
?>
<!DOCTYPE html>
<html lang="en" dir="ltr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Events - Alumni Portal - University of Agriculture Faisalabad</title>
    
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
        
        .event-tab {
            transition: all 0.3s ease;
        }
        
        .event-tab.active {
            background-color: var(--primary-green);
            color: white;
        }
        
        .event-tab:not(.active) {
            background-color: white;
            color: #374151;
            border: 1px solid #e5e7eb;
        }
        
        .event-tab:not(.active):hover {
            background-color: #f9fafb;
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
                    <span>Events</span>
                </div>
                
                <!-- Main Title -->
                <h1 class="text-5xl md:text-6xl lg:text-7xl font-bold text-center">
                    Events
                </h1>
            </div>
        </section>

        <!-- Sub-Navigation Tabs -->
        <section class="bg-white border-b border-gray-200 sticky top-16 z-40">
            <div class="container mx-auto px-4">
                <div class="flex flex-wrap gap-2 md:gap-4 py-4 overflow-x-auto">
                    <button class="event-tab active px-6 py-3 rounded-lg font-medium text-sm md:text-base whitespace-nowrap" data-tab="alumni-meetups">
                        Alumni-Meetups
                    </button>
                    <button class="event-tab px-6 py-3 rounded-lg font-medium text-sm md:text-base whitespace-nowrap" data-tab="coaching-mentorships">
                        Coaching and Mentorships
                    </button>
                    <button class="event-tab px-6 py-3 rounded-lg font-medium text-sm md:text-base whitespace-nowrap" data-tab="alumni-talks">
                        Alumni-Talks
                    </button>
                    <button class="event-tab px-6 py-3 rounded-lg font-medium text-sm md:text-base whitespace-nowrap" data-tab="alumni-homecoming">
                        Alumni-Homecoming
                    </button>
                    <button class="event-tab px-6 py-3 rounded-lg font-medium text-sm md:text-base whitespace-nowrap" data-tab="news">
                        News
                    </button>
                </div>
            </div>
        </section>

        <!-- Alumni-Meetups Content -->
        <div id="alumni-meetups" class="event-content">
            <?php if ($featuredEvent): ?>
            <!-- Featured Event Section -->
            <section class="py-16 bg-white">
                <div class="container mx-auto px-4">
                    <div class="max-w-4xl mx-auto">
                        <div class="mb-8">
                            <img src="<?= e(public_asset($featuredEvent['image'], 'admin/assets/images/events/event1.jpg')) ?>" alt="<?= e($featuredEvent['title']) ?>" class="w-full h-auto rounded-lg shadow-lg object-cover" style="max-height: 500px;">
                        </div>
                        <div>
                            <div class="flex flex-wrap gap-3 mb-3">
                                <span class="bg-green-100 text-green-700 px-3 py-1 rounded text-sm font-semibold"><?= e(ucfirst($featuredEvent['category'])) ?></span>
                                <span class="text-gray-500 text-sm"><i class="ri-calendar-line"></i> <?= date('M d, Y · g:i A', strtotime($featuredEvent['event_date'])) ?></span>
                                <?php if ($featuredEvent['location']): ?>
                                    <span class="text-gray-500 text-sm"><i class="ri-map-pin-line"></i> <?= e($featuredEvent['location']) ?></span>
                                <?php endif; ?>
                            </div>
                            <h2 class="text-3xl md:text-4xl font-bold text-gray-800 mb-4">
                                <?= e($featuredEvent['title']) ?>
                            </h2>
                            <p class="text-gray-700 text-lg leading-relaxed mb-6">
                                <?= e(substr($featuredEvent['description'], 0, 400)) ?><?= strlen($featuredEvent['description']) > 400 ? '...' : '' ?>
                            </p>
                            <a href="admin/index.php?action=event_show&id=<?= $featuredEvent['event_id'] ?>" class="inline-block bg-green-700 text-white px-6 py-3 rounded-lg hover:bg-green-800 transition font-medium">
                                View Details & RSVP
                            </a>
                        </div>
                    </div>
                </div>
            </section>
            <?php endif; ?>

            <!-- Event Cards Grid -->
            <section class="py-16 bg-gray-50">
                <div class="container mx-auto px-4">
                    <?php if (!empty($otherEvents)): ?>
                        <h2 class="text-2xl font-bold text-gray-800 mb-8">More Events</h2>
                        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                            <?php foreach ($otherEvents as $ev): ?>
                                <a href="admin/index.php?action=event_show&id=<?= $ev['event_id'] ?>" class="bg-white rounded-lg shadow-md overflow-hidden hover:shadow-lg transition block">
                                    <div class="aspect-video bg-gray-200">
                                        <img src="<?= e(public_asset($ev['image'], 'admin/assets/images/events/event2.jpg')) ?>" alt="<?= e($ev['title']) ?>" class="w-full h-full object-cover">
                                    </div>
                                    <div class="p-6">
                                        <div class="flex items-center gap-2 text-gray-500 text-sm mb-2 flex-wrap">
                                            <span class="bg-green-100 text-green-700 px-2 py-1 rounded text-xs font-semibold"><?= e(ucfirst($ev['category'])) ?></span>
                                            <span><?= date('M d, Y · g:i A', strtotime($ev['event_date'])) ?></span>
                                        </div>
                                        <h3 class="text-xl font-bold text-gray-800 mb-3"><?= e($ev['title']) ?></h3>
                                        <p class="text-gray-600 text-sm leading-relaxed"><?= e(substr($ev['description'], 0, 130)) ?>...</p>
                                        <?php if ($ev['location']): ?>
                                            <p class="text-xs text-gray-500 mt-3"><i class="ri-map-pin-line"></i> <?= e($ev['location']) ?></p>
                                        <?php endif; ?>
                                    </div>
                                </a>
                            <?php endforeach; ?>
                        </div>
                    <?php elseif (empty($featuredEvent)): ?>
                        <div class="text-center py-16">
                            <i class="ri-calendar-line text-6xl text-gray-300"></i>
                            <h2 class="text-2xl font-bold text-gray-700 mt-4">No events scheduled yet</h2>
                            <p class="text-gray-500 mt-2">Check back soon for upcoming alumni events.</p>
                        </div>
                    <?php endif; ?>
                </div>
            </section>
        </div>

        <!-- Coaching and Mentorships Content (Hidden by default) -->
        <div id="coaching-mentorships" class="event-content hidden">
            <section class="py-16 bg-white">
                <div class="container mx-auto px-4">
                    <div class="text-center">
                        <h2 class="text-3xl md:text-4xl font-bold text-gray-800 mb-4">
                            Coaching and Mentorships
                        </h2>
                        <p class="text-gray-600 text-lg">
                            Content for Coaching and Mentorships will be displayed here.
                        </p>
                    </div>
                </div>
            </section>
        </div>

        <!-- Alumni-Talks Content (Hidden by default) -->
        <div id="alumni-talks" class="event-content hidden">
            <section class="py-16 bg-white">
                <div class="container mx-auto px-4">
                    <div class="text-center">
                        <h2 class="text-3xl md:text-4xl font-bold text-gray-800 mb-4">
                            Alumni-Talks
                        </h2>
                        <p class="text-gray-600 text-lg">
                            Content for Alumni-Talks will be displayed here.
                        </p>
                    </div>
                </div>
            </section>
        </div>

        <!-- Alumni-Homecoming Content (Hidden by default) -->
        <div id="alumni-homecoming" class="event-content hidden">
            <section class="py-16 bg-white">
                <div class="container mx-auto px-4">
                    <div class="text-center">
                        <h2 class="text-3xl md:text-4xl font-bold text-gray-800 mb-4">
                            Alumni-Homecoming
                        </h2>
                        <p class="text-gray-600 text-lg">
                            Content for Alumni-Homecoming will be displayed here.
                        </p>
                    </div>
                </div>
            </section>
        </div>

        <!-- News Content (Hidden by default) -->
        <div id="news" class="event-content hidden">
            <section class="py-16 bg-white">
                <div class="container mx-auto px-4">
                    <div class="text-center">
                        <h2 class="text-3xl md:text-4xl font-bold text-gray-800 mb-4">
                            News
                        </h2>
                        <p class="text-gray-600 text-lg">
                            Content for News will be displayed here.
                        </p>
                    </div>
                </div>
            </section>
        </div>

    </main>

    <?php include 'includes/footer.php'; ?>

    <?php include 'includes/scripts.php'; ?>
    
    <script>
        // Event Tab Switching
        document.addEventListener('DOMContentLoaded', function() {
            const tabs = document.querySelectorAll('.event-tab');
            const contents = document.querySelectorAll('.event-content');
            
            tabs.forEach(tab => {
                tab.addEventListener('click', function() {
                    const targetTab = this.getAttribute('data-tab');
                    
                    // Remove active class from all tabs
                    tabs.forEach(t => t.classList.remove('active'));
                    // Add active class to clicked tab
                    this.classList.add('active');
                    
                    // Hide all content
                    contents.forEach(content => {
                        content.classList.add('hidden');
                    });
                    
                    // Show target content
                    const targetContent = document.getElementById(targetTab);
                    if (targetContent) {
                        targetContent.classList.remove('hidden');
                    }
                });
            });
        });
    </script>
</body>
</html>

