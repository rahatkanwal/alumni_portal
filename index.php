<?php
/**
 * Homepage - University of Agriculture Faisalabad Alumni Portal
 */
require_once __DIR__ . '/includes/public_data.php';
$homeUpcomingEvents = public_get_events(true, 3);
$homeRecentNews = public_get_announcements(3);
$homeFeaturedStories = public_get_stories(3);
$homeRecentJobs = public_get_jobs(4);
$homeStats = public_stats();
$homeFeaturedAlumni = public_get_featured_alumni(5);
$homeMentors = public_get_mentors(5);
$homeAllEvents = public_get_events(false, 4);
$featureCounts = public_get_feature_counts();
?>
<!DOCTYPE html>
<html lang="en" dir="ltr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Alumni Portal - University of Agriculture Faisalabad</title>
    
    <!-- Tailwind CSS -->
    <script src="https://cdn.tailwindcss.com"></script>
    
    <!-- Swiper CSS -->
    <link rel="stylesheet" href="admin/assets/css/swiper-bundle.min.css">
    
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
            --accent-pink: #ec4899;
        }
        
        body {
            font-family: 'Inter', sans-serif;
        }
        
        .swiper-button-next,
        .swiper-button-prev {
            color: white !important;
            background: rgba(0, 0, 0, 0.5);
            width: 50px;
            height: 50px;
            border-radius: 50%;
            backdrop-filter: blur(5px);
        }
        
        .swiper-button-next:after,
        .swiper-button-prev:after {
            font-size: 20px;
            font-weight: bold;
        }
        
        .swiper-button-next:hover,
        .swiper-button-prev:hover {
            background: rgba(0, 0, 0, 0.7);
        }
        
        .hero-nav-next,
        .hero-nav-prev {
            z-index: 10;
        }
        
        /* Hero Section Styles */
        .heroSwiper {
            height: 100vh;
        }
        
        .heroSwiper .swiper-slide {
            position: relative;
        }
        
        .heroSwiper .swiper-slide img {
            width: 100%;
            height: 100%;
            object-fit: cover;
        }
        
        /* Fade Effect */
        .heroSwiper .swiper-slide {
            opacity: 0;
            transition: opacity 1s ease-in-out;
        }
        
        .heroSwiper .swiper-slide-active {
            opacity: 1;
        }
        
        /* Sidebar Styles */
        #sidebarMenu {
            max-width: 320px;
        }
        
        /* Bottom Navigation Icons */
        .bottom-nav-icons {
            background: rgba(255, 255, 255, 0.95);
        }
        
        .swiper-pagination-bullet {
            background: var(--accent-pink) !important;
        }
        
        .section-title {
            position: relative;
            display: inline-block;
        }
        
        .section-title span {
            position: relative;
        }
        
        .section-title span::after {
            content: '';
            position: absolute;
            bottom: -8px;
            left: 0;
            width: 100%;
            height: 3px;
            background: var(--primary-green);
        }
        
        .card-hover {
            transition: transform 0.3s ease, box-shadow 0.3s ease;
        }
        
        .card-hover:hover {
            transform: translateY(-5px);
            box-shadow: 0 10px 25px rgba(0,0,0,0.15);
        }
    </style>
