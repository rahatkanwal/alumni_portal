<?php
/**
 * Give Back Page - University of Agriculture Faisalabad Alumni Portal
 */
?>
<!DOCTYPE html>
<html lang="en" dir="ltr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Give Back - Alumni Portal - University of Agriculture Faisalabad</title>
    
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
            
            <!-- Breadcrumb and Title Overlay -->
            <div class="absolute inset-0 flex flex-col justify-center items-center text-white px-4">
                <!-- Breadcrumb -->
                <div class="mb-6 flex items-center gap-2 text-white text-sm md:text-base">
                    <a href="index.php" class="hover:text-green-300 transition">
                        <i class="ri-home-line"></i>
                    </a>
                    <span class="mx-2">/</span>
                    <span>Give Back</span>
                </div>
                
                <!-- Main Title -->
                <h1 class="text-5xl md:text-6xl lg:text-7xl font-bold text-center">
                    Give Back
                </h1>
            </div>
        </section>

        <!-- Types of Contributions Section -->
        <section class="py-16 bg-amber-50">
            <div class="container mx-auto px-4">
                <div class="max-w-7xl mx-auto">
                    <h2 class="text-3xl md:text-4xl lg:text-5xl font-bold text-gray-800 mb-12 text-center">
                        Types of Contributions
                    </h2>
                    
                    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
                        
                        <!-- Card 1: UAF Relief -->
                        <div class="bg-white rounded-lg shadow-md overflow-hidden hover:shadow-lg transition">
                            <div class="aspect-video bg-gray-200">
                                <img src="admin/assets/images/events/event1.jpg" alt="UAF Relief" class="w-full h-full object-cover">
                            </div>
                            <div class="p-6">
                                <h3 class="text-2xl font-bold text-gray-800 mb-2">UAF Relief</h3>
                                <p class="text-gray-600 italic mb-4">Extend Compassion, Create Impact</p>
                                <p class="text-gray-700 leading-relaxed mb-6">
                                    UAF Relief is a humanitarian initiative that extends compassion and creates lasting impact in communities facing adversity. Established in response to natural disasters and social challenges, UAF Relief focuses on disaster response, community uplift, education support, and healthcare outreach. Through programs like emergency relief, temporary shelters, food distribution, medical camps, and long-term community support, we aim to transform lives and build stronger communities. Join us in making a meaningful difference.
                                </p>
                                <a href="#" class="inline-block bg-green-700 text-white px-6 py-3 rounded-lg hover:bg-green-800 transition font-medium w-full text-center">
                                    Get Involved Now
                                </a>
                            </div>
                        </div>
                        
                        <!-- Card 2: Name a Scholarship -->
                        <div class="bg-white rounded-lg shadow-md overflow-hidden hover:shadow-lg transition">
                            <div class="aspect-video bg-gray-200">
                                <img src="admin/assets/images/events/event2.jpg" alt="Name a Scholarship" class="w-full h-full object-cover">
                            </div>
                            <div class="p-6">
                                <h3 class="text-2xl font-bold text-gray-800 mb-2">Name a Scholarship</h3>
                                <p class="text-gray-600 italic mb-4">Leave a Legacy – Shape the Future.</p>
                                <p class="text-gray-700 leading-relaxed mb-6">
                                    Establish a named scholarship at The University of Agriculture Faisalabad and create a lasting impact. You can support single or multiple students, focus on specific disciplines, sponsor hostel accommodation, or establish a state-of-the-art laboratory or facility. Your contribution helps deserving students achieve their academic dreams, strengthens industries with skilled graduates, and creates a legacy that reflects your commitment to education and excellence.
                                </p>
                                <a href="#" class="inline-block bg-green-700 text-white px-6 py-3 rounded-lg hover:bg-green-800 transition font-medium w-full text-center">
                                    Contact Office of Alumni Relations
                                </a>
                            </div>
                        </div>
                        
                        <!-- Card 3: Corporate Partnerships -->
                        <div class="bg-white rounded-lg shadow-md overflow-hidden hover:shadow-lg transition">
                            <div class="aspect-video bg-gray-200">
                                <img src="admin/assets/images/events/event3.jpg" alt="Corporate Partnerships" class="w-full h-full object-cover">
                            </div>
                            <div class="p-6">
                                <h3 class="text-2xl font-bold text-gray-800 mb-2">Corporate Partnerships</h3>
                                <p class="text-gray-600 italic mb-4">Together, We Shape Tomorrow.</p>
                                <p class="text-gray-700 leading-relaxed mb-6">
                                    Partner with The University of Agriculture Faisalabad to create meaningful impact. Our partnerships provide a platform for alumni and industry leaders to collaborate on initiatives that enhance student development, elevate industry readiness, and contribute to global recognition. Through programs like internships, joint research projects, mentorship, and industry-focused engagements, we strengthen talent pipelines, foster community engagement, and advance corporate social responsibility goals.
                                </p>
                                <a href="#" class="inline-block bg-green-700 text-white px-6 py-3 rounded-lg hover:bg-green-800 transition font-medium w-full text-center">
                                    Contact Office of Alumni Relations
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

