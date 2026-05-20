<?php
/**
 * Jobs Page - University of Agriculture Faisalabad Alumni Portal
 */
require_once __DIR__ . '/includes/public_data.php';
$dbJobs = public_get_jobs();
?>
<!DOCTYPE html>
<html lang="en" dir="ltr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Career Opportunities - Alumni Portal - University of Agriculture Faisalabad</title>
    
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
        
        .section-title {
            position: relative;
            display: inline-block;
        }
        
        .section-title::after {
            content: '';
            position: absolute;
            bottom: -8px;
            left: 0;
            width: 100%;
            height: 3px;
            background: var(--primary-green);
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
                    <span>Career Opportunities</span>
                </div>
                
                <!-- Main Title -->
                <h1 class="text-5xl md:text-6xl lg:text-7xl font-bold text-center">
                    Career Opportunities
                </h1>
            </div>
        </section>

        <!-- Search Section -->
        <section class="py-8 bg-white">
            <div class="container mx-auto px-4">
                <div class="max-w-4xl mx-auto">
                    <div class="flex gap-2">
                        <input 
                            type="text" 
                            placeholder="Search jobs by title, location, or company..." 
                            class="flex-1 px-6 py-3 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-green-700 focus:border-transparent"
                        >
                        <button class="bg-green-700 text-white px-6 py-3 rounded-lg hover:bg-green-800 transition">
                            <i class="ri-search-line text-xl"></i>
                        </button>
                    </div>
                </div>
            </div>
        </section>

        <!-- Jobs Sections -->
        <section class="py-16 bg-amber-50">
            <div class="container mx-auto px-4">
                <div class="grid grid-cols-1 lg:grid-cols-2 gap-8 lg:gap-12 max-w-7xl mx-auto">
                    
                    <!-- Left Column - UAF Jobs -->
                    <div>
                        <h2 class="text-3xl md:text-4xl font-bold text-gray-800 mb-2 section-title">
                            The University of Agriculture Faisalabad Jobs
                        </h2>
                        <p class="text-gray-600 text-lg mb-6">
                            Explore career opportunities at The University of Agriculture Faisalabad
                        </p>
                        
                        <!-- UAF Career Card -->
                        <div class="bg-white rounded-lg shadow-lg overflow-hidden">
                            <div class="aspect-video bg-gradient-to-br from-purple-400 to-purple-600 flex items-end justify-center p-8">
                                <div class="text-white text-6xl font-bold">CAREERS</div>
                            </div>
                            <div class="p-6">
                                <div class="flex items-start gap-4 mb-4">
                                    <div class="w-12 h-12 bg-green-700 rounded-lg flex items-center justify-center flex-shrink-0">
                                        <i class="ri-briefcase-line text-white text-2xl"></i>
                                    </div>
                                    <div class="flex-1">
                                        <h3 class="text-xl font-bold text-gray-800 mb-2">Visit UAF Career Portal</h3>
                                        <p class="text-gray-600 text-sm leading-relaxed">
                                            Explore more UAF jobs and career opportunities on our official Career Portal. Discover your next career move with The University of Agriculture Faisalabad.
                                        </p>
                                    </div>
                                </div>
                                <a href="#" class="inline-flex items-center gap-2 bg-green-700 text-white px-6 py-3 rounded-lg hover:bg-green-800 transition font-medium">
                                    EXPLORE JOBS
                                    <i class="ri-external-link-line"></i>
                                </a>
                            </div>
                        </div>
                    </div>
                    
                    <!-- Right Column - Open Jobs from Alumni Network -->
                    <div>
                        <h2 class="text-3xl md:text-4xl font-bold text-gray-800 mb-2 section-title">
                            Alumni Network Jobs
                        </h2>
                        <p class="text-gray-600 text-lg mb-6">
                            Career opportunities posted by alumni and partner organizations
                        </p>

                        <?php if (!empty($dbJobs)): ?>
                            <div class="space-y-4">
                                <?php foreach (array_slice($dbJobs, 0, 4) as $j): ?>
                                <a href="admin/index.php?action=job_show&id=<?= $j['job_id'] ?>" class="block bg-white rounded-lg shadow-md p-5 hover:shadow-lg transition">
                                    <div class="flex items-start justify-between gap-3">
                                        <div class="flex-1">
                                            <span class="inline-block bg-pink-100 text-pink-700 text-xs font-semibold px-3 py-1 rounded-full mb-2"><?= e(strtoupper($j['job_type'])) ?></span>
                                            <h3 class="text-lg font-bold text-gray-800"><?= e($j['title']) ?></h3>
                                            <p class="text-sm text-gray-600 mt-1">
                                                <i class="ri-building-line text-green-700"></i> <?= e($j['company']) ?>
                                                <?php if ($j['location']): ?>
                                                    · <i class="ri-map-pin-line text-green-700"></i> <?= e($j['location']) ?>
                                                <?php endif; ?>
                                            </p>
                                            <?php if ($j['salary_range']): ?>
                                                <p class="text-sm text-green-700 font-medium mt-1"><i class="ri-money-dollar-circle-line"></i> <?= e($j['salary_range']) ?></p>
                                            <?php endif; ?>
                                            <p class="text-xs text-gray-400 mt-2">Posted <?= date('M d, Y', strtotime($j['created_at'])) ?></p>
                                        </div>
                                        <i class="ri-arrow-right-line text-green-700 text-xl"></i>
                                    </div>
                                </a>
                                <?php endforeach; ?>
                            </div>
                            <?php if (count($dbJobs) > 4): ?>
                                <a href="admin/index.php?action=jobs" class="block mt-4 text-center text-green-700 hover:underline font-medium">View all <?= count($dbJobs) ?> jobs →</a>
                            <?php endif; ?>
                        <?php else: ?>
                            <div class="bg-white rounded-lg shadow-lg p-12 text-center">
                                <i class="ri-briefcase-line text-5xl text-gray-300"></i>
                                <p class="text-gray-600 text-lg mt-4">
                                    No jobs posted yet. Be the first to <a href="admin/index.php?action=job_create" class="text-green-700 hover:underline font-medium">post one</a>.
                                </p>
                            </div>
                        <?php endif; ?>
                    </div>
                    
                </div>
            </div>
        </section>

        <!-- All Open Jobs Section -->
        <section class="py-16 bg-white">
            <div class="container mx-auto px-4">
                <div class="max-w-7xl mx-auto">
                    <h2 class="text-3xl md:text-4xl font-bold text-gray-800 mb-4">
                        All Open Opportunities
                    </h2>
                    <p class="text-gray-600 text-lg mb-8">
                        Browse all currently open positions posted by UAF alumni and partner organizations.
                    </p>

                    <?php if (!empty($dbJobs)): ?>
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                            <?php foreach ($dbJobs as $j): ?>
                            <a href="admin/index.php?action=job_show&id=<?= $j['job_id'] ?>" class="block bg-white border border-gray-200 rounded-lg shadow-md overflow-hidden hover:shadow-lg transition relative">
                                <div class="absolute top-4 right-4 flex items-center gap-2">
                                    <span class="bg-green-100 text-green-700 text-xs font-semibold px-3 py-1 rounded-full">OPEN</span>
                                </div>
                                <div class="p-6 pt-12">
                                    <span class="inline-block bg-pink-100 text-pink-700 text-xs font-semibold px-3 py-1 rounded-full mb-4"><?= e(strtoupper($j['job_type'])) ?></span>
                                    <h3 class="text-xl font-bold text-gray-800 mb-4"><?= e($j['title']) ?></h3>
                                    <div class="space-y-2 text-sm text-gray-600">
                                        <div class="flex items-center gap-2">
                                            <i class="ri-building-line text-green-700"></i>
                                            <span><?= e($j['company']) ?></span>
                                        </div>
                                        <?php if ($j['location']): ?>
                                            <div class="flex items-center gap-2">
                                                <i class="ri-map-pin-line text-green-700"></i>
                                                <span><?= e($j['location']) ?></span>
                                            </div>
                                        <?php endif; ?>
                                        <div class="flex items-center gap-2">
                                            <i class="ri-calendar-line text-green-700"></i>
                                            <span>Posted: <?= date('F j, Y', strtotime($j['created_at'])) ?></span>
                                        </div>
                                        <?php if ($j['deadline']): ?>
                                            <div class="flex items-center gap-2">
                                                <i class="ri-time-line text-green-700"></i>
                                                <span>Deadline: <?= date('F j, Y', strtotime($j['deadline'])) ?></span>
                                            </div>
                                        <?php endif; ?>
                                        <?php if ($j['salary_range']): ?>
                                            <div class="flex items-center gap-2">
                                                <i class="ri-money-dollar-circle-line text-green-700"></i>
                                                <span class="font-medium text-green-700"><?= e($j['salary_range']) ?></span>
                                            </div>
                                        <?php endif; ?>
                                    </div>
                                </div>
                            </a>
                            <?php endforeach; ?>
                        </div>
                    <?php else: ?>
                        <div class="bg-gray-50 rounded-lg p-16 text-center">
                            <i class="ri-briefcase-line text-6xl text-gray-300"></i>
                            <p class="text-gray-500 mt-4">No open positions at the moment. Check back soon!</p>
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

