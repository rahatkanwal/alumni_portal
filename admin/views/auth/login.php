<?php
// Get errors and messages
$errors = $errors ?? [];
$error_message = $_SESSION['error_message'] ?? '';
$success_message = $_SESSION['success_message'] ?? '';
unset($_SESSION['error_message'], $_SESSION['success_message']);
?>
<!DOCTYPE html>
<html lang="en" dir="ltr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - Alumni Portal - University of Agriculture Faisalabad</title>
    
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
                
                <!-- Right: Login Form -->
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
                            Welcome Back!
                        </h2>
                        <p class="text-gray-600">
                            Sign in to your alumni account
                        </p>
                    </div>

                    <?php if ($error_message || isset($errors['general'])): ?>
                        <div class="mb-6 p-4 rounded-md bg-red-50 border border-red-200">
                            <p class="text-red-600 text-sm"><?= htmlspecialchars($error_message ?: $errors['general']) ?></p>
                        </div>
                    <?php endif; ?>

                    <?php if ($success_message): ?>
                        <div class="mb-6 p-4 rounded-md bg-green-50 border border-green-200">
                            <p class="text-green-600 text-sm"><?= htmlspecialchars($success_message) ?></p>
                        </div>
                    <?php endif; ?>

                    <form method="POST" action="index.php?action=login" class="space-y-6">
                        <div>
                            <label for="email" class="block text-sm font-medium text-gray-700 mb-2">
                                Email Address
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
                        
                        <div class="relative">
                            <label for="password" class="block text-sm font-medium text-gray-700 mb-2">
                                Password
                            </label>
                            <input type="password" 
                                   name="password" 
                                   id="password"
                                   class="w-full px-4 py-3 border <?= isset($errors['password']) ? 'border-red-500' : 'border-gray-300' ?> rounded-md focus:ring-2 focus:ring-green-500 focus:border-green-500 outline-none transition"
                                   placeholder="Enter your password" 
                                   required>
                            <button type="button" 
                                    class="absolute right-3 top-11 text-gray-500 hover:text-gray-700 transition"
                                    onclick="togglePassword()">
                                <i class="ri-eye-off-line" id="toggleIcon"></i>
                            </button>
                            <?php if (isset($errors['password'])): ?>
                                <p class="text-red-500 text-sm mt-1"><?= htmlspecialchars($errors['password']) ?></p>
                            <?php endif; ?>
                        </div>
                        
                        <div>
                            <button type="submit" class="w-full bg-green-700 text-white py-3 px-4 rounded-md hover:bg-green-800 transition font-medium flex items-center justify-center gap-2">
                                <i class="ri-login-box-line"></i>
                                Sign In
                            </button>
                        </div>
                    </form>
                    
                    <p class="mt-6 text-center text-gray-600">
                        Don't have an account? 
                        <a href="index.php?action=register" class="text-green-700 font-semibold hover:text-green-800 transition">
                            Sign Up
                        </a>
                    </p>
                </div>
            </div>
        </div>
    </div>
    
    <script>
        function togglePassword() {
            const passwordInput = document.getElementById('password');
            const toggleIcon = document.getElementById('toggleIcon');
            
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
