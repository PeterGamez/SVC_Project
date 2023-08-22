<?php

use App\Class\Alert;
use App\Models\Whitelist;

$result = Whitelist::find($request)->getOne();
if (!$result) {
    Alert::alert('ไม่พบข้อมูล', 'error', 1500, 'window.location.href = "' . url('blacklist') . '"');
    exit;
}

$site['social'] = true; // กำหนดให้เว็บไซต์ใช้งาน Open Graph ได้
$site['cdn'] = array('tawk'); // กำหนดให้เว็บไซต์ใช้งาน CDN ที่กำหนดได้
$site['name'] = 'Whitelist ' . $result['tag'] . ' - ' . config('site.name');
if ($result['description']) {
    $site['desc'] =  $result['description'] . ' | ร้านค้าของ ' . $result['id_firstname'] . ' ' . $result['id_lastname'] . ' | ' . config('site.name');
} else {
    $site['desc'] = 'ร้านค้าของ ' . $result['id_firstname'] . ' ' . $result['id_lastname'] . ' | ' . config('site.name');
}
$site['bot'] = '';
?>

<?= views('template/front/header') ?>

<body>
    <?= visitor_views('layouts/navbar') ?>
    <div class="body container">
        <div class="d-flex justify-content-center">
            <div class="card mb-4 shadow" style="width:50rem;">
                <div class="card-body">
                    <div class="mb-3 modal-header justify-content-between">
                        <span></span>
                        <h5 class="modal-title">รายละเอียดกิจการ</h5>
                        <a href="<?= url_back() ?>" class="btn btn-close"></a>
                    </div>
                    <div class="modal-body">
                        <div class="mb-3 d-flex justify-content-center">
                            <img src="<?= $result['banner'] ?>" class="img-fluid rounded d-block" alt="<?= $result['name'] ?>" style="height: 200px;">
                        </div>
                        <div class="mb-3">
                            <label>ชื่อกิจการ</label>
                            <input type="text" class="form-control" value="<?= $result['name'] ?>" disabled>
                        </div>
                        <div class="mb-3">
                            <label>คำอธิบายกิจการ</label>
                            <textarea class="form-control" rows="3" disabled><?= $result['description'] ?></textarea>
                        </div>
                        <div class="mb-3">
                            <label>เว็บไซต์</label>
                            <a href="<?= $result['website'] ?>" class="form-control" target="_blank"><?= $result['website'] ?></a>
                        </div>
                        <div class="row">
                            <div class="col">
                                <div class="mb-3">
                                    <label>ชื่อเจ้าของกิจการ</label>
                                    <input type="text" class="form-control" value="<?= $result['id_firstname'] ?>" disabled>
                                </div>
                            </div>
                            <div class="col">
                                <div class="mb-3">
                                    <label>นามสกุลเจ้าของกิจการ</label>
                                    <input type="text" class="form-control" value="<?= $result['id_lastname'] ?>" disabled>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <?= views('template/front/footer') ?>
    <?= views('template/front/cdn_footer') ?>
</body>