<?php
$currentAction = $_GET['action'] ?? '';
$isAdmin = ($_SESSION['role'] ?? '') === 'admin';
function navClass($action, $matches) {
    return in_array($action, (array)$matches) ? 'bg-green-700 text-white' : 'text-gray-700 hover:bg-gray-100';
}
?>
<aside id="sidebar-area" class="fixed left-0 top-0 h-screen w-64 bg-white shadow-lg z-30 transform -translate-x-full transition-transform duration-300 lg:translate-x-0">
    <div class="h-full flex flex-col">
        <div class="p-6 border-b border-gray-200 flex items-center justify-between">
            <a href="index.php?action=<?= $isAdmin ? 'admin_dashboard' : 'dashboard' ?>" class="flex items-center space-x-3">
                <div class="bg-green-700 p-2 rounded-lg">
                    <img src="../assets/logo.png" alt="UAF Logo" class="h-8 w-auto">
                </div>
                <span class="font-bold text-gray-800 text-sm">UAF Alumni</span>
            </a>
            <button type="button" class="lg:hidden text-gray-700 hover:text-green-700 transition" id="hide-sidebar-toggle2">
                <i class="ri-close-line text-2xl"></i>
            </button>
        </div>

        <nav class="flex-1 overflow-y-auto p-4 text-sm">
            <p class="text-xs font-semibold text-gray-500 uppercase tracking-wider mb-2 px-3">Main</p>
            <ul class="space-y-1 mb-4">
                <li>
                    <a href="index.php?action=<?= $isAdmin ? 'admin_dashboard' : 'dashboard' ?>" class="flex items-center space-x-3 px-3 py-2 rounded-lg <?= navClass($currentAction, ['dashboard', 'admin_dashboard']) ?>">
                        <i class="ri-dashboard-line text-lg"></i><span class="font-medium">Dashboard</span>
                    </a>
                </li>
                <?php if (!$isAdmin): ?>
                <li>
                    <a href="index.php?action=profile" class="flex items-center space-x-3 px-3 py-2 rounded-lg <?= navClass($currentAction, ['profile', 'profile_edit']) ?>">
                        <i class="ri-user-line text-lg"></i><span class="font-medium">My Profile</span>
                    </a>
                </li>
                <li>
                    <a href="index.php?action=badges" class="flex items-center space-x-3 px-3 py-2 rounded-lg <?= navClass($currentAction, 'badges') ?>">
                        <i class="ri-medal-line text-lg"></i><span class="font-medium">My Badges</span>
                    </a>
                </li>
                <li>
                    <a href="index.php?action=honor_card_apply" class="flex items-center space-x-3 px-3 py-2 rounded-lg <?= navClass($currentAction, 'honor_card_apply') ?>">
                        <i class="ri-bank-card-line text-lg"></i><span class="font-medium">Honor Card</span>
                    </a>
                </li>
                <?php endif; ?>
            </ul>

            <p class="text-xs font-semibold text-gray-500 uppercase tracking-wider mb-2 px-3">Community</p>
            <ul class="space-y-1 mb-4">
                <li>
                    <a href="index.php?action=directory" class="flex items-center space-x-3 px-3 py-2 rounded-lg <?= navClass($currentAction, ['directory', 'directory_profile']) ?>">
                        <i class="ri-group-line text-lg"></i><span class="font-medium">Alumni Directory</span>
                    </a>
                </li>
                <li>
                    <a href="index.php?action=directory_map" class="flex items-center space-x-3 px-3 py-2 rounded-lg <?= navClass($currentAction, 'directory_map') ?>">
                        <i class="ri-map-pin-line text-lg"></i><span class="font-medium">Alumni Map</span>
                    </a>
                </li>
                <li>
                    <a href="index.php?action=events" class="flex items-center space-x-3 px-3 py-2 rounded-lg <?= navClass($currentAction, ['events', 'event_show', 'event_create', 'event_edit']) ?>">
                        <i class="ri-calendar-line text-lg"></i><span class="font-medium">Events</span>
                    </a>
                </li>
                <li>
                    <a href="index.php?action=news" class="flex items-center space-x-3 px-3 py-2 rounded-lg <?= navClass($currentAction, ['news', 'news_show', 'news_create', 'news_edit']) ?>">
                        <i class="ri-article-line text-lg"></i><span class="font-medium">News &amp; Updates</span>
                    </a>
                </li>
                <li>
                    <a href="index.php?action=gallery" class="flex items-center space-x-3 px-3 py-2 rounded-lg <?= navClass($currentAction, 'gallery') ?>">
                        <i class="ri-gallery-line text-lg"></i><span class="font-medium">Photo Gallery</span>
                    </a>
                </li>
                <li>
                    <a href="index.php?action=activity" class="flex items-center space-x-3 px-3 py-2 rounded-lg <?= navClass($currentAction, 'activity') ?>">
                        <i class="ri-pulse-line text-lg"></i><span class="font-medium">Activity Feed</span>
                    </a>
                </li>
            </ul>

            <p class="text-xs font-semibold text-gray-500 uppercase tracking-wider mb-2 px-3">Career</p>
            <ul class="space-y-1 mb-4">
                <li>
                    <a href="index.php?action=jobs" class="flex items-center space-x-3 px-3 py-2 rounded-lg <?= navClass($currentAction, ['jobs', 'job_show', 'job_create']) ?>">
                        <i class="ri-briefcase-line text-lg"></i><span class="font-medium">Job Board</span>
                    </a>
                </li>
                <li>
                    <a href="index.php?action=mentorship" class="flex items-center space-x-3 px-3 py-2 rounded-lg <?= navClass($currentAction, ['mentorship', 'mentorship_requests']) ?>">
                        <i class="ri-graduation-cap-line text-lg"></i><span class="font-medium">Mentorship</span>
                    </a>
                </li>
                <li>
                    <a href="index.php?action=stories" class="flex items-center space-x-3 px-3 py-2 rounded-lg <?= navClass($currentAction, ['stories', 'story_create']) ?>">
                        <i class="ri-book-open-line text-lg"></i><span class="font-medium">Success Stories</span>
                    </a>
                </li>
                <li>
                    <a href="index.php?action=messages" class="flex items-center space-x-3 px-3 py-2 rounded-lg <?= navClass($currentAction, ['messages', 'conversation']) ?>">
                        <i class="ri-message-3-line text-lg"></i><span class="font-medium">Messages</span>
                    </a>
                </li>
            </ul>

            <?php if ($isAdmin): ?>
            <p class="text-xs font-semibold text-gray-500 uppercase tracking-wider mb-2 px-3">Administration</p>
            <ul class="space-y-1 mb-4">
                <li>
                    <a href="index.php?action=admin_users" class="flex items-center space-x-3 px-3 py-2 rounded-lg <?= navClass($currentAction, 'admin_users') ?>">
                        <i class="ri-shield-user-line text-lg"></i><span class="font-medium">Manage Users</span>
                    </a>
                </li>
                <li>
                    <a href="index.php?action=admin_analytics" class="flex items-center space-x-3 px-3 py-2 rounded-lg <?= navClass($currentAction, 'admin_analytics') ?>">
                        <i class="ri-bar-chart-line text-lg"></i><span class="font-medium">Analytics</span>
                    </a>
                </li>
                <li>
                    <a href="index.php?action=admin_stories" class="flex items-center space-x-3 px-3 py-2 rounded-lg <?= navClass($currentAction, 'admin_stories') ?>">
                        <i class="ri-file-list-line text-lg"></i><span class="font-medium">Moderate Stories</span>
                    </a>
                </li>
                <li>
                    <a href="index.php?action=admin_newsletter" class="flex items-center space-x-3 px-3 py-2 rounded-lg <?= navClass($currentAction, 'admin_newsletter') ?>">
                        <i class="ri-mail-line text-lg"></i><span class="font-medium">Newsletter Subs</span>
                    </a>
                </li>
                <li>
                    <a href="index.php?action=admin_honor_cards" class="flex items-center space-x-3 px-3 py-2 rounded-lg <?= navClass($currentAction, 'admin_honor_cards') ?>">
                        <i class="ri-bank-card-line text-lg"></i><span class="font-medium">Honor Cards</span>
                    </a>
                </li>
                <li>
                    <a href="index.php?action=admin_mentor_applications" class="flex items-center space-x-3 px-3 py-2 rounded-lg <?= navClass($currentAction, 'admin_mentor_applications') ?>">
                        <i class="ri-user-star-line text-lg"></i><span class="font-medium">Mentor Approvals</span>
                    </a>
                </li>
                <li>
                    <a href="index.php?action=admin_export" class="flex items-center space-x-3 px-3 py-2 rounded-lg text-gray-700 hover:bg-gray-100">
                        <i class="ri-download-line text-lg"></i><span class="font-medium">Export CSV</span>
                    </a>
                </li>
            </ul>
            <?php endif; ?>

            <p class="text-xs font-semibold text-gray-500 uppercase tracking-wider mb-2 px-3">Account</p>
            <ul class="space-y-1">
                <li>
                    <a href="index.php?action=logout" class="flex items-center space-x-3 px-3 py-2 rounded-lg text-red-600 hover:bg-red-50">
                        <i class="ri-logout-box-line text-lg"></i><span class="font-medium">Logout</span>
                    </a>
                </li>
            </ul>
        </nav>
    </div>
</aside>

<div id="sidebarOverlay" class="fixed inset-0 bg-black bg-opacity-50 z-30 hidden lg:hidden"></div>

<script>
    const sidebar = document.getElementById('sidebar-area');
    const overlay = document.getElementById('sidebarOverlay');
    function openSidebar() { sidebar.classList.remove('-translate-x-full'); overlay.classList.remove('hidden'); }
    function closeSidebar() { sidebar.classList.add('-translate-x-full'); overlay.classList.add('hidden'); }
    document.getElementById('hide-sidebar-toggle')?.addEventListener('click', openSidebar);
    document.getElementById('hide-sidebar-toggle2')?.addEventListener('click', closeSidebar);
    overlay?.addEventListener('click', closeSidebar);
</script>
