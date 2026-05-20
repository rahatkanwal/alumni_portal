<?php $pageTitle = 'Alumni Map'; ?>
<!DOCTYPE html>
<html lang="en">
<?php include __DIR__ . '/../shared/head.php'; ?>
<link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.4/dist/leaflet.css" crossorigin="" />
<link rel="stylesheet" href="https://unpkg.com/leaflet.markercluster@1.5.3/dist/MarkerCluster.css" />
<link rel="stylesheet" href="https://unpkg.com/leaflet.markercluster@1.5.3/dist/MarkerCluster.Default.css" />
<script src="https://unpkg.com/leaflet@1.9.4/dist/leaflet.js" crossorigin=""></script>
<script src="https://unpkg.com/leaflet.markercluster@1.5.3/dist/leaflet.markercluster.js"></script>
<style>
    #map { height: 70vh; border-radius: 12px; }
    .marker-cluster-small { background-color: rgba(26,95,63,0.6); }
    .marker-cluster-small div { background-color: rgba(26,95,63,0.85); color: white; }
    .marker-cluster-medium { background-color: rgba(45,122,90,0.6); }
    .marker-cluster-medium div { background-color: rgba(45,122,90,0.85); color: white; }
    .marker-cluster-large { background-color: rgba(15,74,47,0.6); }
    .marker-cluster-large div { background-color: rgba(15,74,47,0.85); color: white; }
</style>
<?php
require_once __DIR__ . '/../../models/Alumni.php';
$alumniModel = new Alumni();
$geocoded = $alumniModel->getGeocoded();
$needsGeocoding = $alumniModel->getNeedsGeocoding();
?>
<body class="bg-gray-50">
<?php include __DIR__ . '/../shared/sidebar.php'; ?>
<?php include __DIR__ . '/../shared/header.php'; ?>
<main class="lg:ml-64 pt-20 min-h-screen">
    <div class="p-6">
        <div class="flex items-center justify-between mb-2 flex-wrap gap-2">
            <h1 class="text-2xl font-bold text-gray-800">Alumni Worldwide</h1>
            <div class="flex items-center gap-3 text-sm">
                <span class="inline-flex items-center gap-1 bg-green-100 text-green-700 px-3 py-1 rounded-full">
                    <i class="ri-map-pin-line"></i> <?= count($geocoded) ?> mapped
                </span>
                <?php if (!empty($needsGeocoding)): ?>
                    <span class="inline-flex items-center gap-1 bg-yellow-100 text-yellow-700 px-3 py-1 rounded-full">
                        <i class="ri-time-line"></i> <?= count($needsGeocoding) ?> awaiting geocode
                    </span>
                <?php endif; ?>
            </div>
        </div>
        <p class="text-gray-500 mb-6">Real locations geocoded from each alumni's address via OpenStreetMap. Markers cluster automatically — zoom in for individual pins.</p>

        <div class="bg-white rounded-lg shadow-sm p-4">
            <div id="map"></div>
        </div>

        <?php if (empty($geocoded)): ?>
            <div class="mt-6 bg-yellow-50 border border-yellow-200 rounded-lg p-4">
                <p class="text-yellow-800"><i class="ri-information-line"></i> No alumni locations on the map yet. Alumni will appear as they update their address in their profile.</p>
            </div>
        <?php endif; ?>

        <?php if (($_SESSION['role'] ?? '') === 'admin' && !empty($needsGeocoding)): ?>
            <div class="mt-6 bg-blue-50 border border-blue-200 rounded-lg p-4 flex items-center justify-between flex-wrap gap-2">
                <div>
                    <p class="font-medium text-blue-900"><?= count($needsGeocoding) ?> alumni have addresses that haven't been geocoded yet</p>
                    <p class="text-sm text-blue-700">Use the batch tool to convert them all at once (1 sec/address per Nominatim policy).</p>
                </div>
                <a href="index.php?action=admin_geocode_batch" class="bg-blue-600 text-white px-4 py-2 rounded-lg hover:bg-blue-700 text-sm">
                    <i class="ri-refresh-line"></i> Run Batch Geocode
                </a>
            </div>
        <?php endif; ?>
    </div>
</main>

<script>
const alumniData = <?= json_encode(array_map(function($a) {
    return [
        'id' => (int)$a['user_id'],
        'name' => $a['name'],
        'address' => $a['address'] ?: $a['geocoded_address'],
        'job' => $a['current_job'] ?: '',
        'company' => $a['company'] ?: '',
        'year' => $a['graduation_year'] ?: '',
        'department' => $a['department'] ?: '',
        'lat' => (float)$a['latitude'],
        'lng' => (float)$a['longitude'],
        'pic' => $a['profile_picture'] ?: 'assets/images/avatar-with-laptop.png',
    ];
}, $geocoded)) ?>;

// Initialize map centered on a reasonable default (Pakistan, where UAF is)
const map = L.map('map').setView([31.42, 73.07], 4);

L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
    attribution: '&copy; <a href="https://www.openstreetmap.org/copyright">OpenStreetMap</a> contributors',
    maxZoom: 18,
}).addTo(map);

// Custom green pin icon
const greenIcon = L.divIcon({
    html: '<div style="background:#1a5f3f;width:28px;height:28px;border-radius:50% 50% 50% 0;transform:rotate(-45deg);border:2px solid white;box-shadow:0 2px 4px rgba(0,0,0,0.3);display:flex;align-items:center;justify-content:center;"><i class="ri-graduation-cap-line" style="color:white;transform:rotate(45deg);font-size:14px;"></i></div>',
    className: '',
    iconSize: [28, 28],
    iconAnchor: [14, 28],
    popupAnchor: [0, -28],
});

// Use marker cluster group for performance with many alumni
const cluster = L.markerClusterGroup({
    showCoverageOnHover: false,
    maxClusterRadius: 50,
});

if (alumniData.length > 0) {
    const bounds = [];
    alumniData.forEach(a => {
        const popup = `
            <div style="min-width:200px;font-family:Inter,sans-serif;">
                <strong style="font-size:14px;color:#1a5f3f">${a.name}</strong>
                ${a.job ? `<div style="font-size:12px;color:#555;margin-top:4px"><i class="ri-briefcase-line"></i> ${a.job}${a.company ? ' @ ' + a.company : ''}</div>` : ''}
                ${a.department ? `<div style="font-size:12px;color:#555"><i class="ri-graduation-cap-line"></i> ${a.department}${a.year ? ' · Class of ' + a.year : ''}</div>` : ''}
                ${a.address ? `<div style="font-size:11px;color:#888;margin-top:4px"><i class="ri-map-pin-line"></i> ${a.address}</div>` : ''}
                <a href="index.php?action=directory_profile&id=${a.id}" style="display:inline-block;margin-top:8px;color:#1a5f3f;font-weight:600;font-size:12px">View Profile →</a>
            </div>`;
        const marker = L.marker([a.lat, a.lng], { icon: greenIcon }).bindPopup(popup);
        cluster.addLayer(marker);
        bounds.push([a.lat, a.lng]);
    });
    map.addLayer(cluster);
    // Fit map to all markers
    if (bounds.length > 1) map.fitBounds(bounds, { padding: [40, 40] });
    else map.setView(bounds[0], 10);
}
</script>
</body>
</html>
