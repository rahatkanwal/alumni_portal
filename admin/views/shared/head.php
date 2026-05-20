<head>
        <!-- Required meta tags -->
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">

        <!-- Tailwind CSS -->
        <script src="https://cdn.tailwindcss.com"></script>
        
        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.googleapis.com">
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
        <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800;900&display=swap" rel="stylesheet">
        
        <!-- Remix Icons -->
        <link href="https://cdn.jsdelivr.net/npm/remixicon@3.5.0/fonts/remixicon.css" rel="stylesheet">

        <!-- Favicon -->
		<link rel="icon" type="image/png" href="assets/images/favicon.ico">

        <!-- Title -->
        <title><?= isset($pageTitle) ? htmlspecialchars($pageTitle) : 'Alumni Portal - Dashboard' ?></title>
        
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
