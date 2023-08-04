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
        <div class="d-flex justify-content-center">
            <div class="card border-0" style="width: 70rem;" data-aos="fade-up">
                <div class="card-body">
                    <img src="https://cdn.discordapp.com/attachments/1040886801310699561/1134819739525464174/IN_-_4.png" class="d-block w-100" alt="image1">
                </div>
            </div>
        </div>
    </div>
    <?= visitor_views('layouts/footer') ?>
    <?= resource('cdn/front_foot.php') ?>
</body>