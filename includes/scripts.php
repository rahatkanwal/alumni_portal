<?php
/**
 * Common Scripts Component
 * Include this file in pages that need the sidebar menu toggle functionality
 */
?>
<script>
    // Sidebar Menu Toggle
    const menuToggleBtn = document.getElementById('menuToggleBtn');
    const closeSidebarBtn = document.getElementById('closeSidebarBtn');
    const sidebarMenu = document.getElementById('sidebarMenu');
    const sidebarOverlay = document.getElementById('sidebarOverlay');
    const chaptersToggle = document.getElementById('chaptersToggle');
    const chaptersSubmenu = document.getElementById('chaptersSubmenu');

    // Open sidebar
    menuToggleBtn?.addEventListener('click', function() {
        sidebarMenu.classList.remove('translate-x-full');
        sidebarOverlay.classList.remove('hidden');
        document.body.style.overflow = 'hidden';
    });

    // Close sidebar
    function closeSidebar() {
        sidebarMenu.classList.add('translate-x-full');
        sidebarOverlay.classList.add('hidden');
        document.body.style.overflow = '';
    }

    closeSidebarBtn?.addEventListener('click', closeSidebar);
    sidebarOverlay?.addEventListener('click', closeSidebar);

    // Chapters submenu toggle
    chaptersToggle?.addEventListener('click', function() {
        chaptersSubmenu.classList.toggle('hidden');
        const icon = this.querySelector('i');
        if (chaptersSubmenu.classList.contains('hidden')) {
            icon.classList.remove('ri-subtract-line');
            icon.classList.add('ri-add-line');
        } else {
            icon.classList.remove('ri-add-line');
            icon.classList.add('ri-subtract-line');
        }
    });

    // Close sidebar on escape key
    document.addEventListener('keydown', function(e) {
        if (e.key === 'Escape' && !sidebarMenu.classList.contains('translate-x-full')) {
            closeSidebar();
        }
    });
</script>


