<?php
/**
 * Alumni Associations Page - University of Agriculture Faisalabad Alumni Portal
 */
?>
<!DOCTYPE html>
<html lang="en" dir="ltr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Alumni Associations - Alumni Portal - University of Agriculture Faisalabad</title>
    
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
                    <span>Alumni Associations</span>
                </div>
                
                <!-- Main Title and Members Count -->
                <div class="flex flex-col md:flex-row items-center justify-center gap-8 w-full max-w-7xl mx-auto">
                    <h1 class="text-5xl md:text-6xl lg:text-7xl font-bold text-center">
                        Associations
                    </h1>
                    
                    <!-- Members Count Box -->
                    <div class="bg-white rounded-lg px-8 py-6 shadow-lg">
                        <div class="text-center">
                            <p class="text-4xl md:text-5xl font-bold text-green-700 mb-1">2,819</p>
                            <p class="text-gray-600 text-sm md:text-base font-medium">MEMBERS</p>
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
                        The Alumni Associations are at the heart of our alumni network. They serve as a platform for maintaining strong connections with your alma mater, faculty, and fellow graduates. As a member, you will be part of a dynamic group that actively contributes to the growth and development of the university, organizes events and creates opportunities for alumni to engage with each other. Be part of something bigger by joining the UAF Alumni Association and make your voice heard in shaping our community.
                    </p>
                </div>
            </div>
        </section>

        <!-- Association Cards Section -->
        <section class="py-16 bg-gray-50">
            <div class="container mx-auto px-4">
                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8 max-w-7xl mx-auto">
                    
                    <!-- Card 1: College of Medicine & Dentistry -->
                    <div class="bg-white rounded-lg shadow-md overflow-hidden hover:shadow-lg transition">
                        <div class="p-6">
                            <!-- Logo -->
                            <div class="flex justify-center mb-6">
                                <div class="w-24 h-24 bg-blue-100 rounded-lg flex items-center justify-center">
                                    <i class="ri-hospital-line text-blue-700 text-5xl"></i>
                                </div>
                            </div>
                            
                            <!-- Title -->
                            <h3 class="text-2xl font-bold text-gray-800 mb-4 text-center">
                                College of Medicine & Dentistry (UCMD)
                            </h3>
                            
                            <!-- Description -->
                            <p class="text-gray-600 leading-relaxed mb-6">
                                Supporting doctors and dental professionals, this association encourages continued mentoring, professional growth, and participation in medical workshops, alumni reunions, and healthcare-focused events.
                            </p>
                            
                            <!-- Members and Button -->
                            <div class="flex items-center justify-between">
                                <div class="flex items-center gap-2 text-gray-600">
                                    <i class="ri-group-line text-green-700"></i>
                                    <span class="text-sm">19 Members</span>
                                </div>
                                <a href="#" class="bg-green-700 text-white px-6 py-2 rounded-lg hover:bg-green-800 transition font-medium text-sm">
                                    Learn More
                                </a>
                            </div>
                        </div>
                    </div>
                    
                    <!-- Card 2: Allied Health Sciences -->
                    <div class="bg-white rounded-lg shadow-md overflow-hidden hover:shadow-lg transition">
                        <div class="p-6">
                            <!-- Logo -->
                            <div class="flex justify-center mb-6">
                                <div class="w-24 h-24 bg-gradient-to-br from-purple-400 via-blue-400 to-green-400 rounded-lg flex items-center justify-center">
                                    <span class="text-white font-bold text-2xl">AHS</span>
                                </div>
                            </div>
                            
                            <!-- Title -->
                            <h3 class="text-2xl font-bold text-gray-800 mb-4 text-center">
                                Allied Health Sciences
                            </h3>
                            
                            <!-- Description -->
                            <p class="text-gray-600 leading-relaxed mb-6">
                                This association connects graduates from Allied Health programs, helping them stay engaged with fellow professionals, strengthen their network, and remain informed about upcoming meetups, conferences, and career opportunities in the healthcare field.
                            </p>
                            
                            <!-- Members and Button -->
                            <div class="flex items-center justify-between">
                                <div class="flex items-center gap-2 text-gray-600">
                                    <i class="ri-group-line text-green-700"></i>
                                    <span class="text-sm">517 Members</span>
                                </div>
                                <a href="#" class="bg-green-700 text-white px-6 py-2 rounded-lg hover:bg-green-800 transition font-medium text-sm">
                                    Learn More
                                </a>
                            </div>
                        </div>
                    </div>
                    
                    <!-- Card 3: Arts & Architecture -->
                    <div class="bg-white rounded-lg shadow-md overflow-hidden hover:shadow-lg transition">
                        <div class="p-6">
                            <!-- Logo -->
                            <div class="flex justify-center mb-6">
                                <div class="w-24 h-24 bg-gray-800 rounded-lg flex items-center justify-center">
                                    <i class="ri-building-2-line text-white text-5xl"></i>
                                </div>
                            </div>
                            
                            <!-- Title -->
                            <h3 class="text-2xl font-bold text-gray-800 mb-4 text-center">
                                Arts & Architecture
                            </h3>
                            
                            <!-- Description -->
                            <p class="text-gray-600 leading-relaxed mb-6">
                                Connecting creative minds, this association fosters interaction among artists and architects while offering access to exhibitions, design workshops, and professional gatherings within the creative industry.
                            </p>
                            
                            <!-- Members and Button -->
                            <div class="flex items-center justify-between">
                                <div class="flex items-center gap-2 text-gray-600">
                                    <i class="ri-group-line text-green-700"></i>
                                    <span class="text-sm">54 Members</span>
                                </div>
                                <a href="#" class="bg-green-700 text-white px-6 py-2 rounded-lg hover:bg-green-800 transition font-medium text-sm">
                                    Learn More
                                </a>
                            </div>
                        </div>
                    </div>
                    
                    <!-- Additional Association Cards (can be added as needed) -->
                    <div class="bg-white rounded-lg shadow-md overflow-hidden hover:shadow-lg transition">
                        <div class="p-6">
                            <!-- Logo -->
                            <div class="flex justify-center mb-6">
                                <div class="w-24 h-24 bg-green-100 rounded-lg flex items-center justify-center">
                                    <i class="ri-graduation-cap-line text-green-700 text-5xl"></i>
                                </div>
                            </div>
                            
                            <!-- Title -->
                            <h3 class="text-2xl font-bold text-gray-800 mb-4 text-center">
                                Faculty of Agriculture
                            </h3>
                            
                            <!-- Description -->
                            <p class="text-gray-600 leading-relaxed mb-6">
                                Connecting agricultural professionals and researchers, this association promotes knowledge sharing, research collaboration, and networking opportunities in the field of agriculture and related sciences.
                            </p>
                            
                            <!-- Members and Button -->
                            <div class="flex items-center justify-between">
                                <div class="flex items-center gap-2 text-gray-600">
                                    <i class="ri-group-line text-green-700"></i>
                                    <span class="text-sm">342 Members</span>
                                </div>
                                <a href="#" class="bg-green-700 text-white px-6 py-2 rounded-lg hover:bg-green-800 transition font-medium text-sm">
                                    Learn More
                                </a>
                            </div>
                        </div>
                    </div>
                    
                    <div class="bg-white rounded-lg shadow-md overflow-hidden hover:shadow-lg transition">
                        <div class="p-6">
                            <!-- Logo -->
                            <div class="flex justify-center mb-6">
                                <div class="w-24 h-24 bg-blue-100 rounded-lg flex items-center justify-center">
                                    <i class="ri-computer-line text-blue-700 text-5xl"></i>
                                </div>
                            </div>
                            
                            <!-- Title -->
                            <h3 class="text-2xl font-bold text-gray-800 mb-4 text-center">
                                Faculty of Computer Science
                            </h3>
                            
                            <!-- Description -->
                            <p class="text-gray-600 leading-relaxed mb-6">
                                Bringing together IT professionals, software engineers, and tech entrepreneurs, this association facilitates networking, knowledge exchange, and career development in the technology sector.
                            </p>
                            
                            <!-- Members and Button -->
                            <div class="flex items-center justify-between">
                                <div class="flex items-center gap-2 text-gray-600">
                                    <i class="ri-group-line text-green-700"></i>
                                    <span class="text-sm">289 Members</span>
                                </div>
                                <a href="#" class="bg-green-700 text-white px-6 py-2 rounded-lg hover:bg-green-800 transition font-medium text-sm">
                                    Learn More
                                </a>
                            </div>
                        </div>
                    </div>
                    
                    <div class="bg-white rounded-lg shadow-md overflow-hidden hover:shadow-lg transition">
                        <div class="p-6">
                            <!-- Logo -->
                            <div class="flex justify-center mb-6">
                                <div class="w-24 h-24 bg-amber-100 rounded-lg flex items-center justify-center">
                                    <i class="ri-scales-line text-amber-700 text-5xl"></i>
                                </div>
                            </div>
                            
                            <!-- Title -->
                            <h3 class="text-2xl font-bold text-gray-800 mb-4 text-center">
                                Faculty of Social Sciences
                            </h3>
                            
                            <!-- Description -->
                            <p class="text-gray-600 leading-relaxed mb-6">
                                Connecting social scientists, researchers, and professionals, this association promotes collaboration, research initiatives, and professional development in social sciences and humanities.
                            </p>
                            
                            <!-- Members and Button -->
                            <div class="flex items-center justify-between">
                                <div class="flex items-center gap-2 text-gray-600">
                                    <i class="ri-group-line text-green-700"></i>
                                    <span class="text-sm">156 Members</span>
                                </div>
                                <a href="#" class="bg-green-700 text-white px-6 py-2 rounded-lg hover:bg-green-800 transition font-medium text-sm">
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

