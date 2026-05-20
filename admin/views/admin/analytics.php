<?php $pageTitle = 'Analytics'; ?>
<!DOCTYPE html>
<html lang="en">
<?php include __DIR__ . '/../shared/head.php'; ?>
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<body class="bg-gray-50">
<?php include __DIR__ . '/../shared/sidebar.php'; ?>
<?php include __DIR__ . '/../shared/header.php'; ?>
<main class="lg:ml-64 pt-20 min-h-screen">
    <div class="p-6">
        <h1 class="text-2xl font-bold mb-6">Analytics &amp; Insights</h1>

        <div class="grid grid-cols-2 md:grid-cols-4 gap-4 mb-6">
            <div class="bg-white p-5 rounded-lg shadow-sm">
                <p class="text-gray-500 text-sm">Total Alumni</p>
                <p class="text-3xl font-bold text-green-700"><?= $totalAlumni ?></p>
            </div>
            <div class="bg-white p-5 rounded-lg shadow-sm">
                <p class="text-gray-500 text-sm">Events</p>
                <p class="text-3xl font-bold text-purple-700"><?= $totalEvents ?></p>
            </div>
            <div class="bg-white p-5 rounded-lg shadow-sm">
                <p class="text-gray-500 text-sm">Open Jobs</p>
                <p class="text-3xl font-bold text-pink-700"><?= $totalJobs ?></p>
            </div>
            <div class="bg-white p-5 rounded-lg shadow-sm">
                <p class="text-gray-500 text-sm">Newsletter</p>
                <p class="text-3xl font-bold text-indigo-700"><?= $newsletterCount ?></p>
            </div>
        </div>

        <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">
            <div class="bg-white rounded-lg shadow-sm p-6">
                <h3 class="font-bold text-gray-800 mb-4">Alumni by Graduation Year</h3>
                <canvas id="yearChart" height="200"></canvas>
            </div>
            <div class="bg-white rounded-lg shadow-sm p-6">
                <h3 class="font-bold text-gray-800 mb-4">Alumni by Department</h3>
                <canvas id="deptChart" height="200"></canvas>
            </div>
        </div>
    </div>
</main>

<script>
const yearData = <?= json_encode($byYear) ?>;
const deptData = <?= json_encode($byDept) ?>;

new Chart(document.getElementById('yearChart'), {
    type: 'bar',
    data: {
        labels: yearData.map(d => d.graduation_year),
        datasets: [{
            label: 'Alumni',
            data: yearData.map(d => d.cnt),
            backgroundColor: '#1a5f3f'
        }]
    },
    options: { responsive: true, plugins: { legend: { display: false } } }
});

new Chart(document.getElementById('deptChart'), {
    type: 'doughnut',
    data: {
        labels: deptData.map(d => d.department),
        datasets: [{
            data: deptData.map(d => d.cnt),
            backgroundColor: ['#1a5f3f', '#2d7a5a', '#3b82f6', '#a855f7', '#ec4899', '#f59e0b', '#ef4444', '#10b981']
        }]
    },
    options: { responsive: true }
});
</script>
</body>
</html>
