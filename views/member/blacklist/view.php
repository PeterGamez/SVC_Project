<?php

use App\Models\Blacklist;
use App\Models\BlacklistImage;
?>

<?= views('layouts.back_header') ?>

<body>
    <div id="wrapper">
        <?= admin_views('layouts.sidebar') ?>
        <div id="content-wrapper" class="d-flex flex-column">
            <div id="content">
                <?= admin_views('layouts.topbar') ?>
                <div class="container-fluid">
                    <div class="d-flex justify-content-center">
                        <div class="card card-30 mb-4 shadow">
                            <div class="card-body">
                                <div class="modal-header justify-content-center">
                                    <h5 class="modal-title">รายละเอียดกิจการ</h5>
                                </div>
                                <div class="modal-body">
                                    <?php
                                    $result = Blacklist::find()
                                        ->select(
                                            'blacklist.*',
                                            'approve.color as approve_color',
                                            'approve.icon as approve_icon',
                                            'bank.name as bank_name',
                                        )
                                        ->join('approve', 'blacklist.approve_id', '=', 'approve.id')
                                        ->where('id', '=', $request['id'])
                                        ->getOne();
                                    ?>
                                    <div class="form-group">
                                        <label>ชื่อกิจการ <span class="text-<?= $approve['color'] ?>"><i class="<?= $approve['icon'] ?>"></i></span></label>
                                        <input type="text" class="form-control" value="<?= $result['name'] ?>" disabled>
                                    </div>
                                    <div class="form-group">
                                        <label>สาเหตุการขึ้นบัญชีดำ</label>
                                        <textarea class="form-control" rows="3" disabled><?= $result['reason'] ?></textarea>
                                    </div>
                                    <div class="form-group">
                                        <label>เว็บไซต์</label>
                                        <input type="text" class="form-control" value="<?= $result['website'] ?>" disabled>
                                    </div>
                                    <div class="row">
                                        <div class="col">
                                            <div class="form-group">
                                                <label>ชื่อจริงผู้ขาย</label>
                                                <input type="text" class="form-control" value="<?= $result['id_firstname'] ?>" disabled>
                                            </div>
                                        </div>
                                        <div class="col">
                                            <div class="form-group">
                                                <label>นามสกุลผู้ขาย</label>
                                                <input type="text" class="form-control" value="<?= $result['id_lastname'] ?>" disabled>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label>เลขบัตรประชาชน</label>
                                        <input type="text" class="form-control" value="<?= $result['id_number'] ?>" disabled>
                                    </div>
                                    <div class="form-group">
                                        <label>รูปบัตรประชาชน</label>
                                        <div class="text-center">
                                            <img src="<?= $result['id_image'] ?>" class="img-fluid" style="width:150px">
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label>ประเภทบัญชีธนาคาร</label>
                                        <input type="text" class="form-control" value="<?= $result['bank_name'] ?>" disabled>
                                    </div>
                                    <div class="form-group">
                                        <label>เลขที่บัญชี</label>
                                        <input type="text" class="form-control" value="<?= $result['bank_number'] ?>" disabled>
                                    </div>
                                    <div class="form-group">
                                        <label>สินค้า</label>
                                        <input type="text" class="form-control" value="<?= $result['item_name'] ?>" disabled>
                                    </div>
                                    <div class="row">
                                        <div class="col">
                                            <div class="form-group">
                                                <label>ยอดเงิน</label>
                                                <input type="text" class="form-control" value="<?= $result['item_balance'] ?>" disabled>
                                            </div>
                                        </div>
                                        <div class="col">
                                            <div class="form-group">
                                                <label>เวลาโอน</label>
                                                <input type="text" class="form-control" value="<?= $result['item_date'] ?>" disabled>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label>หลักฐาน</label>
                                        <?php
                                        $proof = BlacklistImage::find()->where('blacklist_id', '=', $result['id'])->get();
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
                <?= views('layouts.back_footer') ?>
            </div>
        </div>
    </div>
    <?= resource('cdn/back_foot.php') ?>
</body>