<?php

use App\Class\Alert;
use App\Models\Blacklist;
use App\Models\BlacklistImage;

$result = Blacklist::find()
    ->select(
        'blacklist.*',
        'blacklist_category.name as blacklist_category',
        'bank.name as bank_name',
    )
    ->join('blacklist_category', 'id', 'blacklist_category_id')
    ->join('approve', 'id', 'approve_id')
    ->join('bank', 'id', 'bank_id')
    ->where('blacklist.id', $request['id'])
    ->getOne();

if (!$result) {
    Alert::alert('ไม่พบข้อมูล', 'error', 1500, 'window.location.href = "' . url('blacklist') . '"');
    exit;
}

$site['social'] = true; // กำหนดให้เว็บไซต์ใช้งาน Open Graph ได้
$site['cdn'] = array(); // กำหนดให้เว็บไซต์ใช้งาน CDN ที่กำหนดได้
$site['name'] = 'Blacklist - ' . config('site.name');
$site['desc'] = config('site.description');
$site['bot'] = '';
?>

<?= views('template/front/header') ?>

<body>
    <?= visitor_views('layouts/navbar') ?>
    <div class="body container">
        <div class="d-flex justify-content-center">
            <div class="card mb-4 shadow" style="width: 50rem;">
                <div class="card-body">
                    <div class="modal-header justify-content-between">
                        <span></span>
                        <h5 class="modal-title">รายละเอียดกิจการ</h5>
                        <a href="<?= url_back() ?>" class="btn btn-close"></a>
                    </div>
                    <div class="modal-body">
                        <div class="mb-3">
                            <label class="form-label">ชื่อกิจการ</label>
                            <input type="text" class="form-control" value="<?= $result['name'] ?>" disabled>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">สาเหตุการขึ้นบัญชีดำ</label>
                            <textarea class="form-control" rows="3" disabled><?= $result['reason'] ?></textarea>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">ประเภท</label>
                            <input type="text" class="form-control" value="<?= $result['blacklist_category'] ?>" disabled>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">เว็บไซต์</label>
                            <a href="<?= $result['website'] ?>" class="form-control"><?= $result['website'] ?></a>
                        </div>
                        <div class="row">
                            <div class="col">
                                <div class="mb-3">
                                    <label class="form-label">ชื่อจริงผู้ขาย</label>
                                    <input type="text" class="form-control" value="<?= $result['id_firstname'] ?>" disabled>
                                </div>
                            </div>
                            <div class="col">
                                <div class="mb-3">
                                    <label class="form-label">นามสกุลผู้ขาย</label>
                                    <input type="text" class="form-control" value="<?= $result['id_lastname'] ?>" disabled>
                                </div>
                            </div>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">เลขบัตรประชาชน</label>
                            <input type="text" class="form-control" value="<?= $result['id_number'] ?>" disabled>
                        </div>
                        <div class="row">
                            <div class="col">
                                <div class="mb-3">
                                    <label class="form-label">ประเภทบัญชีธนาคาร</label>
                                    <input type="text" class="form-control" value="<?= $result['bank_name'] ?>" disabled>
                                </div>
                            </div>
                            <div class="col">
                                <div class="mb-3">
                                    <label class="form-label">เลขที่บัญชี</label>
                                    <input type="text" class="form-control" value="<?= $result['bank_number'] ?>" disabled>
                                </div>
                            </div>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">สินค้า</label>
                            <input type="text" class="form-control" value="<?= $result['item_name'] ?>" disabled>
                        </div>
                        <div class="row">
                            <div class="col">
                                <div class="mb-3">
                                    <label class="form-label">ยอดเงิน</label>
                                    <input type="text" class="form-control" value="<?= $result['item_balance'] ?>" disabled>
                                </div>
                            </div>
                            <div class="col">
                                <div class="mb-3">
                                    <label class="form-label">เวลาโอน</label>
                                    <input type="text" class="form-control" value="<?= $result['item_date'] ?>" disabled>
                                </div>
                            </div>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">หลักฐาน</label>
                            <?php
                            $proof = BlacklistImage::find()->where('blacklist_id', $result['id'])->get();
                            foreach ($proof as $key => $value) {
                            ?>
                                <div class="text-center">
                                    <img src="<?= $value['image'] ?>" class="img-fluid" style="width:150px">
                                </div>
                            <?php
                            }
                            ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <?= views('template/front/footer') ?>
    <?= views('template/front/cdn_footer') ?>
</body>