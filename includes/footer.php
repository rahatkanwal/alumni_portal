<?php
/**
 * Footer Component
 * Include this file in pages that need the footer
 */
?>
<!-- Newsletter Subscribe -->
<section class="bg-gradient-to-r from-green-700 to-green-800 py-12">
    <div class="container mx-auto px-4 text-center text-white">
        <h2 class="text-2xl md:text-3xl font-bold mb-2">Stay Connected</h2>
        <p class="text-green-100 mb-6">Subscribe to our newsletter for events, news, and alumni updates.</p>
        <?php
        if (isset($_GET['subscribed'])) echo '<p class="bg-white/20 inline-block px-4 py-2 rounded mb-4">✓ Subscribed successfully!</p>';
        ?>
        <form method="POST" action="admin/index.php?action=newsletter_subscribe" class="flex flex-col sm:flex-row gap-3 max-w-lg mx-auto">
            <input type="text" name="name" placeholder="Your name" class="flex-1 px-4 py-3 rounded-lg text-gray-800 focus:outline-none">
            <input type="email" name="email" placeholder="your@email.com" required class="flex-1 px-4 py-3 rounded-lg text-gray-800 focus:outline-none">
            <input type="hidden" name="redirect" value="/alumni_portal/?subscribed=1">
            <button class="bg-white text-green-700 font-bold px-6 py-3 rounded-lg hover:bg-green-50 transition">Subscribe</button>
        </form>
    </div>
</section>

<!-- Footer -->
<footer class="bg-gray-100 py-12">
    <div class="container mx-auto px-4">
        <div class="grid grid-cols-1 md:grid-cols-3 gap-8 mb-8">
            <!-- Logo Section -->
            <div>
                <div class="flex items-center space-x-3 mb-4">
                    <img src="assets/logo.png" alt="UAF Logo" class="h-10 w-auto">
                    <div>
                        <h3 class="font-bold text-gray-800">University of Agriculture</h3>
                        <p class="text-sm text-gray-600">Faisalabad</p>
                    </div>
                </div>
            </div>
            
            <!-- Quick Links -->
            <div>
                <h4 class="font-bold text-gray-800 mb-4">Quick Links</h4>
                <ul class="space-y-2">
                    <li><a href="about.php" class="text-gray-600 hover:text-green-700">About Us</a></li>
                    <li><a href="jobs.php" class="text-gray-600 hover:text-green-700">Jobs</a></li>
                    <li><a href="events.php" class="text-gray-600 hover:text-green-700">Events</a></li>
                    <li><a href="newsletters.php" class="text-gray-600 hover:text-green-700">News &amp; Announcements</a></li>
                    <li><a href="success-stories.php" class="text-gray-600 hover:text-green-700">Success Stories</a></li>
                    <li><a href="gallery.php" class="text-gray-600 hover:text-green-700">Photo Gallery</a></li>
                    <li><a href="contact.php" class="text-gray-600 hover:text-green-700">Contact Us</a></li>
                </ul>
            </div>
            
            <!-- Alumni Links -->
            <div>
                <h4 class="font-bold text-gray-800 mb-4">Alumni</h4>
                <ul class="space-y-2">
                    <li><a href="perks.php" class="text-gray-600 hover:text-green-700">Alumni Perks & Benefits</a></li>
                    <li><a href="give-back.php" class="text-gray-600 hover:text-green-700">Give Back</a></li>
                    <li><a href="associations.php" class="text-gray-600 hover:text-green-700">Alumni Associations</a></li>
                    <li><a href="#" class="text-gray-600 hover:text-green-700">National Chapters</a></li>
                    <li><a href="#" class="text-gray-600 hover:text-green-700">International Chapters</a></li>
                </ul>
            </div>
        </div>
        
        <!-- Social Media & Copyright -->
        <div class="border-t border-gray-300 pt-8">
            <div class="flex flex-col md:flex-row justify-between items-center">
                <div class="flex space-x-4 mb-4 md:mb-0">
                    <a href="#" class="text-gray-600 hover:text-green-700 text-2xl">
                        <i class="ri-facebook-fill"></i>
                    </a>
                    <a href="#" class="text-gray-600 hover:text-green-700 text-2xl">
                        <i class="ri-linkedin-fill"></i>
                    </a>
                    <a href="#" class="text-gray-600 hover:text-green-700 text-2xl">
                        <i class="ri-instagram-fill"></i>
                    </a>
                    <a href="#" class="text-gray-600 hover:text-green-700 text-2xl">
                        <i class="ri-twitter-x-fill"></i>
                    </a>
                </div>
                <p class="text-gray-600 text-sm text-center md:text-right">
                    ©2025 UAF Alumni. All rights reserved by The University of Agriculture Faisalabad
                </p>
            </div>
        </div>
    </div>
</footer>

