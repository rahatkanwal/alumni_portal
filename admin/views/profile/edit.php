<?php
$pageTitle = 'Edit Profile - Alumni Portal';
$profile = $profile ?? [];
$errors = $errors ?? [];
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
            <div class="mb-6 flex items-center justify-between">
                <h1 class="text-2xl font-bold text-gray-800">Edit Profile</h1>
                <nav class="flex items-center space-x-2 text-sm">
                    <a href="index.php?action=dashboard" class="text-gray-600 hover:text-green-700 transition flex items-center space-x-1">
                        <i class="ri-home-line"></i>
                        <span>Dashboard</span>
                    </a>
                    <span class="text-gray-400">/</span>
                    <a href="index.php?action=profile" class="text-gray-600 hover:text-green-700 transition">My Profile</a>
                    <span class="text-gray-400">/</span>
                    <span class="text-gray-800">Edit Profile</span>
                </nav>
            </div>

            <!-- Edit Profile Form -->
            <div class="bg-white rounded-lg shadow-md p-6">
                <h2 class="text-xl font-bold text-gray-800 mb-6">Edit Profile Information</h2>
                
                <?php if (isset($errors['general'])): ?>
                    <div class="mb-6 p-4 bg-red-50 border border-red-200 text-red-600 rounded-lg">
                        <?= htmlspecialchars($errors['general']) ?>
                    </div>
                <?php endif; ?>

                <form method="POST" action="index.php?action=profile_update" enctype="multipart/form-data" class="space-y-6">
                    <!-- Profile Picture -->
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">Profile Picture</label>
                        <?php if (!empty($profile['profile_picture'])): ?>
                            <div class="mb-4">
                                <img src="assets/images/profiles/<?= htmlspecialchars($profile['profile_picture']) ?>" 
                                     alt="Current" 
                                     class="w-24 h-24 rounded-full object-cover border-2 border-green-700">
                            </div>
                        <?php endif; ?>
                        <input type="file" 
                               name="profile_picture" 
                               accept="image/jpeg,image/jpg,image/png,image/gif" 
                               class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-green-500 focus:border-green-500 outline-none">
                        <?php if (isset($errors['profile_picture'])): ?>
                            <p class="text-red-500 text-sm mt-1"><?= htmlspecialchars($errors['profile_picture']) ?></p>
                        <?php endif; ?>
                    </div>

                    <!-- Basic Information -->
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-2">
                                Name <span class="text-red-500">*</span>
                            </label>
                            <input type="text" 
                                   name="name" 
                                   value="<?= htmlspecialchars($profile['name'] ?? '') ?>" 
                                   required
                                   class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-green-500 focus:border-green-500 outline-none">
                            <?php if (isset($errors['name'])): ?>
                                <p class="text-red-500 text-sm mt-1"><?= htmlspecialchars($errors['name']) ?></p>
                            <?php endif; ?>
                        </div>
                        
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-2">Phone</label>
                            <input type="text" 
                                   name="phone" 
                                   value="<?= htmlspecialchars($profile['phone'] ?? '') ?>"
                                   class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-green-500 focus:border-green-500 outline-none">
                        </div>
                        
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-2">Graduation Year</label>
                            <input type="number" 
                                   name="graduation_year" 
                                   value="<?= htmlspecialchars($profile['graduation_year'] ?? '') ?>"
                                   min="1950" 
                                   max="2099"
                                   class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-green-500 focus:border-green-500 outline-none">
                        </div>
                        
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-2">Department</label>
                            <input type="text" 
                                   name="department" 
                                   value="<?= htmlspecialchars($profile['department'] ?? '') ?>"
                                   class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-green-500 focus:border-green-500 outline-none">
                        </div>
                        
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-2">Degree</label>
                            <input type="text" 
                                   name="degree" 
                                   value="<?= htmlspecialchars($profile['degree'] ?? '') ?>"
                                   class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-green-500 focus:border-green-500 outline-none">
                        </div>
                        
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-2">Current Job</label>
                            <input type="text" 
                                   name="current_job" 
                                   value="<?= htmlspecialchars($profile['current_job'] ?? '') ?>"
                                   class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-green-500 focus:border-green-500 outline-none">
                        </div>
                        
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-2">Company</label>
                            <input type="text" 
                                   name="company" 
                                   value="<?= htmlspecialchars($profile['company'] ?? '') ?>"
                                   class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-green-500 focus:border-green-500 outline-none">
                        </div>
                    </div>

                    <!-- Address -->
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">Address</label>
                        <textarea name="address" 
                                  rows="3" 
                                  class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-green-500 focus:border-green-500 outline-none"><?= htmlspecialchars($profile['address'] ?? '') ?></textarea>
                    </div>

                    <!-- Bio -->
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">Bio</label>
                        <textarea name="bio" 
                                  rows="4" 
                                  class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-green-500 focus:border-green-500 outline-none"><?= htmlspecialchars($profile['bio'] ?? '') ?></textarea>
                    </div>

                    <!-- Achievements -->
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">Achievements</label>
                        <textarea name="achievements" 
                                  rows="3" 
                                  class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-green-500 focus:border-green-500 outline-none"><?= htmlspecialchars($profile['achievements'] ?? '') ?></textarea>
                    </div>

                    <!-- Skills -->
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">Skills</label>
                        <textarea name="skills" 
                                  rows="3" 
                                  class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-green-500 focus:border-green-500 outline-none"><?= htmlspecialchars($profile['skills'] ?? '') ?></textarea>
                    </div>

                    <!-- Form Actions -->
                    <div class="flex items-center space-x-4 pt-4">
                        <button type="submit" class="bg-green-700 text-white px-6 py-2 rounded-lg hover:bg-green-800 transition font-medium flex items-center space-x-2">
                            <i class="ri-save-line"></i>
                            <span>Save Changes</span>
                        </button>
                        <a href="index.php?action=profile" class="bg-gray-500 text-white px-6 py-2 rounded-lg hover:bg-gray-600 transition font-medium">
                            Cancel
                        </a>
                    </div>
                </form>
            </div>
        </div>
    </main>
    
    <?php include __DIR__ . '/../shared/scripts.php'; ?>
</body>
</html>
