<?php $pageTitle = 'Apply for Honor Card'; ?>
<!DOCTYPE html>
<html lang="en">
<?php include __DIR__ . '/../shared/head.php'; ?>
<body class="bg-gray-50">
<header class="bg-white border-b border-gray-200">
    <div class="max-w-6xl mx-auto px-4 py-4 flex items-center justify-between">
        <a href="../index.php" class="flex items-center gap-3">
            <img src="../assets/logo.png" alt="UAF Logo" class="h-12 w-auto bg-green-700 rounded px-3 py-2">
            <div>
                <p class="font-bold text-green-700 text-lg">University of Agriculture</p>
                <p class="text-sm text-gray-600">Faisalabad</p>
            </div>
        </a>
        <a href="../index.php" class="text-green-700 hover:underline font-medium">Back to Home</a>
    </div>
</header>

<main class="min-h-screen py-10">
    <div class="px-4 max-w-4xl mx-auto">
        <?php include __DIR__ . '/../shared/flash.php'; ?>

        <div class="bg-white rounded-lg shadow-sm p-6 mb-6">
            <div class="flex items-start justify-between gap-4 flex-wrap">
                <div>
                    <p class="text-sm text-green-700 font-semibold mb-1">Alumni Honor Card</p>
                    <h1 class="text-3xl font-bold text-gray-800">Apply for your card</h1>
                    <p class="text-gray-600 mt-2">Submit your delivery details for verification by the alumni office.</p>
                </div>
                <?php if ($application): ?>
                    <?php
                    $statusColors = [
                        'pending' => 'bg-yellow-100 text-yellow-700',
                        'approved' => 'bg-blue-100 text-blue-700',
                        'issued' => 'bg-green-100 text-green-700',
                        'rejected' => 'bg-red-100 text-red-700',
                    ];
                    ?>
                    <span class="px-3 py-1 rounded-full text-sm font-semibold <?= $statusColors[$application['status']] ?? 'bg-gray-100 text-gray-700' ?>">
                        <?= e(ucfirst($application['status'])) ?>
                    </span>
                <?php endif; ?>
            </div>
        </div>

        <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
            <div class="lg:col-span-2 bg-white rounded-lg shadow-sm p-6">
                <form method="POST" action="index.php?action=honor_card_submit" class="space-y-4">
                    <input type="hidden" name="csrf_token" value="<?= csrf_token() ?>">

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-1">Full Name <span class="text-red-500">*</span></label>
                            <input type="text" name="applicant_name" value="<?= e($profile['name'] ?? $_SESSION['name'] ?? '') ?>" required class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-green-500 focus:border-green-500 outline-none">
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-1">Email <span class="text-red-500">*</span></label>
                            <input type="email" name="applicant_email" value="<?= e($profile['email'] ?? '') ?>" required class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-green-500 focus:border-green-500 outline-none">
                        </div>
                    </div>

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-1">Department</label>
                            <input type="text" name="department" value="<?= e($profile['department'] ?? '') ?>" class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-green-500 focus:border-green-500 outline-none">
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-1">Graduation Year</label>
                            <input type="number" name="graduation_year" min="1900" max="2100" value="<?= e($profile['graduation_year'] ?? '') ?>" class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-green-500 focus:border-green-500 outline-none">
                        </div>
                    </div>

                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">Phone</label>
                        <input type="text" name="phone" value="<?= e($application['phone'] ?? $profile['phone'] ?? '') ?>" class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-green-500 focus:border-green-500 outline-none">
                    </div>

                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">Delivery Address <span class="text-red-500">*</span></label>
                        <textarea name="delivery_address" rows="4" required class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-green-500 focus:border-green-500 outline-none"><?= e($application['delivery_address'] ?? $profile['address'] ?? '') ?></textarea>
                    </div>

                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">Notes</label>
                        <textarea name="notes" rows="3" class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-green-500 focus:border-green-500 outline-none" placeholder="Any extra details for the alumni office"><?= e($application['notes'] ?? '') ?></textarea>
                    </div>

                    <button class="bg-green-700 text-white px-6 py-3 rounded-lg hover:bg-green-800 font-medium">
                        <?= $application ? 'Update Application' : 'Submit Application' ?>
                    </button>
                </form>
            </div>

            <div class="bg-white rounded-lg shadow-sm p-6 h-fit">
                <h2 class="font-bold text-gray-800 mb-3">Application Status</h2>
                <?php if ($application): ?>
                    <div class="space-y-3 text-sm text-gray-600">
                        <p><span class="font-medium text-gray-800">Applied:</span> <?= date('M d, Y', strtotime($application['applied_at'])) ?></p>
                        <p><span class="font-medium text-gray-800">Status:</span> <?= e(ucfirst($application['status'])) ?></p>
                        <?php if (!empty($application['admin_notes'])): ?>
                            <p><span class="font-medium text-gray-800">Admin Notes:</span><br><?= e($application['admin_notes']) ?></p>
                        <?php endif; ?>
                    </div>
                <?php else: ?>
                    <p class="text-sm text-gray-600">No application submitted yet.</p>
                <?php endif; ?>
            </div>
        </div>
    </div>
</main>
</body>
</html>
