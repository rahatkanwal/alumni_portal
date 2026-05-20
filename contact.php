<?php
/**
 * Contact Us Page - University of Agriculture Faisalabad Alumni Portal
 */
?>
<!DOCTYPE html>
<html lang="en" dir="ltr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Contact Us - Alumni Portal - University of Agriculture Faisalabad</title>
    
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
        
        .contact-card {
            transition: transform 0.3s ease, box-shadow 0.3s ease;
        }
        
        .contact-card:hover {
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
                    <span>Contact Us</span>
                </div>
                
                <!-- Main Title -->
                <h1 class="text-5xl md:text-6xl lg:text-7xl font-bold text-center">
                    Contact Us
                </h1>
            </div>
        </section>

        <!-- Contact Information Cards -->
        <section class="py-16 bg-white">
            <div class="container mx-auto px-4">
                <div class="grid grid-cols-1 md:grid-cols-2 gap-8 max-w-5xl mx-auto">
                    
                    <!-- Location Card -->
                    <div class="bg-blue-50 rounded-lg p-8 contact-card">
                        <div class="flex items-start gap-4 mb-6">
                            <div class="w-14 h-14 bg-blue-100 rounded-full flex items-center justify-center flex-shrink-0">
                                <i class="ri-map-pin-line text-blue-600 text-2xl"></i>
                            </div>
                            <div>
                                <p class="text-gray-500 text-xs font-semibold uppercase tracking-wide mb-1">LOCATION</p>
                                <h3 class="text-2xl font-bold text-gray-800 mb-4">Visit Us</h3>
                                <div class="text-gray-700 leading-relaxed">
                                    <p>The University of Agriculture</p>
                                    <p>Faisalabad</p>
                                    <p>Pakistan</p>
                                </div>
                            </div>
                        </div>
                    </div>
                    
                    <!-- Contact Card -->
                    <div class="bg-purple-50 rounded-lg p-8 contact-card">
                        <div class="flex items-start gap-4 mb-6">
                            <div class="w-14 h-14 bg-purple-100 rounded-full flex items-center justify-center flex-shrink-0">
                                <i class="ri-phone-line text-purple-600 text-2xl"></i>
                            </div>
                            <div>
                                <p class="text-gray-500 text-xs font-semibold uppercase tracking-wide mb-1">CONTACT</p>
                                <h3 class="text-2xl font-bold text-gray-800 mb-4">Call Us</h3>
                                <div class="text-gray-700 leading-relaxed space-y-1">
                                    <p>Tel: +92-41-9200161-70</p>
                                    <p>Ext: 4409</p>
                                    <p>Email: alumni@uaf.edu.pk</p>
                                </div>
                            </div>
                        </div>
                    </div>
                    
                </div>
            </div>
        </section>

        <!-- Google Maps Section -->
        <section class="py-16 bg-gray-50">
            <div class="container mx-auto px-4">
                <div class="max-w-7xl mx-auto">
                    <h2 class="text-3xl md:text-4xl font-bold text-gray-800 mb-8 text-center">
                        Find Us on Map
                    </h2>
                    
                    <!-- Map Container -->
                    <div class="rounded-lg overflow-hidden shadow-lg">
                        <iframe 
                            src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3403.1234567890123!2d73.12345678901234!3d31.12345678901234!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x3922691a1234567%3A0x1234567890abcdef!2sUniversity%20of%20Agriculture%20Faisalabad!5e0!3m2!1sen!2s!4v1234567890123!5m2!1sen!2s" 
                            width="100%" 
                            height="500" 
                            style="border:0;" 
                            allowfullscreen="" 
                            loading="lazy" 
                            referrerpolicy="no-referrer-when-downgrade"
                            class="w-full"
                        ></iframe>
                    </div>
                    
                    <!-- Map Information -->
                    <div class="mt-6 bg-white rounded-lg p-6 shadow-md">
                        <div class="flex flex-col md:flex-row md:items-center md:justify-between gap-4">
                            <div>
                                <h3 class="text-xl font-bold text-gray-800 mb-2">The University of Agriculture Faisalabad</h3>
                                <p class="text-gray-600">The University of Agriculture, Faisalabad, Pakistan</p>
                            </div>
                            <a 
                                href="https://www.google.com/maps/dir//University+of+Agriculture+Faisalabad" 
                                target="_blank" 
                                class="inline-flex items-center gap-2 bg-green-700 text-white px-6 py-3 rounded-lg hover:bg-green-800 transition font-medium"
                            >
                                <i class="ri-directions-line"></i>
                                Get Directions
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

