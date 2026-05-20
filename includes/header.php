<?php
/**
 * Header and Navigation Component
 * Include this file in pages that need the header and sidebar navigation
 */
?>
<!-- Header/Navigation -->
<header class="bg-white shadow-sm sticky top-0 z-50">
    <nav class="container mx-auto px-4 py-4">
        <div class="flex items-center justify-between">
            <div class="flex items-center space-x-3">
                <div class="bg-green-700 p-2 rounded-lg">
                    <img src="assets/logo.png" alt="UAF Logo" class="h-10 w-auto">
                </div>
                <div>
                    <h1 class="text-xl font-bold text-green-700">University of Agriculture</h1>
                    <p class="text-sm text-gray-600">Faisalabad</p>
                </div>
            </div>
            <div class="flex items-center space-x-3">
                <a href="admin/index.php?action=login" target="_blank" class="bg-green-700 text-white px-6 py-2 rounded-md hover:bg-green-800 transition font-medium">
                    Alumni Login
                </a>
                <button class="bg-green-700 text-white p-2 rounded-md hover:bg-green-800 transition" id="menuToggleBtn">
                    <i class="ri-menu-line text-2xl"></i>
                </button>
            </div>
        </div>
    </nav>
</header>

<!-- Sidebar Navigation -->
<div id="sidebarMenu" class="fixed top-0 right-0 h-full w-80 bg-white shadow-2xl z-50 transform translate-x-full transition-transform duration-300 overflow-y-auto">
    <div class="p-6">
        <!-- Close Button -->
        <div class="flex justify-end mb-6">
            <button id="closeSidebarBtn" class="bg-green-700 text-white p-2 rounded-md hover:bg-green-800 transition">
                <i class="ri-close-line text-2xl"></i>
            </button>
        </div>
        
        <!-- Logo -->
        <div class="flex items-center space-x-3 mb-8">
            <div class="bg-green-700 p-2 rounded-lg">
                <img src="assets/logo.png" alt="UAF Logo" class="h-8 w-auto">
            </div>
            <div>
                <h2 class="text-lg font-bold text-green-700">University of Agriculture</h2>
                <p class="text-sm text-gray-600">Faisalabad</p>
            </div>
        </div>
        
        <!-- Menu Items -->
        <nav class="space-y-1">
            <?php
            // Get current page filename to highlight active menu item
            $currentPage = basename($_SERVER['PHP_SELF']);
            ?>
            <a href="index.php" class="block py-3 px-4 text-gray-700 hover:bg-gray-100 hover:text-green-700 transition border-b border-gray-200 <?php echo ($currentPage == 'index.php') ? 'bg-gray-50' : ''; ?>">
                Home
            </a>
            <a href="about.php" class="block py-3 px-4 text-gray-700 hover:bg-gray-100 hover:text-green-700 transition border-b border-gray-200 <?php echo ($currentPage == 'about.php') ? 'bg-gray-50' : ''; ?>">
                About
            </a>
            <a href="jobs.php" class="block py-3 px-4 text-gray-700 hover:bg-gray-100 hover:text-green-700 transition border-b border-gray-200 <?php echo ($currentPage == 'jobs.php') ? 'bg-gray-50' : ''; ?>">
                Jobs
            </a>
            <a href="events.php" class="block py-3 px-4 text-gray-700 hover:bg-gray-100 hover:text-green-700 transition border-b border-gray-200 <?php echo ($currentPage == 'events.php') ? 'bg-gray-50' : ''; ?>">
                Events
            </a>
            <a href="perks.php" class="block py-3 px-4 text-gray-700 hover:bg-gray-100 hover:text-green-700 transition border-b border-gray-200 <?php echo ($currentPage == 'perks.php') ? 'bg-gray-50' : ''; ?>">
                Perks & Benefits
            </a>
            <a href="give-back.php" class="block py-3 px-4 text-gray-700 hover:bg-gray-100 hover:text-green-700 transition border-b border-gray-200 <?php echo ($currentPage == 'give-back.php') ? 'bg-gray-50' : ''; ?>">
                Give Back
            </a>
            <a href="associations.php" class="block py-3 px-4 text-gray-700 hover:bg-gray-100 hover:text-green-700 transition border-b border-gray-200 <?php echo ($currentPage == 'associations.php') ? 'bg-gray-50' : ''; ?>">
                Associations
            </a>
            <div class="border-b border-gray-200">
                <button id="chaptersToggle" class="w-full flex items-center justify-between py-3 px-4 text-gray-700 hover:bg-gray-100 hover:text-green-700 transition">
                    <span>Chapters</span>
                    <i class="ri-add-line text-xl"></i>
                </button>
                    <div id="chaptersSubmenu" class="hidden pl-6 pb-2">
                        <a href="chapters-national.php" class="block py-2 px-4 text-gray-600 hover:text-green-700 transition">National Chapters</a>
                        <a href="chapters-international.php" class="block py-2 px-4 text-gray-600 hover:text-green-700 transition">International Chapters</a>
                    </div>
            </div>
            <a href="newsletters.php" class="block py-3 px-4 text-gray-700 hover:bg-gray-100 hover:text-green-700 transition border-b border-gray-200 <?php echo ($currentPage == 'newsletters.php') ? 'bg-gray-50' : ''; ?>">
                Newsletters
            </a>
            <a href="contact.php" class="block py-3 px-4 text-gray-700 hover:bg-gray-100 hover:text-green-700 transition border-b border-gray-200 <?php echo ($currentPage == 'contact.php') ? 'bg-gray-50' : ''; ?>">
                Contact Us
            </a>
        </nav>
    </div>
</div>

<!-- Sidebar Overlay -->
<div id="sidebarOverlay" class="fixed inset-0 bg-black bg-opacity-50 z-40 hidden"></div>