</head>
<body class="bg-gray-50">

    <?php include 'includes/header.php'; ?>

    <!-- Main Content -->
    <main>
        
        <!-- Hero Section with Slider -->
        <section class="relative h-screen w-full overflow-hidden">
            <!-- Hero Slider -->
            <div class="swiper heroSwiper h-full w-full">
                <div class="swiper-wrapper">
                    <!-- Slide 6: Alumni Reunion / Mentorship -->
                    <div class="swiper-slide relative">
                        <img src="assets/tower.jpeg" alt="UAF Alumni Mentorship" class="w-full h-full object-cover" width="100px">
                        <div class="absolute inset-0 flex items-center justify-center">
                            <div class="text-center text-white px-4 max-w-4xl">
                                <div class="inline-block mb-6 px-4 py-2 bg-white/20 backdrop-blur rounded-full text-sm font-semibold uppercase tracking-wider">💡 Mentorship Program</div>
                                <h1 class="text-4xl md:text-6xl lg:text-7xl font-bold mb-4 drop-shadow-lg">
                                    Mentor, Inspire,<br>Give Back
                                </h1>
                                <p class="text-lg md:text-xl text-green-100">Share your journey with the next generation of agriculturists</p>
                            </div>
                        </div>
                    </div>
                    <!-- Slide 1: Graduation Celebration -->
                    <div class="swiper-slide relative">
                        <img src="admin/assets/images/events/slide1.svg" alt="UAF Alumni Graduation Celebration" class="w-full h-full object-cover">
                        <div class="absolute inset-0 flex items-center justify-center">
                            <div class="text-center text-white px-4 max-w-4xl">
                                <div class="inline-block mb-6 px-4 py-2 bg-white/20 backdrop-blur rounded-full text-sm font-semibold uppercase tracking-wider">🎓 UAF Alumni Portal</div>
                                <h1 class="text-4xl md:text-6xl lg:text-7xl font-bold mb-4 drop-shadow-lg">
                                    Connecting Futures,<br>Celebrating Legacies
                                </h1>
                                <p class="text-lg md:text-xl text-green-100">Welcome to the University of Agriculture Faisalabad Alumni Network</p>
                            </div>
                        </div>
                    </div>

                    <!-- Slide 2: Alumni Networking -->
                    <div class="swiper-slide relative">
                        <img src="admin/assets/images/events/slide2.svg" alt="UAF Alumni Networking Event" class="w-full h-full object-cover">
                        <div class="absolute inset-0 flex items-center justify-center">
                            <div class="text-center text-white px-4 max-w-4xl">
                                <div class="inline-block mb-6 px-4 py-2 bg-white/20 backdrop-blur rounded-full text-sm font-semibold uppercase tracking-wider">🌐 Global Network</div>
                                <h1 class="text-4xl md:text-6xl lg:text-7xl font-bold mb-4 drop-shadow-lg">
                                    Build Your Network,<br>Grow Together
                                </h1>
                                <p class="text-lg md:text-xl text-green-100">Reconnect with classmates and expand your professional circle</p>
                            </div>
                        </div>
                    </div>

                    <!-- Slide 3: UAF Campus / Academic Heritage -->
                    <div class="swiper-slide relative">
                        <img src="admin/assets/images/events/slide3.svg" alt="UAF Campus" class="w-full h-full object-cover">
                        <div class="absolute inset-0 flex items-center justify-center">
                            <div class="text-center text-white px-4 max-w-4xl">
                                <div class="inline-block mb-6 px-4 py-2 bg-white/20 backdrop-blur rounded-full text-sm font-semibold uppercase tracking-wider">🏛️ Since 1906</div>
                                <h1 class="text-4xl md:text-6xl lg:text-7xl font-bold mb-4 drop-shadow-lg">
                                    Once a UAF Student,<br>Always Family
                                </h1>
                                <p class="text-lg md:text-xl text-green-100">Stay connected with your alma mater for life</p>
                            </div>
                        </div>
                    </div>

                    <!-- Slide 4: Alumni Reunion / Mentorship -->
                    <div class="swiper-slide relative">
                        <img src="admin/assets/images/events/slide4.svg" alt="UAF Alumni Mentorship" class="w-full h-full object-cover">
                        <div class="absolute inset-0 flex items-center justify-center">
                            <div class="text-center text-white px-4 max-w-4xl">
                                <div class="inline-block mb-6 px-4 py-2 bg-white/20 backdrop-blur rounded-full text-sm font-semibold uppercase tracking-wider">💡 Mentorship Program</div>
                                <h1 class="text-4xl md:text-6xl lg:text-7xl font-bold mb-4 drop-shadow-lg">
                                    Mentor, Inspire,<br>Give Back
                                </h1>
                                <p class="text-lg md:text-xl text-green-100">Share your journey with the next generation of agriculturists</p>
                            </div>
                        </div>
                    </div>

                    

                    
                </div>
                
                <!-- Navigation Arrows -->
                <div class="swiper-button-next hero-nav-next"></div>
                <div class="swiper-button-prev hero-nav-prev"></div>
            </div>
            
            <!-- Bottom Navigation Icons -->
            <div class="absolute bottom-0 left-0 right-0 bg-white bg-opacity-90 py-4">
                <div class="container mx-auto px-4">
                    <div class="flex justify-center items-center space-x-4 md:space-x-8">
                        <!-- Icon 1: Home/Portal -->
                        <a href="admin/index.php?action=dashboard" class="flex flex-col items-center p-3 rounded-lg hover:bg-gray-100 transition group">
                            <div class="w-12 h-12 bg-green-700 rounded-lg flex items-center justify-center mb-2 group-hover:bg-green-800 transition">
                                <i class="ri-home-4-line text-white text-2xl"></i>
                            </div>
                            <span class="text-xs text-gray-700 font-medium">Portal</span>
                        </a>
                        
                        <!-- Icon 2: Graduation -->
                        <a href="#mentorship" class="flex flex-col items-center p-3 rounded-lg hover:bg-gray-100 transition group">
                            <div class="w-12 h-12 bg-green-700 rounded-lg flex items-center justify-center mb-2 group-hover:bg-green-800 transition">
                                <i class="ri-graduation-cap-line text-white text-2xl"></i>
                            </div>
                            <span class="text-xs text-gray-700 font-medium">Education</span>
                        </a>
                        
                        <!-- Icon 3: Book/Resources -->
                        <a href="#resources" class="flex flex-col items-center p-3 rounded-lg hover:bg-gray-100 transition group">
                            <div class="w-12 h-12 bg-green-700 rounded-lg flex items-center justify-center mb-2 group-hover:bg-green-800 transition">
                                <i class="ri-book-open-line text-white text-2xl"></i>
                            </div>
                            <span class="text-xs text-gray-700 font-medium">Resources</span>
                        </a>
                        
                        <!-- Icon 4: Announcements -->
                        <a href="#news" class="flex flex-col items-center p-3 rounded-lg hover:bg-gray-100 transition group">
                            <div class="w-12 h-12 bg-green-700 rounded-lg flex items-center justify-center mb-2 group-hover:bg-green-800 transition">
                                <i class="ri-megaphone-line text-white text-2xl"></i>
                            </div>
                            <span class="text-xs text-gray-700 font-medium">News</span>
                        </a>
                        
                        <!-- Icon 5: Achievements -->
                        <a href="#achievements" class="flex flex-col items-center p-3 rounded-lg hover:bg-gray-100 transition group">
                            <div class="w-12 h-12 bg-green-700 rounded-lg flex items-center justify-center mb-2 group-hover:bg-green-800 transition">
                                <i class="ri-award-line text-white text-2xl"></i>
                            </div>
                            <span class="text-xs text-gray-700 font-medium">Achievements</span>
                        </a>
                    </div>
                </div>
            </div>
        </section>

        <!-- Feature Cards Section -->
        <section class="py-16 bg-green-700 relative overflow-hidden">
            <!-- Blurred Background Image -->
            <div class="absolute top-0 left-0 right-0 h-32 overflow-hidden">
                <img src="admin/assets/images/events/event1.jpg" alt="Background" class="w-full h-full object-cover opacity-20 blur-sm">
            </div>
            
            <div class="container mx-auto px-4 relative z-10">
                <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 xl:grid-cols-6 gap-6">
                    
                    <?php
                    // Feature cards driven from real DB counts
                    $featureCards = [
                        ['icon' => 'ri-home-4-line', 'title' => 'National Chapters', 'count' => $featureCounts['national_chapters'], 'members' => $featureCounts['alumni'] . ' Members', 'href' => 'chapters-national.php'],
                        ['icon' => 'ri-global-line', 'title' => 'International Chapters', 'count' => $featureCounts['intl_chapters'], 'members' => '', 'href' => 'chapters-international.php'],
                        ['icon' => 'ri-graduation-cap-line', 'title' => 'Departments', 'count' => $featureCounts['departments'], 'members' => $featureCounts['alumni'] . ' Alumni', 'href' => 'admin/index.php?action=directory'],
                        ['icon' => 'ri-book-open-line', 'title' => 'News &amp; Updates', 'count' => $featureCounts['announcements'], 'members' => '', 'href' => 'newsletters.php'],
                        ['icon' => 'ri-briefcase-line', 'title' => 'Open Jobs', 'count' => $homeStats['jobs'], 'members' => '', 'href' => 'jobs.php'],
                        ['icon' => 'ri-user-star-line', 'title' => 'Active Mentors', 'count' => $featureCounts['mentors'], 'members' => '', 'href' => 'admin/index.php?action=mentorship'],
                    ];
                    foreach ($featureCards as $fc): ?>
                        <a href="<?= e($fc['href']) ?>" class="bg-white rounded-lg p-6 shadow-lg hover:shadow-xl transition-shadow block">
                            <div class="flex flex-col items-center text-center h-full">
                                <div class="w-16 h-16 mb-4 flex items-center justify-center">
                                    <i class="<?= e($fc['icon']) ?> text-green-700 text-5xl"></i>
                                </div>
                                <h3 class="text-green-700 font-bold text-lg mb-2"><?= $fc['title'] ?></h3>
                                <p class="text-gray-600 text-sm mb-1">(<?= e($fc['count']) ?>)</p>
                                <?php if ($fc['members']): ?>
                                    <p class="text-gray-500 text-xs mb-6"><?= e($fc['members']) ?></p>
                                <?php else: ?>
                                    <p class="text-gray-500 text-xs mb-6">&nbsp;</p>
                                <?php endif; ?>
                                <div class="w-10 h-10 rounded-full bg-white border-2 border-green-700 flex items-center justify-center hover:bg-green-700 hover:text-white transition group mt-auto">
                                    <i class="ri-arrow-right-line text-green-700 group-hover:text-white"></i>
                                </div>
                            </div>
                        </a>
                    <?php endforeach; ?>
                    
                </div>
            </div>
        </section>
        <!-- End of Feature Cards Section -->

        <!-- =================== DYNAMIC: LIVE STATS =================== -->
        <section class="py-12 bg-white">
            <div class="container mx-auto px-4">
                <div class="grid grid-cols-2 md:grid-cols-4 gap-6 max-w-5xl mx-auto">
                    <div class="text-center">
                        <p class="text-4xl md:text-5xl font-bold text-green-700"><?= e($homeStats['alumni']) ?>+</p>
                        <p class="text-gray-600 mt-2">Active Alumni</p>
                    </div>
                    <div class="text-center">
                        <p class="text-4xl md:text-5xl font-bold text-green-700"><?= e($homeStats['events']) ?></p>
                        <p class="text-gray-600 mt-2">Events Hosted</p>
                    </div>
                    <div class="text-center">
                        <p class="text-4xl md:text-5xl font-bold text-green-700"><?= e($homeStats['jobs']) ?></p>
                        <p class="text-gray-600 mt-2">Open Jobs</p>
                    </div>
                    <div class="text-center">
                        <p class="text-4xl md:text-5xl font-bold text-green-700"><?= e($homeStats['stories']) ?></p>
                        <p class="text-gray-600 mt-2">Success Stories</p>
                    </div>
                </div>
            </div>
        </section>

        <!-- =================== DYNAMIC: UPCOMING EVENTS =================== -->
        <?php if (!empty($homeUpcomingEvents)): ?>
        <section class="py-16 bg-gray-50">
            <div class="container mx-auto px-4">
                <div class="flex items-end justify-between mb-10">
                    <div>
                        <p class="text-green-700 font-semibold text-sm uppercase tracking-wider">Don't Miss Out</p>
                        <h2 class="text-3xl md:text-4xl font-bold text-gray-800 mt-2">Upcoming Events</h2>
                    </div>
                    <a href="events.php" class="text-green-700 font-medium hover:underline hidden md:inline">View all events →</a>
                </div>
                <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                    <?php foreach ($homeUpcomingEvents as $ev): ?>
                        <a href="admin/index.php?action=event_show&id=<?= $ev['event_id'] ?>" class="bg-white rounded-lg shadow-md overflow-hidden hover:shadow-xl transition block">
                            <div class="relative h-48 bg-gray-200">
                                <img src="<?= e(public_asset($ev['image'], 'admin/assets/images/events/event1.jpg')) ?>" alt="<?= e($ev['title']) ?>" class="w-full h-full object-cover">
                                <div class="absolute top-3 left-3 bg-white text-green-700 px-3 py-2 rounded-lg text-center shadow-md">
                                    <p class="text-xs font-semibold"><?= date('M', strtotime($ev['event_date'])) ?></p>
                                    <p class="text-xl font-bold leading-none"><?= date('d', strtotime($ev['event_date'])) ?></p>
                                </div>
                            </div>
                            <div class="p-5">
                                <span class="inline-block bg-purple-100 text-purple-700 text-xs font-semibold px-2 py-1 rounded-full mb-2"><?= e(ucfirst($ev['category'])) ?></span>
                                <h3 class="font-bold text-gray-800 text-lg mb-2"><?= e($ev['title']) ?></h3>
                                <p class="text-sm text-gray-600 mb-2"><?= e(substr($ev['description'], 0, 100)) ?>...</p>
                                <?php if ($ev['location']): ?>
                                    <p class="text-xs text-gray-500"><i class="ri-map-pin-line"></i> <?= e($ev['location']) ?></p>
                                <?php endif; ?>
                            </div>
                        </a>
                    <?php endforeach; ?>
                </div>
            </div>
        </section>
        <?php endif; ?>

        <!-- =================== DYNAMIC: LATEST NEWS =================== -->
        <?php if (!empty($homeRecentNews)): ?>
        <section class="py-16 bg-white">
            <div class="container mx-auto px-4">
                <div class="flex items-end justify-between mb-10">
                    <div>
                        <p class="text-green-700 font-semibold text-sm uppercase tracking-wider">Stay Informed</p>
                        <h2 class="text-3xl md:text-4xl font-bold text-gray-800 mt-2">Latest News &amp; Announcements</h2>
                    </div>
                    <a href="newsletters.php" class="text-green-700 font-medium hover:underline hidden md:inline">View all news →</a>
                </div>
                <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                    <?php foreach ($homeRecentNews as $n): ?>
                        <a href="admin/index.php?action=news_show&id=<?= $n['announcement_id'] ?>" class="bg-gray-50 rounded-lg overflow-hidden hover:shadow-md transition block">
                            <?php if (!empty($n['image'])): ?>
                                <img src="<?= e(public_asset($n['image'])) ?>" alt="<?= e($n['title']) ?>" class="w-full h-44 object-cover">
                            <?php else: ?>
                                <div class="h-44 bg-gradient-to-br from-green-600 to-green-800 flex items-center justify-center">
                                    <i class="ri-megaphone-line text-white text-6xl"></i>
                                </div>
                            <?php endif; ?>
                            <div class="p-5">
                                <p class="text-xs text-gray-500 mb-2"><?= date('F d, Y', strtotime($n['created_at'])) ?></p>
                                <h3 class="font-bold text-gray-800 text-lg mb-2"><?= e($n['title']) ?></h3>
                                <p class="text-sm text-gray-600"><?= e(substr($n['body'], 0, 110)) ?>...</p>
                            </div>
                        </a>
                    <?php endforeach; ?>
                </div>
            </div>
        </section>
        <?php endif; ?>

        <!-- =================== DYNAMIC: SUCCESS STORIES =================== -->
        <?php if (!empty($homeFeaturedStories)): ?>
        <section class="py-16 bg-gradient-to-br from-green-50 to-white">
            <div class="container mx-auto px-4">
                <div class="flex items-end justify-between mb-10">
                    <div>
                        <p class="text-green-700 font-semibold text-sm uppercase tracking-wider">Alumni Inspiration</p>
                        <h2 class="text-3xl md:text-4xl font-bold text-gray-800 mt-2">Success Stories</h2>
                    </div>
                    <a href="success-stories.php" class="text-green-700 font-medium hover:underline hidden md:inline">View all stories →</a>
                </div>
                <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                    <?php foreach ($homeFeaturedStories as $s): ?>
                        <a href="admin/index.php?action=story_show&id=<?= $s['story_id'] ?>" class="bg-white rounded-lg shadow-md overflow-hidden hover:shadow-xl transition block">
                            <?php if (!empty($s['image'])): ?>
                                <img src="<?= e(public_asset($s['image'])) ?>" alt="<?= e($s['title']) ?>" class="w-full h-48 object-cover">
                            <?php endif; ?>
                            <div class="p-5">
                                <?php if ($s['is_featured']): ?>
                                    <span class="inline-block bg-yellow-100 text-yellow-700 text-xs font-semibold px-2 py-1 rounded-full mb-2"><i class="ri-star-fill"></i> Featured</span>
                                <?php endif; ?>
                                <h3 class="font-bold text-gray-800 text-lg mb-2"><?= e($s['title']) ?></h3>
                                <p class="text-sm text-gray-600 mb-3"><?= e(substr($s['story'], 0, 110)) ?>...</p>
                                <div class="flex items-center space-x-2 text-xs text-gray-500">
                                    <?php $pic = !empty($s['profile_picture']) ? public_asset($s['profile_picture']) : 'admin/assets/images/avatar-with-laptop.png'; ?>
                                    <img src="<?= e($pic) ?>" class="w-7 h-7 rounded-full object-cover" alt="">
                                    <span><?= e($s['name']) ?> · Class of <?= e($s['graduation_year'] ?? 'N/A') ?></span>
                                </div>
                            </div>
                        </a>
                    <?php endforeach; ?>
                </div>
            </div>
        </section>
        <?php endif; ?>

        <!-- =================== DYNAMIC: OPEN JOBS PREVIEW =================== -->
        <?php if (!empty($homeRecentJobs)): ?>
        <section class="py-16 bg-white">
            <div class="container mx-auto px-4">
                <div class="flex items-end justify-between mb-10">
                    <div>
                        <p class="text-green-700 font-semibold text-sm uppercase tracking-wider">Career Opportunities</p>
                        <h2 class="text-3xl md:text-4xl font-bold text-gray-800 mt-2">Open Positions</h2>
                    </div>
                    <a href="jobs.php" class="text-green-700 font-medium hover:underline hidden md:inline">View all jobs →</a>
                </div>
                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                    <?php foreach ($homeRecentJobs as $j): ?>
                        <a href="admin/index.php?action=job_show&id=<?= $j['job_id'] ?>" class="bg-gray-50 hover:bg-gray-100 rounded-lg p-5 transition flex items-start gap-3">
                            <div class="bg-green-100 text-green-700 p-3 rounded-lg flex-shrink-0">
                                <i class="ri-briefcase-line text-2xl"></i>
                            </div>
                            <div class="flex-1 min-w-0">
                                <div class="flex items-center gap-2 flex-wrap mb-1">
                                    <span class="inline-block bg-pink-100 text-pink-700 text-xs font-semibold px-2 py-1 rounded-full"><?= e(strtoupper($j['job_type'])) ?></span>
                                    <?php if ($j['salary_range']): ?>
                                        <span class="text-xs text-green-700 font-medium"><?= e($j['salary_range']) ?></span>
                                    <?php endif; ?>
                                </div>
                                <h3 class="font-bold text-gray-800 truncate"><?= e($j['title']) ?></h3>
                                <p class="text-sm text-gray-600"><?= e($j['company']) ?><?= $j['location'] ? ' · ' . e($j['location']) : '' ?></p>
                                <p class="text-xs text-gray-400 mt-1">Posted <?= date('M d, Y', strtotime($j['created_at'])) ?></p>
                            </div>
                            <i class="ri-arrow-right-line text-green-700 text-xl"></i>
                        </a>
                    <?php endforeach; ?>
                </div>
            </div>
        </section>
        <?php endif; ?>

        <!-- Office of Alumni Relations Section -->
        <section id="alumni-relations" class="py-16 bg-white">
            <div class="container mx-auto px-4">
                <!-- Section Title -->
                <div class="mb-12">
                    <h2 class="text-4xl md:text-5xl font-bold text-green-700 mb-4 section-title flex items-center gap-3">
                        <i class="ri-graduation-cap-line text-5xl"></i>
                        Office of Alumni <span class="relative">Relations<span class="absolute bottom-0 left-0 w-full h-1 bg-green-700"></span></span>
                    </h2>
                </div>
                
                <!-- Two Column Layout -->
                <div class="grid grid-cols-1 lg:grid-cols-2 gap-8 lg:gap-12">
                    <!-- Left Column -->
                    <div class="space-y-8">
                        <!-- Welcome Message -->
                        <div>
                            <p class="text-gray-700 text-lg leading-relaxed">
                                Welcome Alumni! As a UAF graduate, you are part of a thriving global community of alumni across the globe. The Office of Alumni Relations keeps you connected to your alma mater through meaningful engagement, collaboration, and opportunities for continued growth. Together, we celebrate our shared journey and strengthen a vibrant network that inspires success across generations.
                            </p>
                        </div>
                        
                        <!-- Alumni Count (DYNAMIC) -->
                        <div class="grid grid-cols-2 gap-4">
                            <div class="flex items-center gap-3 bg-gray-50 p-5 rounded-lg">
                                <div class="w-14 h-14 bg-green-700 rounded-full flex items-center justify-center">
                                    <i class="ri-graduation-cap-line text-white text-2xl"></i>
                                </div>
                                <div>
                                    <p class="text-3xl md:text-4xl font-bold text-green-700"><?= e($homeStats['alumni']) ?>+</p>
                                    <p class="text-gray-600 text-sm">Registered Alumni</p>
                                </div>
                            </div>
                            <div class="flex items-center gap-3 bg-gray-50 p-5 rounded-lg">
                                <div class="w-14 h-14 bg-green-700 rounded-full flex items-center justify-center">
                                    <i class="ri-map-pin-line text-white text-2xl"></i>
                                </div>
                                <div>
                                    <p class="text-3xl md:text-4xl font-bold text-green-700"><?= e($featureCounts['national_chapters'] + $featureCounts['intl_chapters']) ?></p>
                                    <p class="text-gray-600 text-sm">Cities Worldwide</p>
                                </div>
                            </div>
                        </div>
                    </div>
                    
                    <!-- Right Column -->
                    <div class="space-y-6">
                        <!-- Alumni Honor Card Visualization (DYNAMIC sample) -->
                        <?php
                        // Pick a sample alumni (first featured) to display on the card, or fall back to placeholder
                        $sampleCard = $homeFeaturedAlumni[0] ?? null;
                        $cardName = $sampleCard['name'] ?? 'Your Name Here';
                        $cardDept = $sampleCard['department'] ?? 'Your Department';
                        $cardPic = !empty($sampleCard['profile_picture']) ? public_asset($sampleCard['profile_picture']) : 'admin/assets/images/avatar-with-laptop.png';
                        $cardId = $sampleCard ? str_pad($sampleCard['user_id'], 7, '0', STR_PAD_LEFT) : '0000000';
                        $cardGradYear = $sampleCard['graduation_year'] ?? date('Y');
                        ?>
                        <div class="bg-white border-2 border-green-700 rounded-lg p-6 shadow-lg">
                            <div class="flex items-start justify-between mb-4">
                                <div>
                                    <h3 class="text-green-700 font-bold text-sm mb-1">THE UNIVERSITY OF AGRICULTURE</h3>
                                    <p class="text-green-700 font-bold text-xs">FAISALABAD</p>
                                </div>
                                <div class="w-20 h-20 bg-gray-200 rounded-full overflow-hidden">
                                    <img src="<?= e($cardPic) ?>" alt="Alumni Photo" class="w-full h-full object-cover">
                                </div>
                            </div>

                            <div class="space-y-2 mb-4">
                                <p class="text-green-700 font-bold text-lg"><?= e($cardName) ?></p>
                                <p class="text-green-700 text-sm"><?= e($cardDept) ?></p>
                                <p class="text-green-700 text-sm">Class of <?= e($cardGradYear) ?></p>
                            </div>

                            <div class="grid grid-cols-2 gap-4 mb-4">
                                <div>
                                    <p class="text-gray-600 text-xs mb-1">ALUMNI ID</p>
                                    <p class="text-gray-800 font-semibold">UAF-<?= e($cardId) ?></p>
                                </div>
                                <div>
                                    <p class="text-gray-600 text-xs mb-1">VALIDITY</p>
                                    <p class="text-gray-800 font-semibold">Lifetime</p>
                                </div>
                            </div>

                            <div class="border-t border-gray-300 pt-4 space-y-2">
                                <div class="flex items-center gap-2 text-gray-600 text-xs">
                                    <i class="ri-map-pin-line"></i>
                                    <p>The University of Agriculture, Faisalabad</p>
                                </div>
                                <div class="flex items-center gap-2 text-gray-600 text-xs">
                                    <i class="ri-phone-line"></i>
                                    <p>041 9200161-70</p>
                                </div>
                            </div>
                        </div>
                        
                        <!-- Alumni Honor Card Title and Description -->
                        <div>
                            <h3 class="text-2xl md:text-3xl font-bold text-green-700 mb-4">Alumni Honor Card</h3>
                            <p class="text-gray-700 text-lg leading-relaxed mb-6">
                                The University of Agriculture Faisalabad's Alumni Honor Card offers exclusive perks and privileges to the alumni. With this card, you can access a range of benefits, including scholarships, healthcare services, upskill courses, mentorships, discounts on campus services and partner organizations.
                            </p>
                            <a href="admin/index.php?action=honor_card_apply" class="inline-block bg-green-700 text-white px-8 py-3 rounded-md hover:bg-green-800 transition font-medium text-lg">
                                Apply Now
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        
        <!-- Distinguished Alumni Section -->
        <section id="distinguished-alumni" class="py-16 bg-white">
            <div class="container mx-auto px-4">
                <div class="flex justify-between items-start mb-8">
                    <div>
                        <h2 class="text-4xl md:text-5xl font-bold text-green-700 mb-4 section-title">
                            Distinguished <span class="relative">Alumni<span class="absolute bottom-0 left-0 w-full h-1 bg-green-700"></span></span>
                        </h2>
                    </div>
                    <a href="#distinguished-alumni" class="hidden md:block bg-green-700 text-white px-6 py-3 rounded-md hover:bg-green-800 transition font-medium">
                        View All
                    </a>
                </div>
                
                <!-- Distinguished Alumni Carousel (DYNAMIC) -->
                <?php if (!empty($homeFeaturedAlumni)): ?>
                <div class="swiper distinguishedAlumniSwiper mt-8 relative">
                    <div class="swiper-button-next"></div>
                    <div class="swiper-button-prev"></div>
                    <div class="swiper-wrapper">
                        <?php foreach ($homeFeaturedAlumni as $alu): ?>
                        <div class="swiper-slide">
                            <div class="bg-white rounded-lg shadow-md overflow-hidden card-hover">
                                <div class="flex flex-col items-center p-6">
                                    <div class="w-32 h-32 rounded-full bg-gray-200 overflow-hidden mb-4">
                                        <?php $pic = !empty($alu['profile_picture']) ? public_asset($alu['profile_picture']) : 'admin/assets/images/avatar-with-laptop.png'; ?>
                                        <img src="<?= e($pic) ?>" alt="<?= e($alu['name']) ?>" class="w-full h-full object-cover">
                                    </div>
                                    <div class="text-center w-full">
                                        <div class="flex items-center justify-center gap-2 mb-2">
                                            <h3 class="font-bold text-gray-800 text-lg"><?= e($alu['name']) ?><?= $alu['graduation_year'] ? ', ' . e($alu['graduation_year']) : '' ?></h3>
                                            <a href="admin/index.php?action=directory_profile&id=<?= e($alu['user_id']) ?>" class="text-green-700 hover:text-green-800">
                                                <i class="ri-external-link-line text-lg"></i>
                                            </a>
                                        </div>
                                        <p class="text-gray-700 text-sm">
                                            <?= e($alu['current_job'] ?? '') ?><?= !empty($alu['company']) ? ' · ' . e($alu['company']) : '' ?>
                                        </p>
                                        <?php if (!empty($alu['department'])): ?>
                                            <p class="text-gray-500 text-xs mt-1"><?= e($alu['department']) ?></p>
                                        <?php endif; ?>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <?php endforeach; ?>
                    </div>
                    <div class="swiper-pagination mt-6"></div>
                </div>
                <?php else: ?>
                <div class="bg-gray-50 rounded-lg p-12 text-center">
                    <i class="ri-user-star-line text-5xl text-gray-300"></i>
                    <p class="text-gray-500 mt-4">Distinguished alumni profiles will appear here as alumni complete their profiles.</p>
                </div>
                <?php endif; ?>
            </div>
        </section>
        
        <!-- Events and Meetups Section -->
        <section id="events-meetups" class="py-16 bg-white">
            <div class="container mx-auto px-4">
                <div class="flex justify-between items-start mb-8">
                    <div>
                        <h2 class="text-4xl md:text-5xl font-bold text-green-700 mb-4 section-title">
                            Events and <span class="relative">Meetups<span class="absolute bottom-0 left-0 w-full h-1 bg-green-700"></span></span>
                        </h2>
                    </div>
                    <a href="#events" class="hidden md:block bg-green-700 text-white px-6 py-3 rounded-md hover:bg-green-800 transition font-medium">
                        See More Events
                    </a>
                </div>
                
                <!-- Events Grid (DYNAMIC) -->
                <?php if (!empty($homeAllEvents)): ?>
                <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6 mt-8">
                    <?php foreach ($homeAllEvents as $idx => $ev): ?>
                        <a href="admin/index.php?action=event_show&id=<?= e($ev['event_id']) ?>" class="bg-white rounded-lg shadow-md overflow-hidden card-hover block">
                            <div class="aspect-video bg-gray-200">
                                <?php $img = !empty($ev['image']) ? public_asset($ev['image']) : 'admin/assets/images/events/event' . (($idx % 4) + 1) . '.jpg'; ?>
                                <img src="<?= e($img) ?>" alt="<?= e($ev['title']) ?>" class="w-full h-full object-cover">
                            </div>
                            <div class="p-4">
                                <p class="text-gray-600 text-sm mb-2"><?= date('M d, Y', strtotime($ev['event_date'])) ?></p>
                                <h3 class="font-bold text-gray-800 text-lg"><?= e($ev['title']) ?></h3>
                                <?php if ($ev['location']): ?>
                                    <p class="text-xs text-gray-500 mt-2"><i class="ri-map-pin-line"></i> <?= e($ev['location']) ?></p>
                                <?php endif; ?>
                            </div>
                        </a>
                    <?php endforeach; ?>
                </div>
                <?php else: ?>
                <div class="bg-gray-50 rounded-lg p-12 text-center mt-8">
                    <i class="ri-calendar-line text-5xl text-gray-300"></i>
                    <p class="text-gray-500 mt-4">No events yet. Check back soon!</p>
                </div>
                <?php endif; ?>
            </div>
        </section>
        
        <!-- Section 1: Coaching and Mentorship -->
        <section id="mentorship" class="py-16 bg-white">
            <div class="container mx-auto px-4">
                <div class="flex justify-between items-start mb-8">
                    <div>
                        <h2 class="text-4xl md:text-5xl font-bold text-green-700 mb-4 section-title">
                            Coaching and <span class="relative">Mentorship<span class="absolute bottom-0 left-0 w-full h-1 bg-green-700"></span></span>
                        </h2>
                        <p class="text-gray-600 text-lg max-w-3xl mt-6">
                            The Alumni Mentorship Program connects current students and recent graduates with experienced alumni who provide guidance, career advice, and professional development support. Our mentors share their expertise to help the next generation of UAF graduates succeed.
                        </p>
                    </div>
                    <a href="#events" class="hidden md:block bg-green-700 text-white px-6 py-3 rounded-md hover:bg-green-800 transition font-medium">
                        See More Events
                    </a>
                </div>
                
                <!-- Mentorship Carousel (DYNAMIC) -->
                <?php if (!empty($homeMentors)): ?>
                <div class="swiper mentorshipSwiper mt-8 relative">
                    <div class="swiper-button-next"></div>
                    <div class="swiper-button-prev"></div>
                    <div class="swiper-wrapper">
                        <?php foreach ($homeMentors as $m): ?>
                        <div class="swiper-slide">
                            <div class="bg-white rounded-lg shadow-md overflow-hidden card-hover">
                                <div class="aspect-square bg-green-50 flex items-center justify-center">
                                    <?php if (!empty($m['profile_picture'])): ?>
                                        <img src="<?= e(public_asset($m['profile_picture'])) ?>" alt="<?= e($m['name']) ?>" class="w-full h-full object-cover">
                                    <?php else: ?>
                                        <svg viewBox="0 0 160 160" class="w-32 h-32" role="img" aria-label="Mentor icon" xmlns="http://www.w3.org/2000/svg">
                                            <circle cx="80" cy="80" r="72" fill="#dcfce7"/>
                                            <circle cx="80" cy="54" r="24" fill="#15803d"/>
                                            <path d="M38 128c6-26 22-40 42-40s36 14 42 40" fill="#15803d"/>
                                            <path d="M44 42 80 24l36 18-36 18-36-18Z" fill="#166534"/>
                                            <path d="M116 42v24" stroke="#166534" stroke-width="8" stroke-linecap="round"/>
                                            <circle cx="116" cy="72" r="6" fill="#166534"/>
                                            <path d="M54 116h52" stroke="#ffffff" stroke-width="8" stroke-linecap="round"/>
                                            <path d="M66 103h28" stroke="#ffffff" stroke-width="7" stroke-linecap="round"/>
                                        </svg>
                                    <?php endif; ?>
                                </div>
                                <div class="p-4">
                                    <div class="flex items-start justify-between">
                                        <div>
                                            <h3 class="font-bold text-gray-800 text-lg"><?= e($m['name']) ?></h3>
                                            <p class="text-gray-600 text-sm"><?= e($m['graduation_year'] ?? '') ?><?= !empty($m['department']) ? ' · ' . e($m['department']) : '' ?></p>
                                            <p class="text-gray-700 mt-1 text-sm"><?= e($m['current_job'] ?? '') ?><?= !empty($m['company']) ? ' · ' . e($m['company']) : '' ?></p>
                                            <?php if (!empty($m['expertise'])): ?>
                                                <p class="text-green-700 mt-2 text-xs"><i class="ri-lightbulb-line"></i> <?= e(substr($m['expertise'], 0, 60)) ?></p>
                                            <?php endif; ?>
                                        </div>
                                        <a href="admin/index.php?action=mentorship" class="text-green-700 hover:text-green-800">
                                            <i class="ri-external-link-line text-xl"></i>
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <?php endforeach; ?>
                    </div>
                    <div class="swiper-pagination mt-6"></div>
                </div>
                <?php else: ?>
                <div class="bg-gray-50 rounded-lg p-12 text-center mt-8">
                    <i class="ri-graduation-cap-line text-5xl text-gray-300"></i>
                    <h3 class="text-xl font-bold text-gray-700 mt-3">No mentors registered yet</h3>
                    <p class="text-gray-500 mt-2">Alumni can volunteer as mentors from their dashboard.</p>
                    <a href="admin/index.php?action=mentorship" class="inline-block mt-4 bg-green-700 text-white px-6 py-2 rounded hover:bg-green-800">Become a Mentor</a>
                </div>
                <?php endif; ?>
            </div>
        </section>

        <!-- Section: Upcoming Engagements (DYNAMIC - real upcoming events) -->
        <section id="engagements" class="py-16 bg-gray-50">
            <div class="container mx-auto px-4">
                <div class="flex justify-between items-start mb-8">
                    <div>
                        <h2 class="text-3xl md:text-4xl lg:text-5xl font-bold text-green-700 mb-4">
                            Upcoming <span class="section-title">Engagements</span>
                        </h2>
                        <p class="text-gray-600 text-lg max-w-3xl mt-3">
                            Register for upcoming UAF alumni events. Stay engaged with your alma mater.
                        </p>
                    </div>
                    <a href="events.php" class="hidden md:block bg-green-700 text-white px-6 py-3 rounded-md hover:bg-green-800 transition font-medium">
                        See All Events
                    </a>
                </div>

                <?php $homeUpcomingWide = public_get_events(true, 4); ?>
                <?php if (!empty($homeUpcomingWide)): ?>
                <div class="swiper engagementsSwiper mt-8 relative">
                    <div class="swiper-button-next"></div>
                    <div class="swiper-button-prev"></div>
                    <div class="swiper-wrapper">
                        <?php foreach ($homeUpcomingWide as $idx => $ev): ?>
                        <div class="swiper-slide">
                            <div class="bg-white rounded-lg shadow-md overflow-hidden card-hover h-full">
                                <div class="aspect-video bg-gray-200">
                                    <?php if (!empty($ev['image'])): ?>
                                        <img src="<?= e(public_asset($ev['image'])) ?>" alt="<?= e($ev['title']) ?>" class="w-full h-full object-cover">
                                    <?php else: ?>
                                        <div class="w-full h-full bg-gradient-to-br from-green-600 to-green-800 flex items-center justify-center">
                                            <i class="ri-calendar-event-line text-6xl text-white opacity-80"></i>
                                        </div>
                                    <?php endif; ?>
                                </div>
                                <div class="p-4">
                                    <p class="text-gray-600 text-sm mb-2"><?= date('F d, Y', strtotime($ev['event_date'])) ?></p>
                                    <h3 class="font-bold text-gray-800 text-lg mb-3"><?= e($ev['title']) ?></h3>
                                    <a href="admin/index.php?action=event_show&id=<?= e($ev['event_id']) ?>" class="text-green-700 hover:text-green-800 font-medium">Register Now →</a>
                                </div>
                            </div>
                        </div>
                        <?php endforeach; ?>
                    </div>
                    <div class="swiper-pagination mt-6"></div>
                </div>
                <?php else: ?>
                <div class="bg-white rounded-lg p-12 text-center mt-8">
                    <i class="ri-calendar-event-line text-5xl text-gray-300"></i>
                    <p class="text-gray-500 mt-4">No upcoming engagements scheduled. New events will appear here as they are announced.</p>
                </div>
                <?php endif; ?>
            </div>
        </section>

        <!-- Section: Alumni Wall (DYNAMIC - real alumni profile pictures) -->
        <?php
        // Get up to 20 alumni with profile pictures for the wall
        $wallConn = pdo_conn();
        $wallAlumni = [];
        if ($wallConn) {
            $wallAlumni = $wallConn->query("SELECT a.user_id, a.name, a.profile_picture, a.graduation_year
                                            FROM alumni a INNER JOIN users u ON a.user_id=u.user_id
                                            WHERE u.status='active'
                                            ORDER BY a.profile_picture IS NULL, RAND()
                                            LIMIT 20")->fetchAll();
        }
        ?>
        <?php if (!empty($wallAlumni)): ?>
        <section class="py-16 bg-white">
            <div class="container mx-auto px-4">
                <h2 class="text-3xl md:text-4xl lg:text-5xl font-bold text-green-700 mb-2 text-center">
                    Alumni Wall
                </h2>
                <p class="text-center text-gray-500 mb-8">Meet some of our <?= $homeStats['alumni'] ?> registered UAF alumni</p>

                <div class="swiper alumniWallSwiper relative">
                    <div class="swiper-button-next"></div>
                    <div class="swiper-button-prev"></div>
                    <div class="swiper-wrapper">
                        <?php foreach ($wallAlumni as $a): ?>
                        <div class="swiper-slide">
                            <a href="admin/index.php?action=directory_profile&id=<?= e($a['user_id']) ?>" class="block group">
                                <div class="aspect-square rounded-full overflow-hidden border-4 border-transparent group-hover:border-green-700 transition">
                                    <?php if (!empty($a['profile_picture'])): ?>
                                        <img src="<?= e(public_asset($a['profile_picture'])) ?>" alt="<?= e($a['name']) ?>" class="w-full h-full object-cover">
                                    <?php else: ?>
                                        <div class="w-full h-full bg-green-50 flex items-center justify-center">
                                            <svg viewBox="0 0 120 120" class="w-20 h-20" role="img" aria-label="Alumni profile icon" xmlns="http://www.w3.org/2000/svg">
                                                <circle cx="60" cy="60" r="56" fill="#dcfce7"/>
                                                <path d="M29 42 60 26l31 16-31 16-31-16Z" fill="#15803d"/>
                                                <path d="M42 54v12c0 8 8 15 18 15s18-7 18-15V54L60 64 42 54Z" fill="#16a34a"/>
                                                <circle cx="60" cy="47" r="14" fill="#166534"/>
                                                <path d="M30 99c5-18 17-28 30-28s25 10 30 28" fill="#15803d"/>
                                                <path d="M91 42v23" stroke="#166534" stroke-width="6" stroke-linecap="round"/>
                                                <circle cx="91" cy="70" r="5" fill="#166534"/>
                                            </svg>
                                        </div>
                                    <?php endif; ?>
                                </div>
                                <p class="text-center text-xs text-gray-700 mt-2 font-medium truncate"><?= e($a['name']) ?></p>
                                <?php if ($a['graduation_year']): ?>
                                    <p class="text-center text-xs text-gray-500">'<?= e(substr($a['graduation_year'], -2)) ?></p>
                                <?php endif; ?>
                            </a>
                        </div>
                        <?php endforeach; ?>
                    </div>
                    <div class="swiper-pagination mt-6"></div>
                </div>

                <div class="text-center mt-8">
                    <a href="admin/index.php?action=directory" class="inline-block bg-green-700 text-white px-6 py-3 rounded-md hover:bg-green-800 transition font-medium">
                        View Full Directory →
                    </a>
                </div>
            </div>
        </section>
        <?php endif; ?>

        <!-- Section 6: Reconnect & Contribute CTA -->
        <section class="py-20 bg-green-700">
            <div class="container mx-auto px-4">
                <div class="max-w-4xl mx-auto text-center text-white">
                    <h2 class="text-3xl md:text-4xl lg:text-5xl font-bold mb-6">Reconnect & Contribute</h2>
                    <p class="text-xl md:text-2xl mb-8 text-green-100">
                        Sign up today to connect with fellow alumni and shape the UAF legacy.
                    </p>
                    <a href="admin/index.php?action=register" class="inline-block bg-white text-green-700 px-8 py-4 rounded-md hover:bg-gray-100 transition font-bold text-lg">
                        Register Now →
                    </a>
                </div>
            </div>
        </section>

    </main>

    <?php include 'includes/footer.php'; ?>

    <!-- Swiper JS -->
    <script src="admin/assets/js/swiper-bundle.min.js"></script>
    
    <script>
        // Initialize Swiper instances
        const distinguishedAlumniSwiper = new Swiper('.distinguishedAlumniSwiper', {
            slidesPerView: 1,
            spaceBetween: 20,
            pagination: {
                el: '.distinguishedAlumniSwiper .swiper-pagination',
                clickable: true,
            },
            navigation: {
                nextEl: '.distinguishedAlumniSwiper .swiper-button-next',
                prevEl: '.distinguishedAlumniSwiper .swiper-button-prev',
            },
            loop: true,
            breakpoints: {
                640: {
                    slidesPerView: 2,
                },
                768: {
                    slidesPerView: 3,
                },
                1024: {
                    slidesPerView: 4,
                },
                1280: {
                    slidesPerView: 5,
                },
            },
        });

        const mentorshipSwiper = new Swiper('.mentorshipSwiper', {
            slidesPerView: 1,
            spaceBetween: 20,
            pagination: {
                el: '.mentorshipSwiper .swiper-pagination',
                clickable: true,
            },
            navigation: {
                nextEl: '.mentorshipSwiper .swiper-button-next',
                prevEl: '.mentorshipSwiper .swiper-button-prev',
            },
            loop: true,
            breakpoints: {
                640: {
                    slidesPerView: 2,
                },
                768: {
                    slidesPerView: 3,
                },
                1024: {
                    slidesPerView: 4,
                },
            },
        });

        const eventsSwiper = new Swiper('.eventsSwiper', {
            slidesPerView: 1,
            spaceBetween: 20,
            pagination: {
                el: '.eventsSwiper .swiper-pagination',
                clickable: true,
            },
            navigation: {
                nextEl: '.eventsSwiper .swiper-button-next',
                prevEl: '.eventsSwiper .swiper-button-prev',
            },
            loop: true,
            breakpoints: {
                640: {
                    slidesPerView: 2,
                },
                768: {
                    slidesPerView: 3,
                },
                1024: {
                    slidesPerView: 4,
                },
            },
        });

        const mentorshipEventsSwiper = new Swiper('.mentorshipEventsSwiper', {
            slidesPerView: 1,
            spaceBetween: 20,
            pagination: {
                el: '.mentorshipEventsSwiper .swiper-pagination',
                clickable: true,
            },
            navigation: {
                nextEl: '.mentorshipEventsSwiper .swiper-button-next',
                prevEl: '.mentorshipEventsSwiper .swiper-button-prev',
            },
            loop: true,
            breakpoints: {
                640: {
                    slidesPerView: 2,
                },
                768: {
                    slidesPerView: 3,
                },
            },
        });

        const engagementsSwiper = new Swiper('.engagementsSwiper', {
            slidesPerView: 1,
            spaceBetween: 20,
            pagination: {
                el: '.engagementsSwiper .swiper-pagination',
                clickable: true,
            },
            navigation: {
                nextEl: '.engagementsSwiper .swiper-button-next',
                prevEl: '.engagementsSwiper .swiper-button-prev',
            },
            loop: true,
            breakpoints: {
                640: {
                    slidesPerView: 2,
                },
                768: {
                    slidesPerView: 3,
                },
                1024: {
                    slidesPerView: 4,
                },
            },
        });

        const alumniWallSwiper = new Swiper('.alumniWallSwiper', {
            slidesPerView: 3,
            spaceBetween: 20,
            pagination: {
                el: '.alumniWallSwiper .swiper-pagination',
                clickable: true,
            },
            navigation: {
                nextEl: '.alumniWallSwiper .swiper-button-next',
                prevEl: '.alumniWallSwiper .swiper-button-prev',
            },
            loop: true,
            breakpoints: {
                640: {
                    slidesPerView: 5,
                },
                768: {
                    slidesPerView: 7,
                },
                1024: {
                    slidesPerView: 10,
                },
            },
        });

        // Hero Swiper with Auto-play
        const heroSwiper = new Swiper('.heroSwiper', {
            slidesPerView: 1,
            spaceBetween: 0,
            loop: true,
            speed: 1000,
            autoplay: {
                delay: 5000,
                disableOnInteraction: false,
                pauseOnMouseEnter: true,
            },
            effect: 'fade',
            fadeEffect: {
                crossFade: true
            },
            navigation: {
                nextEl: '.hero-nav-next',
                prevEl: '.hero-nav-prev',
            },
        });
    </script>
    
    <?php include 'includes/scripts.php'; ?>
</body>
</html>
