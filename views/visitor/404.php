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
        <div class="row">
            <div class="col-12">
                <div class="d-flex justify-content-center">
                    <h1>Error 404</h1>
                </div>
            </div>
            <div class="col-12">
                <div class="d-flex justify-content-center">
                    <h3>Not Found</h3>
                </div>
            </div>
            <div class="col-12">
                <div class="d-flex justify-content-center">
                    <h5>ไม่พบหน้าที่คุณต้องการ</h5>
                </div>
            </div>
            <div class="col-12">
                <div class="row">
                    <div class="col-2"></div>
                    <div class="col-4">
                        <div class="d-flex justify-content-center">
                            <a href="/" class="btn btn-primary">กลับสู่หน้าหลัก</a>
                        </div>
                    </div>
                    <div class="col-4">
                        <div class="d-flex justify-content-center">
                            <div class="btn btn-primary" onclick="window.history.back()">ย้อนกลับ</div>
                        </div>
                    </div>
                    <div class="col-2"></div>
                </div>
            </div>
        </div>
    </div>
    <?= resource('cdn/front_foot.php') ?>
</body>

<?= visitor_views('layouts/footer') ?>