<?php

use App\Models\Whitelist;

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
        <div class="card" style="width: 100%;">
            <div class="card-body">
                <div class="row">
                    <div class="col">
                        <div class="mb-3">
                            <label for="bank" class="form-label">เลขที่บัญชี</label>
                            <input type="email" class="form-control" id="bank">
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <?= resource('cdn/front_foot.php') ?>
</body>

<?= visitor_views('layouts/footer') ?>