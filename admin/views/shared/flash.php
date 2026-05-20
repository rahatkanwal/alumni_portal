<?php
$success = flash('success');
$error = flash('error');
?>
<?php if ($success): ?>
    <div class="mb-4 bg-green-50 border border-green-200 text-green-800 px-4 py-3 rounded-lg flex items-center space-x-2">
        <i class="ri-checkbox-circle-line text-xl"></i>
        <span><?= e($success) ?></span>
    </div>
<?php endif; ?>
<?php if ($error): ?>
    <div class="mb-4 bg-red-50 border border-red-200 text-red-800 px-4 py-3 rounded-lg flex items-center space-x-2">
        <i class="ri-error-warning-line text-xl"></i>
        <span><?= e($error) ?></span>
    </div>
<?php endif; ?>
