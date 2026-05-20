<?php
$partnerName = $partner['name'] ?? 'User';
$partnerPic = !empty($partner['profile_picture']) ? $partner['profile_picture'] : 'assets/images/avatar-with-laptop.png';
$partnerSub = $partner['current_job'] ?? ucfirst($partner['role'] ?? '');
$pageTitle = 'Chat with ' . $partnerName;
?>
<!DOCTYPE html>
<html lang="en">
<?php include __DIR__ . '/../shared/head.php'; ?>
<body class="bg-gray-50">
<?php include __DIR__ . '/../shared/sidebar.php'; ?>
<?php include __DIR__ . '/../shared/header.php'; ?>
<main class="lg:ml-64 pt-20 min-h-screen">
    <div class="p-6 max-w-3xl mx-auto">
        <?php include __DIR__ . '/../shared/flash.php'; ?>
        <a href="index.php?action=messages" class="text-green-700 hover:underline mb-4 inline-flex items-center"><i class="ri-arrow-left-line"></i> Inbox</a>

        <div class="bg-white rounded-lg shadow-sm flex flex-col" style="height: 70vh;">
            <!-- Partner header -->
            <div class="p-4 border-b flex items-center space-x-3 flex-shrink-0">
                <img src="<?= e($partnerPic) ?>" class="w-10 h-10 rounded-full object-cover" alt="">
                <div class="flex-1">
                    <p class="font-bold"><?= e($partnerName) ?></p>
                    <?php if ($partnerSub): ?>
                        <p class="text-xs text-gray-500"><?= e($partnerSub) ?></p>
                    <?php endif; ?>
                </div>
                <?php if (($partner['role'] ?? '') === 'admin'): ?>
                    <span class="text-xs bg-blue-100 text-blue-700 px-2 py-1 rounded-full"><i class="ri-shield-user-line"></i> Admin</span>
                <?php endif; ?>
            </div>

            <!-- Messages -->
            <div id="chatBox" class="p-4 space-y-3 overflow-y-auto flex-1">
                <?php foreach ($messages as $m): $me = ($m['sender_id'] == $_SESSION['user_id']); ?>
                    <div class="flex <?= $me ? 'justify-end' : 'justify-start' ?>">
                        <div class="max-w-xs md:max-w-md px-4 py-2 rounded-lg <?= $me ? 'bg-green-700 text-white' : 'bg-gray-100 text-gray-800' ?>">
                            <p class="whitespace-pre-wrap break-words"><?= e($m['body']) ?></p>
                            <p class="text-xs opacity-75 mt-1 <?= $me ? '' : 'text-gray-500' ?>"><?= date('M d, g:i A', strtotime($m['created_at'])) ?></p>
                        </div>
                    </div>
                <?php endforeach; ?>
                <?php if (empty($messages)): ?>
                    <div class="text-center text-gray-400 text-sm py-12">
                        <i class="ri-chat-3-line text-5xl text-gray-300"></i>
                        <p class="mt-3">No messages yet. Say hi to <?= e($partnerName) ?>!</p>
                    </div>
                <?php endif; ?>
            </div>

            <!-- Composer -->
            <form id="chatForm" method="POST" action="index.php?action=message_send" class="p-4 border-t flex space-x-2 flex-shrink-0">
                <input type="hidden" name="csrf_token" value="<?= csrf_token() ?>">
                <input type="hidden" name="receiver_id" value="<?= e($partner['user_id']) ?>">
                <textarea id="msgInput" name="body" required placeholder="Type a message... (Enter to send · Shift+Enter for new line)"
                          rows="1"
                          class="flex-1 px-4 py-2 border rounded-lg focus:ring-2 focus:ring-green-500 resize-none max-h-32"
                          autofocus></textarea>
                <button type="submit" class="bg-green-700 text-white px-4 py-2 rounded-lg hover:bg-green-800 flex-shrink-0">
                    <i class="ri-send-plane-fill"></i>
                </button>
            </form>
        </div>
    </div>
</main>
<script>
(function() {
    const box = document.getElementById('chatBox');
    const form = document.getElementById('chatForm');
    const input = document.getElementById('msgInput');

    // Auto-scroll to bottom on load
    if (box) box.scrollTop = box.scrollHeight;

    // Enter to send, Shift+Enter for newline
    input.addEventListener('keydown', function(e) {
        if (e.key === 'Enter' && !e.shiftKey) {
            e.preventDefault();
            if (input.value.trim() !== '') {
                form.submit();
            }
        }
    });

    // Auto-grow textarea
    input.addEventListener('input', function() {
        input.style.height = 'auto';
        input.style.height = Math.min(input.scrollHeight, 128) + 'px';
    });
})();
</script>
</body>
</html>
