<?php
/**
 * About Us Page - University of Agriculture Faisalabad Alumni Portal
 */
?>
<!DOCTYPE html>
<html lang="en" dir="ltr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>About Us - Alumni Portal - University of Agriculture Faisalabad</title>
    
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
                    <span>About Us</span>
                </div>
                
                <!-- Main Title -->
                <h1 class="text-5xl md:text-6xl lg:text-7xl font-bold text-center">
                    About Us
                </h1>
            </div>
        </section>

        <!-- Introductory Text Section -->
        <section class="py-16 bg-white">
            <div class="container mx-auto px-4">
                <div class="max-w-4xl mx-auto">
                    <p class="text-gray-700 text-lg md:text-xl leading-relaxed">
                        Welcome to University of Agriculture Faisalabad (UAF) Alumni Portal - your central hub for all activities related to the UAF alumni community. Whether you are reconnecting with classmates, participating in networking events, staying updated with campus news or exploring exclusive alumni services, this portal is designed to keep you engaged and informed.
                    </p>
                </div>
            </div>
        </section>

        <!-- Message from Vice Chancellor Section -->
        <section class="py-16 bg-amber-50">
            <div class="container mx-auto px-4">
                <div class="grid grid-cols-1 lg:grid-cols-2 gap-8 lg:gap-12 max-w-7xl mx-auto">
                    <!-- Left Column - Image -->
                    <div class="flex items-center justify-center lg:justify-start">
                        <div class="w-full max-w-md">
                            <img src="assets/vicechancellor.jpg" alt="Vice Chancellor" class="w-full h-auto rounded-lg shadow-lg object-cover">
                        </div>
                    </div>
                    
                    <!-- Right Column - Message -->
                    <div class="flex flex-col justify-center">
                        <div class="space-y-4">
                            <!-- Title with decorative line -->
                            <div class="relative mb-6">
                                <h2 class="text-4xl md:text-5xl lg:text-6xl font-bold text-green-700 mb-2" style="font-family: 'Inter', sans-serif; letter-spacing: -0.5px;">
                                    Message from
                                </h2>
                                <div class="relative inline-block">
                                    <div class="absolute -top-2 left-0 w-20 h-0.5 bg-green-700"></div>
                                    <span class="text-4xl md:text-5xl lg:text-6xl font-bold text-green-700 relative">Vice Chancellor</span>
                                </div>
                            </div>
                            
                            <!-- Name -->
                            <h3 class="text-2xl md:text-3xl font-bold text-gray-800 mt-8">
                            Prof. Dr. Zulfiqar Ali
                            </h3>
                            
                            <!-- Message Text -->
                            <div class="mt-8 space-y-5">
                                <p class="text-gray-700 text-lg md:text-xl leading-relaxed">
                                    Dear Alumni, Welcome to the UAF Alumni Portal. We are proud to have been part of your educational journey and value the bond that continues beyond graduation. Our alumni community, spread across the globe, is a source of pride, contributing to society, advancing professions, and carrying forward the legacy of UAF. This platform is designed to help you reconnect with peers, grow your professional network, and remain engaged with your alma mater. I encourage you to stay connected, participate in events, mentor students, and share your success stories. Your involvement strengthens both our community and the future of UAF. This is your second home. Welcome back!
                                </p>
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

