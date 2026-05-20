<?php
/**
 * International Chapters Page - University of Agriculture Faisalabad Alumni Portal
 */
?>
<!DOCTYPE html>
<html lang="en" dir="ltr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>International Chapters - Alumni Portal - University of Agriculture Faisalabad</title>
    
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
        
        .flag-container {
            aspect-ratio: 1;
            border-radius: 12px;
            overflow: hidden;
            box-shadow: 0 2px 8px rgba(0,0,0,0.1);
            transition: transform 0.3s ease, box-shadow 0.3s ease;
        }
        
        .flag-container:hover {
            transform: translateY(-4px);
            box-shadow: 0 4px 12px rgba(0,0,0,0.15);
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
            
            <!-- Breadcrumb, Title, and Members Count -->
            <div class="absolute inset-0 flex flex-col justify-center items-center text-white px-4">
                <!-- Breadcrumb -->
                <div class="mb-6 flex items-center gap-2 text-white text-sm md:text-base">
                    <a href="index.php" class="hover:text-green-300 transition">
                        <i class="ri-home-line"></i>
                    </a>
                    <span class="mx-2">/</span>
                    <span>Chapters</span>
                    <span class="mx-2">/</span>
                    <span>International Chapters</span>
                </div>
                
                <!-- Main Title and Members Count -->
                <div class="flex flex-col md:flex-row items-center justify-center gap-8 w-full max-w-7xl mx-auto relative">
                    <h1 class="text-5xl md:text-6xl lg:text-7xl font-bold text-center">
                        International Chapters
                    </h1>
                    
                    <!-- Members Count Box -->
                    <div class="absolute bottom-0 right-0 bg-white rounded-lg px-6 py-4 shadow-lg">
                        <div class="text-center">
                            <p class="text-3xl md:text-4xl font-bold text-green-700 mb-1">347</p>
                            <p class="text-gray-600 text-xs md:text-sm font-medium">TOTAL MEMBERS</p>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <!-- Introductory Text Section -->
        <section class="py-16 bg-white">
            <div class="container mx-auto px-4">
                <div class="max-w-4xl mx-auto">
                    <p class="text-gray-700 text-lg md:text-xl leading-relaxed">
                        Our alumni chapters around the world create local networks that help keep the UAF spirit alive, no matter where our graduates are. These chapters organize regional events, strengthen professional and social connections and provide opportunities for alumni to engage with their peers and support university initiatives. They serve as vibrant communities that strengthen the global UAF alumni network.
                    </p>
                </div>
            </div>
        </section>

        <!-- Country Flags Grid -->
        <section class="py-16 bg-gray-50">
            <div class="container mx-auto px-4">
                <div class="max-w-7xl mx-auto">
                    <h2 class="text-3xl md:text-4xl font-bold text-gray-800 mb-8 text-center">
                        All International Chapters
                    </h2>
                    <div class="grid grid-cols-3 sm:grid-cols-4 md:grid-cols-5 lg:grid-cols-8 gap-4 md:gap-6">
                        
                        <!-- Kuwait -->
                        <div class="text-center">
                            <div class="flag-container bg-gradient-to-b from-green-500 via-white to-red-500 mb-3 relative">
                                <div class="absolute left-0 top-0 bottom-0 w-1/3 bg-black"></div>
                            </div>
                            <p class="font-medium text-gray-800 text-sm">Kuwait</p>
                            <p class="text-gray-600 text-xs">(14)</p>
                        </div>
                        
                        <!-- Qatar -->
                        <div class="text-center">
                            <div class="flag-container bg-red-800 mb-3 relative">
                                <div class="absolute left-0 top-0 bottom-0 w-1/3 bg-white" style="clip-path: polygon(0 0, 100% 0, 100% 100%, 0 100%, 0 50%, 9% 50%, 9% 0);"></div>
                            </div>
                            <p class="font-medium text-gray-800 text-sm">Qatar</p>
                            <p class="text-gray-600 text-xs">(15)</p>
                        </div>
                        
                        <!-- Bahrain -->
                        <div class="text-center">
                            <div class="flag-container bg-red-600 mb-3 relative">
                                <div class="absolute left-0 top-0 bottom-0 w-1/4 bg-white" style="clip-path: polygon(0 0, 100% 0, 100% 100%, 0 100%, 0 50%, 5% 50%, 5% 0);"></div>
                            </div>
                            <p class="font-medium text-gray-800 text-sm">Bahrain</p>
                            <p class="text-gray-600 text-xs">(3)</p>
                        </div>
                        
                        <!-- United Kingdom -->
                        <div class="text-center">
                            <div class="flag-container bg-blue-800 mb-3 relative">
                                <div class="absolute inset-0" style="background: linear-gradient(to right, white 0%, white 33%, red 33%, red 67%, white 67%, white 100%), linear-gradient(to bottom, white 0%, white 33%, red 33%, red 67%, white 67%, white 100%);"></div>
                            </div>
                            <p class="font-medium text-gray-800 text-sm">United Kingdom</p>
                            <p class="text-gray-600 text-xs">(74)</p>
                        </div>
                        
                        <!-- Germany -->
                        <div class="text-center">
                            <div class="flag-container mb-3" style="background: linear-gradient(to bottom, black 0%, black 33%, red 33%, red 67%, yellow 67%, yellow 100%);"></div>
                            <p class="font-medium text-gray-800 text-sm">Germany</p>
                            <p class="text-gray-600 text-xs">(24)</p>
                        </div>
                        
                        <!-- United States -->
                        <div class="text-center">
                            <div class="flag-container bg-red-600 mb-3 relative">
                                <div class="absolute top-0 left-0 w-2/5 h-2/5 bg-blue-800"></div>
                                <div class="absolute inset-0" style="background-image: repeating-linear-gradient(to bottom, transparent 0, transparent 1px, white 1px, white 2px), repeating-linear-gradient(to right, transparent 0, transparent 1px, white 1px, white 2px);"></div>
                            </div>
                            <p class="font-medium text-gray-800 text-sm">United States</p>
                            <p class="text-gray-600 text-xs">(28)</p>
                        </div>
                        
                        <!-- Saudi Arabia -->
                        <div class="text-center">
                            <div class="flag-container bg-green-600 mb-3 relative flex items-center justify-center">
                                <div class="text-white text-2xl font-bold">☪</div>
                            </div>
                            <p class="font-medium text-gray-800 text-sm">Saudi Arabia</p>
                            <p class="text-gray-600 text-xs">(52)</p>
                        </div>
                        
                        <!-- United Arab Emirates -->
                        <div class="text-center">
                            <div class="flag-container mb-3" style="background: linear-gradient(to right, red 0%, red 25%, green 25%, green 50%, white 50%, white 75%, black 75%, black 100%);"></div>
                            <p class="font-medium text-gray-800 text-sm">United Arab Emirates</p>
                            <p class="text-gray-600 text-xs">(47)</p>
                        </div>
                        
                        <!-- Canada -->
                        <div class="text-center">
                            <div class="flag-container bg-red-600 mb-3 relative flex items-center justify-center">
                                <div class="w-1/3 h-1/3 bg-white rounded-full flex items-center justify-center">
                                    <div class="text-red-600 text-xl">🍁</div>
                                </div>
                            </div>
                            <p class="font-medium text-gray-800 text-sm">Canada</p>
                            <p class="text-gray-600 text-xs">(18)</p>
                        </div>
                        
                        <!-- Ireland -->
                        <div class="text-center">
                            <div class="flag-container mb-3" style="background: linear-gradient(to right, green 0%, green 33%, white 33%, white 67%, orange 67%, orange 100%);"></div>
                            <p class="font-medium text-gray-800 text-sm">Ireland</p>
                            <p class="text-gray-600 text-xs">(10)</p>
                        </div>
                        
                        <!-- China -->
                        <div class="text-center">
                            <div class="flag-container bg-red-600 mb-3 relative">
                                <div class="absolute top-2 left-2">
                                    <div class="text-yellow-400 text-xl">★</div>
                                </div>
                            </div>
                            <p class="font-medium text-gray-800 text-sm">China</p>
                            <p class="text-gray-600 text-xs">(12)</p>
                        </div>
                        
                        <!-- Italy -->
                        <div class="text-center">
                            <div class="flag-container mb-3" style="background: linear-gradient(to right, green 0%, green 33%, white 33%, white 67%, red 67%, red 100%);"></div>
                            <p class="font-medium text-gray-800 text-sm">Italy</p>
                            <p class="text-gray-600 text-xs">(13)</p>
                        </div>
                        
                        <!-- Oman -->
                        <div class="text-center">
                            <div class="flag-container bg-red-600 mb-3 relative">
                                <div class="absolute left-0 top-0 bottom-0 w-1/4 bg-white"></div>
                                <div class="absolute top-0 left-0 w-1/4 h-1/3 bg-green-600"></div>
                            </div>
                            <p class="font-medium text-gray-800 text-sm">Oman</p>
                            <p class="text-gray-600 text-xs">(2)</p>
                        </div>
                        
                        <!-- Australia -->
                        <div class="text-center">
                            <div class="flag-container bg-blue-800 mb-3 relative">
                                <div class="absolute top-0 left-0 w-1/3 h-1/3 bg-blue-600"></div>
                            </div>
                            <p class="font-medium text-gray-800 text-sm">Australia</p>
                            <p class="text-gray-600 text-xs">(15)</p>
                        </div>
                        
                        <!-- Afghanistan -->
                        <div class="text-center">
                            <div class="flag-container mb-3" style="background: linear-gradient(to right, black 0%, black 33%, red 33%, red 67%, green 67%, green 100%);"></div>
                            <p class="font-medium text-gray-800 text-sm">Afghanistan</p>
                            <p class="text-gray-600 text-xs">(22)</p>
                        </div>
                        
                    </div>
                </div>
            </div>
        </section>

        <!-- International Chapter Cards -->
        <section class="py-16 bg-white">
            <div class="container mx-auto px-4">
                <div class="max-w-7xl mx-auto">
                    <div class="flex items-center justify-between mb-8">
                        <h2 class="text-3xl md:text-4xl font-bold text-gray-800">
                            International Chapters
                        </h2>
                        <i class="ri-arrow-down-s-line text-2xl text-gray-600"></i>
                    </div>
                    
                    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6">
                        
                        <!-- Card 1: Kuwait Chapter -->
                        <div class="bg-white rounded-lg shadow-md overflow-hidden hover:shadow-lg transition">
                            <div class="aspect-video bg-gray-200">
                                <img src="admin/assets/images/events/event1.jpg" alt="Kuwait Chapter" class="w-full h-full object-cover">
                            </div>
                            <div class="p-6">
                                <h3 class="text-xl font-bold text-gray-800 mb-3">Kuwait Chapter</h3>
                                <p class="text-gray-600 text-sm leading-relaxed mb-4">
                                    Connect with UAF alumni in Kuwait. Join networking events and community gatherings.
                                </p>
                                <div class="flex items-center justify-between mb-4">
                                    <div class="flex items-center gap-2">
                                        <span class="bg-green-100 text-green-700 text-xs font-semibold px-2 py-1 rounded">Active</span>
                                        <div class="flex items-center gap-1 text-gray-600">
                                            <i class="ri-group-line text-sm"></i>
                                            <span class="text-sm">14 Members</span>
                                        </div>
                                    </div>
                                </div>
                                <a href="#" class="block w-full bg-green-700 text-white text-center px-4 py-2 rounded-lg hover:bg-green-800 transition font-medium text-sm">
                                    Learn More
                                </a>
                            </div>
                        </div>
                        
                        <!-- Card 2: Qatar Chapter -->
                        <div class="bg-white rounded-lg shadow-md overflow-hidden hover:shadow-lg transition">
                            <div class="aspect-video bg-gray-200">
                                <img src="admin/assets/images/events/event2.jpg" alt="Qatar Chapter" class="w-full h-full object-cover">
                            </div>
                            <div class="p-6">
                                <h3 class="text-xl font-bold text-gray-800 mb-3">Qatar Chapter</h3>
                                <p class="text-gray-600 text-sm leading-relaxed mb-4">
                                    Join UAF alumni in Qatar. Connect with professionals, attend events, and build your network in Doha and across Qatar.
                                </p>
                                <div class="flex items-center justify-between mb-4">
                                    <div class="flex items-center gap-2">
                                        <span class="bg-green-100 text-green-700 text-xs font-semibold px-2 py-1 rounded">Active</span>
                                        <div class="flex items-center gap-1 text-gray-600">
                                            <i class="ri-group-line text-sm"></i>
                                            <span class="text-sm">15 Members</span>
                                        </div>
                                    </div>
                                </div>
                                <a href="#" class="block w-full bg-green-700 text-white text-center px-4 py-2 rounded-lg hover:bg-green-800 transition font-medium text-sm">
                                    Learn More
                                </a>
                            </div>
                        </div>
                        
                        <!-- Card 3: Bahrain Chapter -->
                        <div class="bg-white rounded-lg shadow-md overflow-hidden hover:shadow-lg transition">
                            <div class="aspect-video bg-gray-200">
                                <img src="admin/assets/images/events/event3.jpg" alt="Bahrain Chapter" class="w-full h-full object-cover">
                            </div>
                            <div class="p-6">
                                <h3 class="text-xl font-bold text-gray-800 mb-3">Bahrain Chapter</h3>
                                <p class="text-gray-600 text-sm leading-relaxed mb-4">
                                    Connect with UAF alumni in Bahrain. Join networking events and community activities to strengthen professional connections.
                                </p>
                                <div class="flex items-center justify-between mb-4">
                                    <div class="flex items-center gap-2">
                                        <span class="bg-green-100 text-green-700 text-xs font-semibold px-2 py-1 rounded">Active</span>
                                        <div class="flex items-center gap-1 text-gray-600">
                                            <i class="ri-group-line text-sm"></i>
                                            <span class="text-sm">3 Members</span>
                                        </div>
                                    </div>
                                </div>
                                <a href="#" class="block w-full bg-green-700 text-white text-center px-4 py-2 rounded-lg hover:bg-green-800 transition font-medium text-sm">
                                    Learn More
                                </a>
                            </div>
                        </div>
                        
                        <!-- Card 4: United Kingdom Chapter -->
                        <div class="bg-white rounded-lg shadow-md overflow-hidden hover:shadow-lg transition">
                            <div class="aspect-video bg-gray-200">
                                <img src="admin/assets/images/events/event4.jpg" alt="United Kingdom Chapter" class="w-full h-full object-cover">
                            </div>
                            <div class="p-6">
                                <h3 class="text-xl font-bold text-gray-800 mb-3">United Kingdom Chapter</h3>
                                <p class="text-gray-600 text-sm leading-relaxed mb-4">
                                    Connect with UAF alumni across the UK. Join networking events, professional development sessions, and community activities in London and beyond.
                                </p>
                                <div class="flex items-center justify-between mb-4">
                                    <div class="flex items-center gap-2">
                                        <span class="bg-green-100 text-green-700 text-xs font-semibold px-2 py-1 rounded">Active</span>
                                        <div class="flex items-center gap-1 text-gray-600">
                                            <i class="ri-group-line text-sm"></i>
                                            <span class="text-sm">74 Members</span>
                                        </div>
                                    </div>
                                </div>
                                <a href="#" class="block w-full bg-green-700 text-white text-center px-4 py-2 rounded-lg hover:bg-green-800 transition font-medium text-sm">
                                    Learn More
                                </a>
                            </div>
                        </div>
                        
                    </div>
                </div>
            </div>
        </section>

    </main>

    <?php include 'includes/footer.php'; ?>

    <?php include 'includes/scripts.php'; ?>
</body>
</html>

