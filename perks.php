<?php
/**
 * Perks & Benefits Page - University of Agriculture Faisalabad Alumni Portal
 */
?>
<!DOCTYPE html>
<html lang="en" dir="ltr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Perks & Benefits - Alumni Portal - University of Agriculture Faisalabad</title>
    
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
                    <span>Perks & Benefits</span>
                </div>
                
                <!-- Main Title -->
                <h1 class="text-5xl md:text-6xl lg:text-7xl font-bold text-center">
                    Perks & Benefits
                </h1>
            </div>
        </section>

        <!-- Information Bar -->
        <section class="bg-green-700 py-4">
            <div class="container mx-auto px-4">
                <p class="text-white text-center text-sm md:text-base">
                    Note: These benefits are exclusively associated with the <a href="#" class="underline font-semibold hover:text-green-200">Alumni Honor Card</a>. <a href="#" class="underline font-semibold hover:text-green-200">Apply here</a>.
                </p>
            </div>
        </section>

        <!-- Benefits Overview Cards -->
        <section class="py-16 bg-green-700">
            <div class="container mx-auto px-4">
                <h2 class="text-4xl md:text-5xl font-bold text-white mb-12 text-center">
                    Perks & Benefits
                </h2>
                <div class="grid grid-cols-2 md:grid-cols-3 lg:grid-cols-6 gap-4 md:gap-6">
                    
                    <!-- Card 1: Academic Benefits -->
                    <div class="bg-amber-50 rounded-lg p-6 text-center hover:shadow-lg transition">
                        <div class="w-16 h-16 mx-auto mb-4 flex items-center justify-center">
                            <i class="ri-book-open-line text-green-700 text-5xl"></i>
                        </div>
                        <h3 class="font-bold text-gray-800 text-sm md:text-base">Academic Benefits</h3>
                    </div>
                    
                    <!-- Card 2: Healthcare Benefits -->
                    <div class="bg-amber-50 rounded-lg p-6 text-center hover:shadow-lg transition">
                        <div class="w-16 h-16 mx-auto mb-4 flex items-center justify-center">
                            <i class="ri-heart-pulse-line text-green-700 text-5xl"></i>
                        </div>
                        <h3 class="font-bold text-gray-800 text-sm md:text-base">Healthcare Benefits</h3>
                    </div>
                    
                    <!-- Card 3: Campus Facilities -->
                    <div class="bg-amber-50 rounded-lg p-6 text-center hover:shadow-lg transition">
                        <div class="w-16 h-16 mx-auto mb-4 flex items-center justify-center">
                            <i class="ri-building-line text-green-700 text-5xl"></i>
                        </div>
                        <h3 class="font-bold text-gray-800 text-sm md:text-base">Campus Facilities and Memberships</h3>
                    </div>
                    
                    <!-- Card 4: Merchant Promotions -->
                    <div class="bg-amber-50 rounded-lg p-6 text-center hover:shadow-lg transition">
                        <div class="w-16 h-16 mx-auto mb-4 flex items-center justify-center">
                            <i class="ri-store-line text-green-700 text-5xl"></i>
                        </div>
                        <h3 class="font-bold text-gray-800 text-sm md:text-base">Merchant and Business Promotions</h3>
                    </div>
                    
                    <!-- Card 5: Career and Mentorship -->
                    <div class="bg-amber-50 rounded-lg p-6 text-center hover:shadow-lg transition">
                        <div class="w-16 h-16 mx-auto mb-4 flex items-center justify-center">
                            <i class="ri-line-chart-line text-green-700 text-5xl"></i>
                        </div>
                        <h3 class="font-bold text-gray-800 text-sm md:text-base">Career and Mentorship</h3>
                    </div>
                    
                    <!-- Card 6: Chapters & Engagement -->
                    <div class="bg-amber-50 rounded-lg p-6 text-center hover:shadow-lg transition">
                        <div class="w-16 h-16 mx-auto mb-4 flex items-center justify-center">
                            <i class="ri-graduation-cap-line text-green-700 text-5xl"></i>
                        </div>
                        <h3 class="font-bold text-gray-800 text-sm md:text-base">Chapters & Engagement Events</h3>
                    </div>
                    
                </div>
            </div>
        </section>

        <!-- Academic Benefits & Identity Section -->
        <section class="py-16 bg-white">
            <div class="container mx-auto px-4">
                <div class="grid grid-cols-1 lg:grid-cols-2 gap-12 max-w-7xl mx-auto">
                    
                    <!-- Left Column: Academic Benefits -->
                    <div>
                        <h2 class="text-3xl md:text-4xl font-bold text-green-700 mb-8">
                            Academic Benefits
                        </h2>
                        
                        <!-- Kinship Discount -->
                        <div class="mb-8">
                            <div class="flex items-start gap-4 mb-3">
                                <div class="w-12 h-12 bg-green-100 rounded-lg flex items-center justify-center flex-shrink-0">
                                    <i class="ri-group-line text-green-700 text-2xl"></i>
                                </div>
                                <div class="flex-1">
                                    <h3 class="text-xl font-bold text-gray-800 mb-2">Kinship Discount</h3>
                                    <p class="text-gray-700 leading-relaxed">
                                        UAF Alumni, along with their immediate family members and siblings, are entitled to <strong>special discounts on tuition fees</strong> for all undergraduate and postgraduate programs.
                                    </p>
                                </div>
                            </div>
                        </div>
                        
                        <!-- Masters or PhD Alumni Scholarship -->
                        <div class="mb-8">
                            <div class="flex items-start gap-4 mb-3">
                                <div class="w-12 h-12 bg-green-100 rounded-lg flex items-center justify-center flex-shrink-0">
                                    <i class="ri-graduation-cap-fill text-green-700 text-2xl"></i>
                                </div>
                                <div class="flex-1">
                                    <h3 class="text-xl font-bold text-gray-800 mb-2">Masters or PhD Alumni Scholarship</h3>
                                    <ul class="text-gray-700 space-y-1 mb-3">
                                        <li>• Significant discounts on admission fees</li>
                                        <li>• Generous tuition discounts for Master's and PhD programs</li>
                                        <li>• Additional discounts for Gold Medalists</li>
                                    </ul>
                                    <a href="#" class="text-blue-600 underline hover:text-blue-800">Apply Here</a>
                                </div>
                            </div>
                        </div>
                        
                        <!-- International Collaborations -->
                        <div>
                            <div class="flex items-start gap-4 mb-3">
                                <div class="w-12 h-12 bg-green-100 rounded-lg flex items-center justify-center flex-shrink-0">
                                    <i class="ri-checkbox-circle-line text-green-700 text-2xl"></i>
                                </div>
                                <div class="flex-1">
                                    <h3 class="text-xl font-bold text-gray-800 mb-2">International Collaborations</h3>
                                    <p class="text-gray-700 leading-relaxed">
                                        Same discounts and services to UAF students pursuing international graduate programs through UAF's partnerships with international universities.
                                    </p>
                                </div>
                            </div>
                        </div>
                    </div>
                    
                    <!-- Right Column: Identity, Inclusion and Recognition -->
                    <div>
                        <h2 class="text-3xl md:text-4xl font-bold text-green-700 mb-8">
                            Identity, Inclusion and Recognition
                        </h2>
                        
                        <!-- Awards for High Achievers -->
                        <div class="mb-8">
                            <div class="flex items-start gap-4 mb-3">
                                <div class="w-12 h-12 bg-green-100 rounded-lg flex items-center justify-center flex-shrink-0">
                                    <i class="ri-award-line text-green-700 text-2xl"></i>
                                </div>
                                <div class="flex-1">
                                    <h3 class="text-xl font-bold text-gray-800 mb-2">Awards for High Achievers</h3>
                                    <p class="text-gray-700 leading-relaxed">
                                        Quarterly awards and recognitions in Professional Excellence, Entrepreneurship, and Community Service <strong>presented by Board of Governors</strong>.
                                    </p>
                                </div>
                            </div>
                        </div>
                        
                        <!-- Wall of Fame & Spotlight -->
                        <div class="mb-8">
                            <div class="flex items-start gap-4 mb-3">
                                <div class="w-12 h-12 bg-green-100 rounded-lg flex items-center justify-center flex-shrink-0">
                                    <i class="ri-star-fill text-green-700 text-2xl"></i>
                                </div>
                                <div class="flex-1">
                                    <h3 class="text-xl font-bold text-gray-800 mb-2">Wall of Fame & Spotlight</h3>
                                    <ul class="text-gray-700 space-y-1">
                                        <li>• Display of Alumni picture and profile on walls of fame at various locations within UAF campuses as well as on Online platforms</li>
                                        <li>• Alumni Success Stories featured and highlighted on UAF website, newsletters and social media.</li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                        
                        <!-- Alumni Email -->
                        <div>
                            <div class="flex items-start gap-4 mb-3">
                                <div class="w-12 h-12 bg-green-100 rounded-lg flex items-center justify-center flex-shrink-0">
                                    <i class="ri-mail-line text-green-700 text-2xl"></i>
                                </div>
                                <div class="flex-1">
                                    <h3 class="text-xl font-bold text-gray-800 mb-2">Alumni Email</h3>
                                    <p class="text-gray-700 leading-relaxed">
                                        Lifetime Alumni email address (@alumni.uaf.edu.pk) to maintain professional and academic engagement.
                                    </p>
                                </div>
                            </div>
                        </div>
                    </div>
                    
                </div>
            </div>
        </section>

        <!-- Career and Mentorship Section -->
        <section class="py-16 bg-gray-50">
            <div class="container mx-auto px-4">
                <div class="max-w-7xl mx-auto">
                    <h2 class="text-3xl md:text-4xl font-bold text-green-700 mb-12 text-center">
                        Career and Mentorship
                    </h2>
                    
                    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
                        
                        <!-- Career Counselling & Job Placement -->
                        <div>
                            <div class="flex items-start gap-4 mb-3">
                                <div class="w-12 h-12 bg-green-100 rounded-lg flex items-center justify-center flex-shrink-0">
                                    <i class="ri-briefcase-line text-green-700 text-2xl"></i>
                                </div>
                                <div class="flex-1">
                                    <h3 class="text-xl font-bold text-gray-800 mb-2">Career Counselling & Job Placement</h3>
                                    <ul class="text-gray-700 space-y-1 text-sm">
                                        <li>• Exclusive access to one-on-one Career Counselling services by UAF Alumni Office</li>
                                        <li>• Access to jobs offered by UAF and Partner companies via <span class="underline">Alumni Website</span>, <span class="underline">Career Portal</span>, <span class="underline">Email</span>, and <span class="underline">Social Media</span>.</li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                        
                        <!-- Upskill and Reskill Courses -->
                        <div>
                            <div class="flex items-start gap-4 mb-3">
                                <div class="w-12 h-12 bg-green-100 rounded-lg flex items-center justify-center flex-shrink-0">
                                    <i class="ri-graduation-cap-line text-green-700 text-2xl"></i>
                                </div>
                                <div class="flex-1">
                                    <h3 class="text-xl font-bold text-gray-800 mb-2">Upskill and Reskill Courses</h3>
                                    <p class="text-gray-700 text-sm leading-relaxed">
                                        Special <span class="underline">discounts</span> on professional, and executive <span class="underline">language programs</span>, <span class="underline">IT programs</span> and skill development courses offered by various faculties and departments to stay relevant in today's job market.
                                    </p>
                                </div>
                            </div>
                        </div>
                        
                        <!-- Mentorship & Coaching -->
                        <div>
                            <div class="flex items-start gap-4 mb-3">
                                <div class="w-12 h-12 bg-green-100 rounded-lg flex items-center justify-center flex-shrink-0">
                                    <i class="ri-checkbox-circle-line text-green-700 text-2xl"></i>
                                </div>
                                <div class="flex-1">
                                    <h3 class="text-xl font-bold text-gray-800 mb-2">Mentorship & Coaching</h3>
                                    <p class="text-gray-700 text-sm leading-relaxed">
                                        Complimentary mentorship and coaching session (through prior registration) with professional mentors or industry experts.
                                    </p>
                                </div>
                            </div>
                        </div>
                        
                        <!-- Workshops & Conferences -->
                        <div>
                            <div class="flex items-start gap-4 mb-3">
                                <div class="w-12 h-12 bg-green-100 rounded-lg flex items-center justify-center flex-shrink-0">
                                    <i class="ri-file-list-line text-green-700 text-2xl"></i>
                                </div>
                                <div class="flex-1">
                                    <h3 class="text-xl font-bold text-gray-800 mb-2">Workshops & Conferences</h3>
                                    <p class="text-gray-700 text-sm leading-relaxed">
                                        Invitations to university-organized workshops, training sessions, bootcamps and international conferences.
                                    </p>
                                </div>
                            </div>
                        </div>
                        
                        <!-- Job Fairs and Recruitment Drives -->
                        <div>
                            <div class="flex items-start gap-4 mb-3">
                                <div class="w-12 h-12 bg-green-100 rounded-lg flex items-center justify-center flex-shrink-0">
                                    <i class="ri-file-list-line text-green-700 text-2xl"></i>
                                </div>
                                <div class="flex-1">
                                    <h3 class="text-xl font-bold text-gray-800 mb-2">Job Fairs and Recruitment Drives</h3>
                                    <p class="text-gray-700 text-sm leading-relaxed">
                                        Alumni participation in UAF-organized recruitment drives, career expos, both as job seeker or employer (through prior registration)
                                    </p>
                                </div>
                            </div>
                        </div>
                        
                    </div>
                </div>
            </div>
        </section>

        <!-- Healthcare & Merchant Promotions Section -->
        <section class="py-16 bg-white">
            <div class="container mx-auto px-4">
                <div class="grid grid-cols-1 lg:grid-cols-2 gap-12 max-w-7xl mx-auto">
                    
                    <!-- Left Column: Healthcare Benefits -->
                    <div>
                        <h2 class="text-3xl md:text-4xl font-bold text-green-700 mb-8">
                            Healthcare Benefits
                        </h2>
                        <div class="mb-6">
                            <div class="w-16 h-16 bg-green-100 rounded-lg flex items-center justify-center mb-4">
                                <i class="ri-hospital-line text-green-700 text-4xl"></i>
                            </div>
                            <h3 class="text-xl font-bold text-gray-800 mb-2">Medical Consultation & Diagnostic Services</h3>
                            <p class="text-gray-700 leading-relaxed">
                                Alumni and family members receive the <strong>same discounts</strong> and medical privileges as UAF students and staff at UAF medical facilities.
                            </p>
                        </div>
                    </div>
                    
                    <!-- Right Column: Merchant and Business Promotions -->
                    <div>
                        <h2 class="text-3xl md:text-4xl font-bold text-green-700 mb-8">
                            Merchant and Business Promotions
                        </h2>
                        
                        <!-- Partnered Merchants -->
                        <div class="mb-8">
                            <div class="flex items-start gap-4 mb-3">
                                <div class="w-12 h-12 bg-green-100 rounded-lg flex items-center justify-center flex-shrink-0">
                                    <i class="ri-shopping-cart-line text-green-700 text-2xl"></i>
                                </div>
                                <div class="flex-1">
                                    <h3 class="text-xl font-bold text-gray-800 mb-2">Partnered Merchants</h3>
                                    <p class="text-gray-700 leading-relaxed">
                                        Exclusive discounts at partnered restaurants, retail outlets, and service providers, equivalent to those offered to current students
                                    </p>
                                </div>
                            </div>
                        </div>
                        
                        <!-- Start-up Launch & Support -->
                        <div>
                            <div class="flex items-start gap-4 mb-3">
                                <div class="w-12 h-12 bg-green-100 rounded-lg flex items-center justify-center flex-shrink-0">
                                    <i class="ri-checkbox-circle-line text-green-700 text-2xl"></i>
                                </div>
                                <div class="flex-1">
                                    <h3 class="text-xl font-bold text-gray-800 mb-2">Start-up Launch & Support</h3>
                                    <ul class="text-gray-700 space-y-1">
                                        <li>• Promotion of alumni-led start-ups and businesses on official social media platforms for visibility and reach.</li>
                                        <li>• Support to Alumni on their Start-up incubation or accelerator programs. (through iHub), Entrepreneurship, bootcamps, joint research and innovation challenges</li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>
                    
                </div>
            </div>
        </section>

        <!-- Networking & Campus Facilities Section -->
        <section class="py-16 bg-gray-50">
            <div class="container mx-auto px-4">
                <div class="grid grid-cols-1 lg:grid-cols-2 gap-12 max-w-7xl mx-auto">
                    
                    <!-- Left Column: Networking: Chapters & Engagement -->
                    <div>
                        <h2 class="text-3xl md:text-4xl font-bold text-green-700 mb-8">
                            Networking: Chapters & Engagement
                        </h2>
                        
                        <div class="space-y-6">
                            <!-- Alumni Chapters -->
                            <div class="flex items-start gap-4">
                                <div class="w-12 h-12 bg-green-100 rounded-lg flex items-center justify-center flex-shrink-0">
                                    <i class="ri-group-line text-green-700 text-2xl"></i>
                                </div>
                                <div class="flex-1">
                                    <h3 class="text-xl font-bold text-gray-800 mb-2">Alumni Chapters</h3>
                                    <p class="text-gray-700 leading-relaxed">
                                        Join local, regional, and international UAF Alumni Chapters for professional collaboration and networking.
                                    </p>
                                </div>
                            </div>
                            
                            <!-- Alumni Associations -->
                            <div class="flex items-start gap-4">
                                <div class="w-12 h-12 bg-green-100 rounded-lg flex items-center justify-center flex-shrink-0">
                                    <i class="ri-checkbox-circle-line text-green-700 text-2xl"></i>
                                </div>
                                <div class="flex-1">
                                    <h3 class="text-xl font-bold text-gray-800 mb-2">Alumni Associations</h3>
                                    <p class="text-gray-700 leading-relaxed">
                                        Engage with faculty-specific, subject-based or cause-specific associations for shared learning and collaboration.
                                    </p>
                                </div>
                            </div>
                            
                            <!-- Advisory Roles -->
                            <div class="flex items-start gap-4">
                                <div class="w-12 h-12 bg-green-100 rounded-lg flex items-center justify-center flex-shrink-0">
                                    <i class="ri-star-line text-green-700 text-2xl"></i>
                                </div>
                                <div class="flex-1">
                                    <h3 class="text-xl font-bold text-gray-800 mb-2">Advisory Roles</h3>
                                    <p class="text-gray-700 leading-relaxed">
                                        Serve on advisory boards, industry panels, and accreditation review committees.
                                    </p>
                                </div>
                            </div>
                            
                            <!-- Networking Events -->
                            <div class="flex items-start gap-4">
                                <div class="w-12 h-12 bg-green-100 rounded-lg flex items-center justify-center flex-shrink-0">
                                    <i class="ri-mail-line text-green-700 text-2xl"></i>
                                </div>
                                <div class="flex-1">
                                    <h3 class="text-xl font-bold text-gray-800 mb-2">Networking Events</h3>
                                    <p class="text-gray-700 leading-relaxed">
                                        Regular Alumni meet-ups, professional mixers, and engagement events throughout the year.
                                    </p>
                                </div>
                            </div>
                            
                            <!-- Alumni Talks and Podcasts -->
                            <div class="flex items-start gap-4">
                                <div class="w-12 h-12 bg-green-100 rounded-lg flex items-center justify-center flex-shrink-0">
                                    <i class="ri-group-line text-green-700 text-2xl"></i>
                                </div>
                                <div class="flex-1">
                                    <h3 class="text-xl font-bold text-gray-800 mb-2">Alumni Talks and Podcasts</h3>
                                    <ul class="text-gray-700 space-y-1">
                                        <li>• Participation as mentor or guest speaker to deliver a talk to UAF students</li>
                                        <li>• Appearing in Alumni Podcast series to promote UAF alumni on various platforms</li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>
                    
                    <!-- Right Column: Campus Facilities and Memberships -->
                    <div>
                        <h2 class="text-3xl md:text-4xl font-bold text-green-700 mb-8">
                            Campus Facilities and Memberships
                        </h2>
                        
                        <div class="space-y-6">
                            <!-- Gym & Pool Membership -->
                            <div class="flex items-start gap-4">
                                <div class="w-12 h-12 bg-green-100 rounded-lg flex items-center justify-center flex-shrink-0">
                                    <i class="ri-dumbbell-line text-green-700 text-2xl"></i>
                                </div>
                                <div class="flex-1">
                                    <h3 class="text-xl font-bold text-gray-800 mb-2">Gym & Pool Membership</h3>
                                    <p class="text-gray-700 leading-relaxed">
                                        Alumni are eligible for a <span class="text-green-700 font-semibold">special discount</span> on gym and swimming pool memberships. Additionally, three complimentary membership coupons are distributed monthly through a lucky draw, encouraging continued physical and mental wellness.
                                    </p>
                                </div>
                            </div>
                            
                            <!-- UAF Sports Club -->
                            <div class="flex items-start gap-4">
                                <div class="w-12 h-12 bg-green-100 rounded-lg flex items-center justify-center flex-shrink-0">
                                    <i class="ri-checkbox-circle-line text-green-700 text-2xl"></i>
                                </div>
                                <div class="flex-1">
                                    <h3 class="text-xl font-bold text-gray-800 mb-2">UAF Sports Club</h3>
                                    <p class="text-gray-700 leading-relaxed">
                                        Alumni sports enthusiasts can enjoy a <span class="text-green-700 font-semibold">50% discount</span> on club memberships or the same discount offered to current students (whichever is greater). Alumni are also invited to register free of cost for select inter-university and friendly tournaments.
                                    </p>
                                </div>
                            </div>
                            
                            <!-- General Campus Access -->
                            <div class="flex items-start gap-4">
                                <div class="w-12 h-12 bg-green-100 rounded-lg flex items-center justify-center flex-shrink-0">
                                    <i class="ri-graduation-cap-line text-green-700 text-2xl"></i>
                                </div>
                                <div class="flex-1">
                                    <h3 class="text-xl font-bold text-gray-800 mb-2">General Campus Access</h3>
                                    <p class="text-gray-700 leading-relaxed">
                                        UAF Alumni can continue to access study lounges, the sports complex, and library facilities, ensuring they remain connected to campus life.
                                    </p>
                                </div>
                            </div>
                            
                            <!-- Library Resources -->
                            <div class="flex items-start gap-4">
                                <div class="w-12 h-12 bg-green-100 rounded-lg flex items-center justify-center flex-shrink-0">
                                    <i class="ri-book-open-line text-green-700 text-2xl"></i>
                                </div>
                                <div class="flex-1">
                                    <h3 class="text-xl font-bold text-gray-800 mb-2">Library Resources</h3>
                                    <p class="text-gray-700 leading-relaxed">
                                        Free on-campus library access and complimentary digital library access to stay connected with academic resources.
                                    </p>
                                </div>
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

