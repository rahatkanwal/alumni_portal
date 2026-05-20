<?php $pageTitle = 'Mentorship'; ?>
<!DOCTYPE html>
<html lang="en">
<?php include __DIR__ . '/../shared/head.php'; ?>
<body class="bg-gray-50">
<?php include __DIR__ . '/../shared/sidebar.php'; ?>
<?php include __DIR__ . '/../shared/header.php'; ?>
<main class="lg:ml-64 pt-20 min-h-screen">
    <div class="p-6">
        <?php include __DIR__ . '/../shared/flash.php'; ?>
        <div class="flex items-center justify-between mb-6">
            <h1 class="text-2xl font-bold text-gray-800">Mentorship Program</h1>
            <a href="index.php?action=mentorship_requests" class="text-green-700 hover:underline"><i class="ri-mail-line"></i> My Requests</a>
        </div>

        <!-- Become a Mentor -->
        <div class="bg-gradient-to-r from-green-700 to-green-800 text-white rounded-lg p-6 mb-6">
            <h2 class="text-xl font-bold mb-2"><?= $myProfile ? 'Your Mentor Profile' : 'Become a Mentor' ?></h2>
            <p class="text-green-100 mb-4">Share your experience with the next generation of UAF graduates.</p>
            <?php if ($myProfile): ?>
                <?php
                $status = $myProfile['approval_status'] ?? 'pending';
                $statusClass = $status === 'approved' ? 'bg-green-100 text-green-800' : ($status === 'rejected' ? 'bg-red-100 text-red-800' : 'bg-yellow-100 text-yellow-800');
                ?>
                <div class="<?= $statusClass ?> rounded-lg px-4 py-3 mb-4 text-sm">
                    Application status: <span class="font-semibold"><?= e(ucfirst($status)) ?></span>
                    <?php if (!empty($myProfile['admin_notes'])): ?>
                        <span class="block mt-1">Admin notes: <?= e($myProfile['admin_notes']) ?></span>
                    <?php endif; ?>
                </div>
            <?php endif; ?>
            <form method="POST" action="index.php?action=mentorship_become" class="space-y-3">
                <input type="hidden" name="csrf_token" value="<?= csrf_token() ?>">
                <input name="expertise" placeholder="Your areas of expertise (e.g. Web Development, AI/ML, Agronomy)" required value="<?= e($myProfile['expertise'] ?? '') ?>" class="w-full px-4 py-2 rounded-lg text-gray-800">
                <input name="availability" placeholder="Availability (e.g. Weekends, 2hr/week)" value="<?= e($myProfile['availability'] ?? '') ?>" class="w-full px-4 py-2 rounded-lg text-gray-800">
                <textarea name="bio" placeholder="Brief mentor bio..." rows="2" class="w-full px-4 py-2 rounded-lg text-gray-800"><?= e($myProfile['bio'] ?? '') ?></textarea>
                <button class="bg-white text-green-700 px-4 py-2 rounded-lg font-medium hover:bg-green-50"><?= $myProfile ? 'Resubmit for Approval' : 'Apply as Mentor' ?></button>
            </form>
        </div>

        <!-- Mentor Directory -->
        <h2 class="text-xl font-bold text-gray-800 mb-4">Available Mentors</h2>
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-4">
            <?php foreach ($mentors as $m): if ($m['user_id'] == $_SESSION['user_id']) continue; ?>
                <div class="bg-white rounded-lg shadow-sm p-5">
                    <div class="flex items-center space-x-3 mb-3">
                        <?php $pic = !empty($m['profile_picture']) ? $m['profile_picture'] : 'assets/images/avatar-with-laptop.png'; ?>
                        <img src="<?= e($pic) ?>" class="w-12 h-12 rounded-full object-cover">
                        <div>
                            <p class="font-bold text-gray-800"><?= e($m['name']) ?></p>
                            <p class="text-xs text-gray-500"><?= e($m['current_job'] ?: 'Alumni') ?></p>
                        </div>
                    </div>
                    <p class="text-sm text-gray-600 mb-2"><span class="font-medium">Expertise:</span> <?= e($m['expertise']) ?></p>
                    <?php if ($m['availability']): ?>
                        <p class="text-sm text-gray-600 mb-2"><i class="ri-time-line"></i> <?= e($m['availability']) ?></p>
                    <?php endif; ?>
                    <button onclick="openModal(<?= $m['user_id'] ?>, '<?= e($m['name']) ?>')" class="w-full bg-green-700 text-white py-2 rounded-lg hover:bg-green-800 text-sm mt-3">Request Mentorship</button>
                </div>
            <?php endforeach; ?>
            <?php if (empty($mentors) || (count($mentors) === 1 && $mentors[0]['user_id'] == $_SESSION['user_id'])): ?>
                <div class="col-span-full text-center py-12 text-gray-500">
                    <i class="ri-graduation-cap-line text-5xl"></i>
                    <p class="mt-4">No mentors registered yet. Be the first!</p>
                </div>
            <?php endif; ?>
        </div>
    </div>
</main>

<!-- Request Modal -->
<div id="reqModal" class="hidden fixed inset-0 bg-black bg-opacity-50 z-50 flex items-center justify-center p-4">
    <div class="bg-white rounded-lg shadow-xl max-w-lg w-full p-6">
        <h3 class="text-lg font-bold mb-3">Request Mentorship from <span id="mentorName"></span></h3>
        <form method="POST" action="index.php?action=mentorship_request">
            <input type="hidden" name="csrf_token" value="<?= csrf_token() ?>">
            <input type="hidden" name="mentor_user_id" id="mentorIdField">
            <textarea name="message" rows="4" placeholder="Introduce yourself and what you'd like to learn..." class="w-full px-4 py-2 border rounded-lg mb-3" required></textarea>
            <div class="flex space-x-2">
                <button class="flex-1 bg-green-700 text-white py-2 rounded-lg hover:bg-green-800">Send Request</button>
                <button type="button" onclick="closeModal()" class="px-4 py-2 border rounded-lg hover:bg-gray-100">Cancel</button>
            </div>
        </form>
    </div>
</div>
<script>
function openModal(id, name) {
    document.getElementById('mentorIdField').value = id;
    document.getElementById('mentorName').textContent = name;
    document.getElementById('reqModal').classList.remove('hidden');
}
function closeModal() {
    document.getElementById('reqModal').classList.add('hidden');
}
</script>
</body>
</html>
