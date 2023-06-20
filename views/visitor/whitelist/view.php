<?php
$site['social'] = true; // กำหนดให้เว็บไซต์ใช้งาน Open Graph ได้
$site['cdn'] = array(); // กำหนดให้เว็บไซต์ใช้งาน CDN ที่กำหนดได้
$site['name'] = config('site.name');
$site['desc'] = config('site.description');
$site['bot'] = '';
?>

<?= visitor_views('layouts/header') ?>

<body>
    <?= visitor_views('layouts/navbar') ?>
    <div class="body container">
        whitelist view <?= $request['id'] ?>
    </div>
</body>

<?= visitor_views('layouts/footer') ?>