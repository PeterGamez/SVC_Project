<?php
$site['social'] = true; // กำหนดให้เว็บไซต์ใช้งาน Open Graph ได้
$site['cdn'] = array(); // กำหนดให้เว็บไซต์ใช้งาน CDN ที่กำหนดได้
$site['name'] = 'ติดต่อ - ' . config('site.name');
$site['desc'] = config('site.description');
$site['bot'] = '';
?>

<?= views('template/front/header') ?>

<body>
    <?= visitor_views('layouts/navbar') ?>
    <div class="body container">
        <div class="d-flex justify-content-center">
            <div class="card border-0" style="width: 70rem;" data-aos="fade-up">
                <div class="card-body">
                    <a href="https://facebook.com/whitelistseller" target="_blank">
                        <img src="https://cdn.discordapp.com/attachments/1040886801310699561/1134819739525464174/IN_-_4.png" class="d-block w-100" alt="image1">
                    </a>
                </div>
            </div>
        </div>
    </div>
    <?= views('template/front/footer') ?>
    <?= views('template/front/cdn_footer') ?>
</body>