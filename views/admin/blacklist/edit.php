<?php

use App\Models\Blacklist;
use App\Models\Bank;

$site['cdn'] = ['bs-file'];
?>

<?= views('template/back/header') ?>

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
                                    <h5 class="modal-title">เพื่มกิจการ</h5>
                                </div>
                                <form method="POST" action="<?= url() ?>" enctype="multipart/form-data">
                                    <div class="modal-body">
                                        <?php
                                        $result = Blacklist::find()
                                            ->select(
                                                'blacklist.*',
                                                'blacklist_category.name as blacklist_category'
                                            )
                                            ->join('blacklist_category', 'id', 'blacklist_category_id')
                                            ->where('blacklist.id', $request['id'])
                                            ->getOne();
                                        ?>
                                        <input type="hidden" name="id" value="<?= $result['id'] ?>">
                                        <div class="form-group">
                                            <label>ชื่อกิจการ <span class="text-danger">*</span></label>
                                            <input type="text" class="form-control" name="name" value="<?= $result['name'] ?>" required maxlength="50">
                                        </div>
                                        <div class="form-group">
                                            <label>สาเหตุการขึ้นบัญชีดำ <span class="text-danger">*</span></label>
                                            <textarea class="form-control" name="reason" rows="3" required maxlength="255"><?= $result['reason'] ?></textarea>
                                        </div>
                                        <div class="form-group">
                                            <label>เว็บไซต์ <span class="text-danger">*</span></label>
                                            <input type="text" class="form-control" name="website" value="<?= $result['website'] ?>" required maxlength="50">
                                        </div>
                                        <div class="row">
                                            <div class="col">
                                                <div class="form-group">
                                                    <label>ชื่อจริงผู้ขาย <span class="text-danger">*</span></label>
                                                    <input type="text" class="form-control" name="id_firstname" value="<?= $result['id_firstname'] ?>" required maxlength="50">
                                                </div>
                                            </div>
                                            <div class="col">
                                                <div class="form-group">
                                                    <label>นามสกุลผู้ขาย <span class="text-danger">*</span></label>
                                                    <input type="text" class="form-control" name="id_lastname" value="<?= $result['id_lastname'] ?>" required maxlength="50">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label>เลขบัตรประชาชน</label>
                                            <input type="text" class="form-control" name="id_card" value="<?= $result['id_card'] ?>" pattern="\d+" maxlength="13">
                                        </div>
                                        <div class="form-group">
                                            <label>รูปบัตรประชาชน</label>
                                            <div class="custom-file">
                                                <label class="custom-file-label" for="id_image">เลือกไฟล์</label>
                                                <input type="file" class="custom-file-input" id="id_image" accept="image/png, image/jpeg" name="id_image">
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col">
                                                <div class="form-group">
                                                    <label>ประเภทบัญชีธนาคาร <span class="text-danger">*</span></label>
                                                    <select class="form-control" name="bank_id" required>
                                                        <?php
                                                        $bank = Bank::find()->get();
                                                        for ($i = 0; $i < count($bank); $i++) {
                                                            if ($bank[$i]['id'] == $result['bank_id']) {
                                                                echo '<option value="' . $bank[$i]['id'] . '" selected>' . $bank[$i]['name'] . '</option>';
                                                            } else {
                                                                echo '<option value="' . $bank[$i]['id'] . '">' . $bank[$i]['name'] . '</option>';
                                                            }
                                                        }
                                                        ?>
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="col">
                                                <div class="form-group">
                                                    <label>เลขที่บัญชี <span class="text-danger">*</span></label>
                                                    <input type="text" class="form-control" name="bank_number" value="<?= $result['bank_number'] ?>" required pattern="\d+" maxlength="15">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label>สินค้า <span class="text-danger">*</span></label>
                                            <input type="text" class="form-control" name="item_name" value="<?= $result['item_name'] ?>" required maxlength="50">
                                        </div>
                                        <div class="row">
                                            <div class="col">
                                                <div class="form-group">
                                                    <label>ยอดเงิน <span class="text-danger">*</span></label>
                                                    <input type="text" class="form-control" name="item_balance" value="<?= $result['item_balance'] ?>" required pattern="\d+">
                                                </div>
                                            </div>
                                            <div class="col">
                                                <div class="form-group">
                                                    <label>เวลาโอน <span class="text-danger">*</span></label>
                                                    <input type="text" class="form-control" name="item_date" value="<?= $result['item_date'] ?>" required>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="modal-body">
                                        <div class="d-flex justify-content-between">
                                            <a href="<?= url_back() ?>" class="btn btn-secondary">ย้อนกลับ</a>
                                            <button type="submit" class="btn btn-success">บันทึก</button>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <?= views('template/back/footer') ?>
        </div>
    </div>
    <?= views('template/back/cdn_footer') ?>
</body>