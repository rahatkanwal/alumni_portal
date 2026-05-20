<?php
// Get errors
$errors = $errors ?? [];
?>
<!DOCTYPE html>
<html lang="en" dir="ltr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register - Alumni Portal - University of Agriculture Faisalabad</title>
    
    <!-- Tailwind CSS -->
    <script src="https://cdn.tailwindcss.com"></script>
    
    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800;900&display=swap" rel="stylesheet">
    
    <!-- Remix Icons -->
    <link href="https://cdn.jsdelivr.net/npm/remixicon@3.5.0/fonts/remixicon.css" rel="stylesheet">
    
    <style>
        :root {
            --primary-green: #1a5f3f;
            --primary-green-dark: #0f4a2f;
            --primary-green-light: #2d7a5a;
        }
        
        body {
            font-family: 'Inter', sans-serif;
        }
    </style>
</head>
<body class="bg-gray-50">
    <div class="min-h-screen flex items-center justify-center py-12 px-4 sm:px-6 lg:px-8">
        <div class="max-w-6xl w-full">
            <div class="grid grid-cols-1 lg:grid-cols-2 gap-8 items-center">
                
                <!-- Left: Image -->
                <div class="hidden lg:block">
                    <img src="assets/images/buildings/building1.png" alt="University Campus" class="rounded-lg shadow-lg w-full h-full object-cover">
                </div>
                
                <!-- Right: Register Form -->
                <div class="bg-white rounded-lg shadow-lg p-8 md:p-10">
                    <!-- Logo -->
                    <div class="flex items-center space-x-3 mb-6">
                        <div class="bg-green-700 p-2 rounded-lg">
                            <img src="../assets/logo.png" alt="UAF Logo" class="h-10 w-auto">
                        </div>
                        <div>
                            <h1 class="text-xl font-bold text-green-700">University of Agriculture</h1>
                            <p class="text-sm text-gray-600">Faisalabad</p>
                        </div>
                    </div>
                    
                    <div class="mb-6">
                        <h2 class="text-3xl font-bold text-gray-800 mb-2">
                            Create Your Account
                        </h2>
                        <p class="text-gray-600">
                            Join the alumni community
                        </p>
                    </div>

                    <?php if (isset($errors['general'])): ?>
                        <div class="mb-6 p-4 rounded-md bg-red-50 border border-red-200">
                            <p class="text-red-600 text-sm"><?= htmlspecialchars($errors['general']) ?></p>
                        </div>
                    <?php endif; ?>

                    <form method="POST" action="index.php?action=register" class="space-y-5">
                        <div>
                            <label for="name" class="block text-sm font-medium text-gray-700 mb-2">
                                Full Name <span class="text-red-500">*</span>
                            </label>
                            <input type="text" 
                                   name="name" 
                                   id="name"
                                   value="<?= htmlspecialchars($_POST['name'] ?? '') ?>" 
                                   class="w-full px-4 py-3 border <?= isset($errors['name']) ? 'border-red-500' : 'border-gray-300' ?> rounded-md focus:ring-2 focus:ring-green-500 focus:border-green-500 outline-none transition"
                                   placeholder="Enter your full name" 
                                   required>
                            <?php if (isset($errors['name'])): ?>
                                <p class="text-red-500 text-sm mt-1"><?= htmlspecialchars($errors['name']) ?></p>
                            <?php endif; ?>
                        </div>
                        
                        <div>
                            <label for="email" class="block text-sm font-medium text-gray-700 mb-2">
                                Email Address <span class="text-red-500">*</span>
                            </label>
                            <input type="email" 
                                   name="email" 
                                   id="email"
                                   value="<?= htmlspecialchars($_POST['email'] ?? '') ?>" 
                                   class="w-full px-4 py-3 border <?= isset($errors['email']) ? 'border-red-500' : 'border-gray-300' ?> rounded-md focus:ring-2 focus:ring-green-500 focus:border-green-500 outline-none transition"
                                   placeholder="example@university.edu" 
                                   required>
                            <?php if (isset($errors['email'])): ?>
                                <p class="text-red-500 text-sm mt-1"><?= htmlspecialchars($errors['email']) ?></p>
                            <?php endif; ?>
                        </div>
                        
                        <div class="grid grid-cols-1 sm:grid-cols-2 gap-5">
                            <div class="relative">
                                <label for="password" class="block text-sm font-medium text-gray-700 mb-2">
                                    Password <span class="text-red-500">*</span>
                                </label>
                                <input type="password" 
                                       name="password" 
                                       id="password"
                                       class="w-full px-4 py-3 border <?= isset($errors['password']) ? 'border-red-500' : 'border-gray-300' ?> rounded-md focus:ring-2 focus:ring-green-500 focus:border-green-500 outline-none transition"
                                       placeholder="Minimum 8 characters" 
                                       required>
                                <button type="button" 
                                        class="absolute right-3 top-11 text-gray-500 hover:text-gray-700 transition"
                                        onclick="togglePassword('password', 'toggleIcon1')">
                                    <i class="ri-eye-off-line" id="toggleIcon1"></i>
                                </button>
                                <?php if (isset($errors['password'])): ?>
                                    <p class="text-red-500 text-sm mt-1"><?= htmlspecialchars($errors['password']) ?></p>
                                <?php endif; ?>
                            </div>
                            
                            <div class="relative">
                                <label for="confirm_password" class="block text-sm font-medium text-gray-700 mb-2">
                                    Confirm Password <span class="text-red-500">*</span>
                                </label>
                                <input type="password" 
                                       name="confirm_password" 
                                       id="confirm_password"
                                       class="w-full px-4 py-3 border <?= isset($errors['confirm_password']) ? 'border-red-500' : 'border-gray-300' ?> rounded-md focus:ring-2 focus:ring-green-500 focus:border-green-500 outline-none transition"
                                       placeholder="Confirm your password" 
                                       required>
                                <button type="button" 
                                        class="absolute right-3 top-11 text-gray-500 hover:text-gray-700 transition"
                                        onclick="togglePassword('confirm_password', 'toggleIcon2')">
                                    <i class="ri-eye-off-line" id="toggleIcon2"></i>
                                </button>
                                <?php if (isset($errors['confirm_password'])): ?>
                                    <p class="text-red-500 text-sm mt-1"><?= htmlspecialchars($errors['confirm_password']) ?></p>
                                <?php endif; ?>
                            </div>
                        </div>
                        
                        <div class="grid grid-cols-1 sm:grid-cols-2 gap-5">
                            <div>
                                <label for="graduation_year" class="block text-sm font-medium text-gray-700 mb-2">
                                    Graduation Year
                                </label>
                                <input type="number" 
                                       name="graduation_year" 
                                       id="graduation_year"
                                       value="<?= htmlspecialchars($_POST['graduation_year'] ?? '') ?>" 
                                       class="w-full px-4 py-3 border border-gray-300 rounded-md focus:ring-2 focus:ring-green-500 focus:border-green-500 outline-none transition"
                                       placeholder="e.g., 2020" 
                                       min="1950" 
                                       max="2099">
                            </div>
                            
                            <div>
                                <label for="department" class="block text-sm font-medium text-gray-700 mb-2">
                                    Department
                                </label>
                                <input type="text" 
                                       name="department" 
                                       id="department"
                                       value="<?= htmlspecialchars($_POST['department'] ?? '') ?>" 
                                       class="w-full px-4 py-3 border border-gray-300 rounded-md focus:ring-2 focus:ring-green-500 focus:border-green-500 outline-none transition"
                                       placeholder="e.g., Computer Science">
                            </div>
                        </div>
                        
                        <div>
                            <button type="submit" class="w-full bg-green-700 text-white py-3 px-4 rounded-md hover:bg-green-800 transition font-medium flex items-center justify-center gap-2">
                                <i class="ri-user-add-line"></i>
                                Sign Up
                            </button>
                        </div>
                    </form>
                    
                    <p class="mt-6 text-center text-gray-600">
                        Already have an account? 
                        <a href="index.php?action=login" class="text-green-700 font-semibold hover:text-green-800 transition">
                            Sign In
                        </a>
                    </p>
                </div>
            </div>
        </div>
    </div>
    
    <script>
        function togglePassword(inputId, iconId) {
            const passwordInput = document.getElementById(inputId);
            const toggleIcon = document.getElementById(iconId);
            
            if (passwordInput.type === 'password') {
                passwordInput.type = 'text';
                toggleIcon.classList.remove('ri-eye-off-line');
                toggleIcon.classList.add('ri-eye-line');
            } else {
                passwordInput.type = 'password';
                toggleIcon.classList.remove('ri-eye-line');
                toggleIcon.classList.add('ri-eye-off-line');
            }
        }
    </script>
</body>
</html>
