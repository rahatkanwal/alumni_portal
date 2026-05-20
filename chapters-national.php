<?php
/**
 * National Chapters Page - University of Agriculture Faisalabad Alumni Portal
 */
?>
<!DOCTYPE html>
<html lang="en" dir="ltr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>National Chapters - Alumni Portal - University of Agriculture Faisalabad</title>
    
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
        
        /* Map Styles */
        .map-container {
            position: relative;
            background: #f0f0f0;
            border-radius: 8px;
            overflow: hidden;
        }
        
        .map-legend {
            position: absolute;
            top: 16px;
            left: 16px;
            background: white;
            padding: 12px;
            border-radius: 8px;
            box-shadow: 0 2px 8px rgba(0,0,0,0.1);
            z-index: 10;
        }
        
        .legend-item {
            display: flex;
            align-items: center;
            gap: 8px;
            margin-bottom: 8px;
        }
        
        .legend-item:last-child {
            margin-bottom: 0;
        }
        
        .legend-dot {
            width: 12px;
            height: 12px;
            border-radius: 50%;
        }
        
        .legend-dot.active {
            background: #ef4444;
        }
        
        .legend-dot.upcoming {
            background: #3b82f6;
        }
        
        /* Chapter List Styles */
        .chapter-list {
            max-height: 600px;
            overflow-y: auto;
        }
        
        .chapter-list-item {
            padding: 12px;
            border-bottom: 1px solid #e5e7eb;
            cursor: pointer;
            transition: background 0.2s;
        }
        
        .chapter-list-item:hover {
            background: #f9fafb;
        }
        
        .chapter-list-item:last-child {
            border-bottom: none;
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
                    <span>National Chapters</span>
                </div>
                
                <!-- Main Title and Members Count -->
                <div class="flex flex-col md:flex-row items-center justify-center gap-8 w-full max-w-7xl mx-auto relative">
                    <h1 class="text-5xl md:text-6xl lg:text-7xl font-bold text-center">
                        National Chapters
                    </h1>
                    
                    <!-- Members Count Box -->
                    <div class="absolute bottom-0 right-0 bg-white rounded-lg px-6 py-4 shadow-lg">
                        <div class="text-center">
                            <p class="text-3xl md:text-4xl font-bold text-green-700 mb-1">2,130</p>
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

        <!-- Map and List Section -->
        <section class="py-16 bg-gray-50">
            <div class="container mx-auto px-4">
                <div class="grid grid-cols-1 lg:grid-cols-2 gap-8 max-w-7xl mx-auto">
                    
                    <!-- Left: Map -->
                    <div class="map-container aspect-square bg-gradient-to-br from-green-50 to-blue-50">
                        <!-- Map Legend -->
                        <div class="map-legend">
                            <div class="legend-item">
                                <div class="legend-dot active"></div>
                                <span class="text-sm text-gray-700">Active Chapters</span>
                            </div>
                            <div class="legend-item">
                                <div class="legend-dot upcoming"></div>
                                <span class="text-sm text-gray-700">Upcoming Chapters</span>
                            </div>
                        </div>
                        
                        <!-- Placeholder for Map - In production, this would be an interactive map -->
                        <div class="w-full h-full flex items-center justify-center">
                            <div class="text-center text-gray-500">
                                <i class="ri-map-pin-line text-6xl mb-4"></i>
                                <p class="text-lg">Interactive Map of Pakistan</p>
                                <p class="text-sm">Showing National Chapters</p>
                            </div>
                        </div>
                    </div>
                    
                    <!-- Right: Chapter List -->
                    <div class="bg-white rounded-lg shadow-md p-6">
                        <h3 class="text-2xl font-bold text-gray-800 mb-4">All Chapters</h3>
                        <div class="chapter-list">
                            <div class="chapter-list-item">
                                <div class="flex items-center justify-between">
                                    <div class="flex items-center gap-3">
                                        <i class="ri-map-pin-line text-green-700"></i>
                                        <span class="font-medium text-gray-800">Lahore Chapter</span>
                                    </div>
                                    <span class="text-gray-600 text-sm">(1,314)</span>
                                </div>
                            </div>
                            <div class="chapter-list-item">
                                <div class="flex items-center justify-between">
                                    <div class="flex items-center gap-3">
                                        <i class="ri-map-pin-line text-green-700"></i>
                                        <span class="font-medium text-gray-800">Gujranwala-Gujrat-Sialkot Chapter</span>
                                    </div>
                                    <span class="text-gray-600 text-sm">(253)</span>
                                </div>
                            </div>
                            <div class="chapter-list-item">
                                <div class="flex items-center justify-between">
                                    <div class="flex items-center gap-3">
                                        <i class="ri-map-pin-line text-green-700"></i>
                                        <span class="font-medium text-gray-800">Faisalabad Chapter</span>
                                    </div>
                                    <span class="text-gray-600 text-sm">(108)</span>
                                </div>
                            </div>
                            <div class="chapter-list-item">
                                <div class="flex items-center justify-between">
                                    <div class="flex items-center gap-3">
                                        <i class="ri-map-pin-line text-green-700"></i>
                                        <span class="font-medium text-gray-800">Sargodha Chapter</span>
                                    </div>
                                    <span class="text-gray-600 text-sm">(70)</span>
                                </div>
                            </div>
                            <div class="chapter-list-item">
                                <div class="flex items-center justify-between">
                                    <div class="flex items-center gap-3">
                                        <i class="ri-map-pin-line text-green-700"></i>
                                        <span class="font-medium text-gray-800">Multan Chapter</span>
                                    </div>
                                    <span class="text-gray-600 text-sm">(49)</span>
                                </div>
                            </div>
                            <div class="chapter-list-item">
                                <div class="flex items-center justify-between">
                                    <div class="flex items-center gap-3">
                                        <i class="ri-map-pin-line text-green-700"></i>
                                        <span class="font-medium text-gray-800">Bahawalpur-Bahawalnagar Chapter</span>
                                    </div>
                                    <span class="text-gray-600 text-sm">(76)</span>
                                </div>
                            </div>
                            <div class="chapter-list-item">
                                <div class="flex items-center justify-between">
                                    <div class="flex items-center gap-3">
                                        <i class="ri-map-pin-line text-green-700"></i>
                                        <span class="font-medium text-gray-800">Sahiwal Chapter</span>
                                    </div>
                                    <span class="text-gray-600 text-sm">(101)</span>
                                </div>
                            </div>
                            <div class="chapter-list-item">
                                <div class="flex items-center justify-between">
                                    <div class="flex items-center gap-3">
                                        <i class="ri-map-pin-line text-green-700"></i>
                                        <span class="font-medium text-gray-800">Southern Punjab Chapter</span>
                                    </div>
                                    <span class="text-gray-600 text-sm">(148)</span>
                                </div>
                            </div>
                            <div class="chapter-list-item">
                                <div class="flex items-center justify-between">
                                    <div class="flex items-center gap-3">
                                        <i class="ri-map-pin-line text-green-700"></i>
                                        <span class="font-medium text-gray-800">Islamabad Chapter</span>
                                    </div>
                                    <span class="text-gray-600 text-sm">(95)</span>
                                </div>
                            </div>
                            <div class="chapter-list-item">
                                <div class="flex items-center justify-between">
                                    <div class="flex items-center gap-3">
                                        <i class="ri-map-pin-line text-green-700"></i>
                                        <span class="font-medium text-gray-800">KPK Chapter</span>
                                    </div>
                                    <span class="text-gray-600 text-sm">(70)</span>
                                </div>
                            </div>
                            <div class="chapter-list-item">
                                <div class="flex items-center justify-between">
                                    <div class="flex items-center gap-3">
                                        <i class="ri-map-pin-line text-green-700"></i>
                                        <span class="font-medium text-gray-800">Kashmir Chapter</span>
                                    </div>
                                    <span class="text-gray-600 text-sm">(10)</span>
                                </div>
                            </div>
                            <div class="chapter-list-item">
                                <div class="flex items-center justify-between">
                                    <div class="flex items-center gap-3">
                                        <i class="ri-map-pin-line text-green-700"></i>
                                        <span class="font-medium text-gray-800">Sindh Chapter</span>
                                    </div>
                                    <span class="text-gray-600 text-sm">(22)</span>
                                </div>
                            </div>
                            <div class="chapter-list-item">
                                <div class="flex items-center justify-between">
                                    <div class="flex items-center gap-3">
                                        <i class="ri-map-pin-line text-green-700"></i>
                                        <span class="font-medium text-gray-800">Balochistan Chapter</span>
                                    </div>
                                    <span class="text-gray-600 text-sm">(20)</span>
                                </div>
                            </div>
                            <div class="chapter-list-item">
                                <div class="flex items-center justify-between">
                                    <div class="flex items-center gap-3">
                                        <i class="ri-map-pin-line text-green-700"></i>
                                        <span class="font-medium text-gray-800">Northern Pakistan Chapter</span>
                                    </div>
                                    <span class="text-gray-600 text-sm">(11)</span>
                                </div>
                            </div>
                        </div>
                    </div>
                    
                </div>
            </div>
        </section>

        <!-- Chapter Cards Grid -->
        <section class="py-16 bg-white">
            <div class="container mx-auto px-4">
                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6 max-w-7xl mx-auto">
                    
                    <!-- Card 1: Lahore Chapter -->
                    <div class="bg-white rounded-lg shadow-md overflow-hidden hover:shadow-lg transition">
                        <div class="aspect-video bg-gray-200">
                            <img src="admin/assets/images/events/event1.jpg" alt="Lahore Chapter" class="w-full h-full object-cover">
                        </div>
                        <div class="p-6">
                            <h3 class="text-xl font-bold text-gray-800 mb-3">Lahore Chapter</h3>
                            <p class="text-gray-600 text-sm leading-relaxed mb-4">
                                This chapter includes alumni from Lahore, Kasur, Kot Radha Kishen, Sharaqpur Sharif, Muridke, Narang Mandi, Sheikhupura, Chunia, Pattoki, Renala Khurd, Okara, Depalpur, Haveli Lakha, Huira Shah, and Manwala.
                            </p>
                            <div class="flex items-center justify-between mb-4">
                                <div class="flex items-center gap-2">
                                    <span class="bg-green-100 text-green-700 text-xs font-semibold px-2 py-1 rounded">Active</span>
                                    <div class="flex items-center gap-1 text-gray-600">
                                        <i class="ri-group-line text-sm"></i>
                                        <span class="text-sm">1,314 Members</span>
                                    </div>
                                </div>
                            </div>
                            <a href="#" class="block w-full bg-green-700 text-white text-center px-4 py-2 rounded-lg hover:bg-green-800 transition font-medium text-sm">
                                Learn More
                            </a>
                        </div>
                    </div>
                    
                    <!-- Card 2: Gujranwala-Gujrat-Sialkot Chapter -->
                    <div class="bg-white rounded-lg shadow-md overflow-hidden hover:shadow-lg transition">
                        <div class="aspect-video bg-gray-200">
                            <img src="admin/assets/images/events/event2.jpg" alt="Gujranwala-Gujrat-Sialkot Chapter" class="w-full h-full object-cover">
                        </div>
                        <div class="p-6">
                            <h3 class="text-xl font-bold text-gray-800 mb-3">Gujranwala-Gujrat-Sialkot Chapter</h3>
                            <p class="text-gray-600 text-sm leading-relaxed mb-4">
                                This chapter brings together alumni from Gujranwala, Gujrat, Sialkot, Daska, Wazirabad, Kamoke, Hafizabad, Alipur Chattha, Lala Musa, and Kharian. Representing an important industrial region.
                            </p>
                            <div class="flex items-center justify-between mb-4">
                                <div class="flex items-center gap-2">
                                    <span class="bg-green-100 text-green-700 text-xs font-semibold px-2 py-1 rounded">Active</span>
                                    <div class="flex items-center gap-1 text-gray-600">
                                        <i class="ri-group-line text-sm"></i>
                                        <span class="text-sm">253 Members</span>
                                    </div>
                                </div>
                            </div>
                            <a href="#" class="block w-full bg-green-700 text-white text-center px-4 py-2 rounded-lg hover:bg-green-800 transition font-medium text-sm">
                                Learn More
                            </a>
                        </div>
                    </div>
                    
                    <!-- Card 3: Faisalabad Chapter -->
                    <div class="bg-white rounded-lg shadow-md overflow-hidden hover:shadow-lg transition">
                        <div class="aspect-video bg-gray-200">
                            <img src="admin/assets/images/events/event3.jpg" alt="Faisalabad Chapter" class="w-full h-full object-cover">
                        </div>
                        <div class="p-6">
                            <h3 class="text-xl font-bold text-gray-800 mb-3">Faisalabad Chapter</h3>
                            <p class="text-gray-600 text-sm leading-relaxed mb-4">
                                The Faisalabad chapter includes alumni from Faisalabad, Jaranwala, Samundri, Gojra, Toba Tek Singh, Chiniot, and Jhang. With strong representation from one of Pakistan's major economic hubs.
                            </p>
                            <div class="flex items-center justify-between mb-4">
                                <div class="flex items-center gap-2">
                                    <span class="bg-green-100 text-green-700 text-xs font-semibold px-2 py-1 rounded">Active</span>
                                    <div class="flex items-center gap-1 text-gray-600">
                                        <i class="ri-group-line text-sm"></i>
                                        <span class="text-sm">108 Members</span>
                                    </div>
                                </div>
                            </div>
                            <a href="#" class="block w-full bg-green-700 text-white text-center px-4 py-2 rounded-lg hover:bg-green-800 transition font-medium text-sm">
                                Learn More
                            </a>
                        </div>
                    </div>
                    
                    <!-- Card 4: Sargodha Chapter -->
                    <div class="bg-white rounded-lg shadow-md overflow-hidden hover:shadow-lg transition">
                        <div class="aspect-video bg-gray-200">
                            <img src="admin/assets/images/events/event4.jpg" alt="Sargodha Chapter" class="w-full h-full object-cover">
                        </div>
                        <div class="p-6">
                            <h3 class="text-xl font-bold text-gray-800 mb-3">Sargodha Chapter</h3>
                            <p class="text-gray-600 text-sm leading-relaxed mb-4">
                                This chapter consists of alumni from Sargodha, Khushab, Jauharabad, Bhalwal, and Mianwali. These interconnected cities form a cohesive alumni community that supports peer learning and career development.
                            </p>
                            <div class="flex items-center justify-between mb-4">
                                <div class="flex items-center gap-2">
                                    <span class="bg-green-100 text-green-700 text-xs font-semibold px-2 py-1 rounded">Active</span>
                                    <div class="flex items-center gap-1 text-gray-600">
                                        <i class="ri-group-line text-sm"></i>
                                        <span class="text-sm">70 Members</span>
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
        </section>

    </main>

    <?php include 'includes/footer.php'; ?>

    <?php include 'includes/scripts.php'; ?>
</body>
</html>

