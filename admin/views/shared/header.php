<!-- Header -->
<header class="bg-white shadow-sm fixed top-0 left-0 right-0 lg:left-64 z-50 border-b border-gray-200">
    <div class="px-4 md:px-6 py-4">
        <div class="flex items-center justify-between">
            <!-- Left: Menu Toggle and Search -->
            <div class="flex items-center space-x-4 flex-1">
                <button type="button" class="text-gray-700 hover:text-green-700 transition p-2" id="hide-sidebar-toggle">
                    <i class="ri-menu-line text-2xl"></i>
                </button>
                
                <form class="hidden md:block relative flex-1 max-w-md" action="index.php" method="GET">
                    <input type="hidden" name="action" value="search">
                    <input type="text" 
                           name="q" 
                           placeholder="Search here....." 
                           class="w-full px-4 py-2 pl-10 border border-gray-300 rounded-lg focus:ring-2 focus:ring-green-500 focus:border-green-500 outline-none">
                    <button type="submit" class="absolute left-3 top-1/2 -translate-y-1/2 text-gray-500 hover:text-green-700">
                        <i class="ri-search-line"></i>
                    </button>
                </form>
            </div>
            
            <!-- Right: User Menu and Actions -->
            <div class="flex items-center space-x-4">
                <!-- Notifications -->
                <button type="button" class="relative text-gray-700 hover:text-green-700 transition p-2" id="notificationsBtn">
                    <i class="ri-notification-line text-xl"></i>
                    <span class="absolute top-1 right-1 w-2 h-2 bg-red-500 rounded-full"></span>
                </button>
                
                <!-- Profile Dropdown -->
                <div class="relative" id="profileDropdown">
                    <button type="button" class="flex items-center space-x-2 text-gray-700 hover:text-green-700 transition" id="profileToggleBtn">
                        <?php 
                        $profilePic = !empty($_SESSION['profile_picture']) ? 'assets/images/profiles/' . $_SESSION['profile_picture'] : 'assets/images/admin.png';
                        ?>
                        <img src="<?= htmlspecialchars($profilePic) ?>" 
                             class="w-10 h-10 rounded-full border-2 border-green-700" 
                             alt="Profile">
                        <span class="hidden md:block font-medium"><?= htmlspecialchars($_SESSION['name'] ?? 'User') ?></span>
                        <i class="ri-arrow-down-s-line"></i>
                    </button>
                    
                    <!-- Dropdown Menu -->
                    <div id="profileDropdownMenu" class="hidden absolute right-0 mt-2 w-48 bg-white rounded-lg shadow-lg border border-gray-200 py-2 z-50">
                        <div class="px-4 py-3 border-b border-gray-200">
                            <p class="font-semibold text-gray-800"><?= htmlspecialchars($_SESSION['name'] ?? 'User') ?></p>
                            <p class="text-sm text-gray-500"><?= htmlspecialchars(ucfirst($_SESSION['role'] ?? 'alumni')) ?></p>
                        </div>
                        <a href="index.php?action=profile" class="block px-4 py-2 text-gray-700 hover:bg-gray-100 transition flex items-center space-x-2">
                            <i class="ri-user-line"></i>
                            <span>My Profile</span>
                        </a>
                        <a href="index.php?action=settings" class="block px-4 py-2 text-gray-700 hover:bg-gray-100 transition flex items-center space-x-2">
                            <i class="ri-settings-line"></i>
                            <span>Settings</span>
                        </a>
                        <div class="border-t border-gray-200 my-2"></div>
                        <a href="index.php?action=logout" class="block px-4 py-2 text-red-600 hover:bg-red-50 transition flex items-center space-x-2">
                            <i class="ri-logout-box-line"></i>
                            <span>Logout</span>
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</header>

<script>
    // Profile dropdown toggle
    document.getElementById('profileToggleBtn')?.addEventListener('click', function(e) {
        e.stopPropagation();
        const menu = document.getElementById('profileDropdownMenu');
        menu.classList.toggle('hidden');
    });
    
    // Close dropdown when clicking outside
    document.addEventListener('click', function(e) {
        const dropdown = document.getElementById('profileDropdown');
        const menu = document.getElementById('profileDropdownMenu');
        if (!dropdown.contains(e.target)) {
            menu.classList.add('hidden');
        }
    });
</script>
