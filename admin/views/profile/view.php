<?php
require_once __DIR__ . '/../../includes/helpers.php';
$pageTitle = 'My Profile - Alumni Portal';
$profile = $profile ?? [];
$email = $_SESSION['email'] ?? '';
$completeness = calc_profile_completeness($profile);
if ($completeness === 100) award_badge_if_eligible($_SESSION['user_id'], 'Profile Complete');
?>
<!DOCTYPE html>
<html lang="en" dir="ltr">
<?php include __DIR__ . '/../shared/head.php'; ?>
<body class="bg-gray-50">
    <?php include __DIR__ . '/../shared/sidebar.php'; ?>
    <?php include __DIR__ . '/../shared/header.php'; ?>

    <!-- Main Content -->
    <main class="lg:ml-64 pt-20 min-h-screen">
        <div class="p-6">
            <!-- Breadcrumb -->
            <!-- Profile Completeness -->
            <div class="bg-white rounded-lg shadow-sm p-4 mb-6">
                <div class="flex items-center justify-between mb-2">
                    <span class="font-medium text-gray-700">Profile Completeness</span>
                    <span class="text-sm font-bold text-green-700"><?= $completeness ?>%</span>
                </div>
                <div class="w-full bg-gray-200 rounded-full h-2 overflow-hidden">
                    <div class="h-2 bg-gradient-to-r from-green-500 to-green-700 transition-all" style="width: <?= $completeness ?>%"></div>
                </div>
                <?php if ($completeness < 100): ?>
                    <p class="text-xs text-gray-500 mt-2">Complete your profile to unlock the <strong>Profile Complete</strong> badge. <a href="index.php?action=profile_edit" class="text-green-700 hover:underline">Edit profile →</a></p>
                <?php endif; ?>
            </div>

            <div class="mb-6 flex items-center justify-between">
                <h1 class="text-2xl font-bold text-gray-800">My Profile</h1>
                <nav class="flex items-center space-x-2 text-sm">
                    <a href="index.php?action=dashboard" class="text-gray-600 hover:text-green-700 transition flex items-center space-x-1">
                        <i class="ri-home-line"></i>
                        <span>Dashboard</span>
                    </a>
                    <span class="text-gray-400">/</span>
                    <span class="text-gray-800">My Profile</span>
                </nav>
            </div>

            <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
                <!-- Left Column -->
                <div class="lg:col-span-1 space-y-6">
                    <!-- Profile Intro -->
                    <div class="bg-white rounded-lg shadow-md p-6">
                        <h3 class="text-lg font-bold text-gray-800 mb-4">Profile Intro</h3>
                        <div class="flex items-center space-x-4 mb-4">
                            <?php 
                            $profilePic = !empty($profile['profile_picture']) ? 'assets/images/profiles/' . $profile['profile_picture'] : 'assets/images/admin.png';
                            ?>
                            <img src="<?= htmlspecialchars($profilePic) ?>" alt="Profile" class="w-20 h-20 rounded-full object-cover border-2 border-green-700">
                            <div>
                                <p class="font-bold text-gray-800"><?= htmlspecialchars($profile['name'] ?? 'N/A') ?></p>
                                <p class="text-sm text-gray-500"><?= htmlspecialchars(ucfirst($_SESSION['role'] ?? 'alumni')) ?></p>
                            </div>
                        </div>
                        <?php if (!empty($profile['bio'])): ?>
                        <div class="mb-4">
                            <p class="font-semibold text-gray-800 mb-2">About Me</p>
                            <p class="text-gray-600 text-sm"><?= nl2br(htmlspecialchars($profile['bio'])) ?></p>
                        </div>
                        <?php endif; ?>
                        <div>
                            <p class="font-semibold text-gray-800 mb-2">Social Profile</p>
                            <div class="flex space-x-2">
                                <a href="#" class="w-8 h-8 bg-blue-600 text-white rounded-full flex items-center justify-center hover:bg-blue-700 transition">
                                    <i class="ri-facebook-fill"></i>
                                </a>
                                <a href="#" class="w-8 h-8 bg-blue-400 text-white rounded-full flex items-center justify-center hover:bg-blue-500 transition">
                                    <i class="ri-twitter-x-fill"></i>
                                </a>
                                <a href="#" class="w-8 h-8 bg-blue-700 text-white rounded-full flex items-center justify-center hover:bg-blue-800 transition">
                                    <i class="ri-linkedin-fill"></i>
                                </a>
                                <a href="mailto:<?= htmlspecialchars($email) ?>" class="w-8 h-8 bg-green-600 text-white rounded-full flex items-center justify-center hover:bg-green-700 transition">
                                    <i class="ri-mail-fill"></i>
                                </a>
                            </div>
                        </div>
                    </div>

                    <!-- Profile Information -->
                    <div class="bg-white rounded-lg shadow-md p-6">
                        <h3 class="text-lg font-bold text-gray-800 mb-4">Profile Information</h3>
                        <ul class="space-y-3 text-sm">
                            <li class="flex justify-between">
                                <span class="text-gray-600">Email:</span>
                                <span class="font-medium text-gray-800"><?= htmlspecialchars($email ?: 'N/A') ?></span>
                            </li>
                            <li class="flex justify-between">
                                <span class="text-gray-600">Full Name:</span>
                                <span class="font-medium text-gray-800"><?= htmlspecialchars($profile['name'] ?? 'N/A') ?></span>
                            </li>
                            <li class="flex justify-between">
                                <span class="text-gray-600">Phone:</span>
                                <span class="font-medium text-gray-800"><?= htmlspecialchars($profile['phone'] ?? 'N/A') ?></span>
                            </li>
                            <li class="flex justify-between">
                                <span class="text-gray-600">Role:</span>
                                <span class="font-medium text-gray-800"><?= htmlspecialchars(ucfirst($_SESSION['role'] ?? 'alumni')) ?></span>
                            </li>
                            <li class="flex justify-between">
                                <span class="text-gray-600">Department:</span>
                                <span class="font-medium text-gray-800"><?= htmlspecialchars($profile['department'] ?? 'N/A') ?></span>
                            </li>
                            <li class="flex justify-between">
                                <span class="text-gray-600">Graduation Year:</span>
                                <span class="font-medium text-gray-800"><?= htmlspecialchars($profile['graduation_year'] ?? 'N/A') ?></span>
                            </li>
                        </ul>
                    </div>

                    <!-- Additional Information -->
                    <div class="bg-white rounded-lg shadow-md p-6">
                        <h3 class="text-lg font-bold text-gray-800 mb-4">Additional Information</h3>
                        <ul class="space-y-3 text-sm">
                            <li class="flex justify-between">
                                <span class="text-gray-600">Degree:</span>
                                <span class="font-medium text-gray-800"><?= htmlspecialchars($profile['degree'] ?? 'N/A') ?></span>
                            </li>
                            <li class="flex justify-between">
                                <span class="text-gray-600">Current Job:</span>
                                <span class="font-medium text-gray-800"><?= htmlspecialchars($profile['current_job'] ?? 'N/A') ?></span>
                            </li>
                            <li class="flex justify-between">
                                <span class="text-gray-600">Company:</span>
                                <span class="font-medium text-gray-800"><?= htmlspecialchars($profile['company'] ?? 'N/A') ?></span>
                            </li>
                            <li class="flex justify-between">
                                <span class="text-gray-600">Address:</span>
                                <span class="font-medium text-gray-800"><?= htmlspecialchars($profile['address'] ?? 'N/A') ?></span>
                            </li>
                            <?php if (!empty($profile['skills'])): ?>
                            <li class="flex justify-between">
                                <span class="text-gray-600">Skills:</span>
                                <span class="font-medium text-gray-800"><?= htmlspecialchars($profile['skills']) ?></span>
                            </li>
                            <?php endif; ?>
                            <?php if (!empty($profile['achievements'])): ?>
                            <li class="flex justify-between">
                                <span class="text-gray-600">Achievements:</span>
                                <span class="font-medium text-gray-800"><?= htmlspecialchars($profile['achievements']) ?></span>
                            </li>
                            <?php endif; ?>
                        </ul>
                        <div class="mt-6">
                            <a href="index.php?action=profile_edit" class="block w-full text-center bg-green-700 text-white px-4 py-2 rounded-lg hover:bg-green-800 transition font-medium">
                                Edit Profile
                            </a>
                        </div>
                    </div>
                </div>

                <!-- Right Column -->
                <div class="lg:col-span-2 space-y-6">
                    <!-- Welcome Card -->
                    <div class="bg-gradient-to-r from-green-700 to-green-800 rounded-lg p-8 text-white">
                        <h2 class="text-3xl font-bold mb-2">
                            Welcome Back, <span class="text-green-200"><?= htmlspecialchars($profile['name'] ?? 'Alumni') ?>!</span>
                        </h2>
                        <p class="text-green-100">
                            Manage your profile information and stay connected with the alumni community.
                        </p>
                    </div>

                    <!-- Summary Cards -->
                    <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                        <div class="bg-white rounded-lg shadow-md p-6 text-center">
                            <p class="text-gray-600 text-sm mb-2">Graduation Year</p>
                            <p class="text-2xl font-bold text-gray-800 mb-4"><?= htmlspecialchars($profile['graduation_year'] ?? 'N/A') ?></p>
                            <div class="flex justify-center">
                                <div class="bg-green-100 p-4 rounded-full">
                                    <i class="ri-graduation-cap-line text-3xl text-green-700"></i>
                                </div>
                            </div>
                        </div>

                        <div class="bg-white rounded-lg shadow-md p-6 text-center">
                            <p class="text-gray-600 text-sm mb-2">Department</p>
                            <p class="text-2xl font-bold text-gray-800 mb-4"><?= htmlspecialchars($profile['department'] ?? 'N/A') ?></p>
                            <div class="flex justify-center">
                                <div class="bg-blue-100 p-4 rounded-full">
                                    <i class="ri-building-line text-3xl text-blue-700"></i>
                                </div>
                            </div>
                        </div>

                        <div class="bg-white rounded-lg shadow-md p-6 text-center">
                            <p class="text-gray-600 text-sm mb-2">Current Job</p>
                            <p class="text-2xl font-bold text-gray-800 mb-4"><?= htmlspecialchars($profile['current_job'] ?? 'N/A') ?></p>
                            <div class="flex justify-center">
                                <div class="bg-orange-100 p-4 rounded-full">
                                    <i class="ri-briefcase-line text-3xl text-orange-700"></i>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </main>
    
    <?php include __DIR__ . '/../shared/scripts.php'; ?>
</body>
</html>
