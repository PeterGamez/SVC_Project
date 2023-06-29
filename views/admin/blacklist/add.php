<?php

use App\Models\Bank;

$site['cdn'] = ['bs-file'];
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
                                    <h5 class="modal-title">เพื่มกิจการ</h5>
                                </div>
                                <form method="POST" action="<?= url() ?>" enctype="multipart/form-data">
                                    <div class="modal-body">
                                        <div class="form-group">
                                            <label>ชื่อกิจการ <span class="text-danger">*</span></label>
                                            <input type="text" class="form-control" name="name" required>
                                        </div>
                                        <div class="form-group">
                                            <label>สาเหตุการขึ้นบัญชีดำ <span class="text-danger">*</span></label>
                                            <textarea class="form-control" name="reason" rows="3" required></textarea>
                                        </div>
                                        <div class="form-group">
                                            <label>เว็บไซต์ <span class="text-danger">*</span></label>
                                            <input type="text" class="form-control" name="website" required>
                                        </div>
                                        <div class="form-group">
                                            <label>ชื่อเจ้าของกิจการ <span class="text-danger">*</span></label>
                                            <input type="text" class="form-control" name="id_name" required>
                                        </div>
                                        <div class="form-group">
                                            <label>เลขบัตรประชาชน <span class="text-danger">*</span></label>
                                            <input type="text" class="form-control" name="id_number" required>
                                        </div>
                                        <div class="form-group">
                                            <label>รูปบัตรประชาชน <span class="text-danger">*</span></label>
                                            <div class="custom-file">
                                                <label class="custom-file-label" for="id_image">เลือกไฟล์</label>
                                                <input type="file" class="custom-file-input" id="id_image" name="id_image" accept="image/png, image/jpeg" required>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label>ประเภทบัญชีธนาคาร <span class="text-danger">*</span></label>
                                            <select class="form-control" name="bank_id" required>
                                                <?php
                                                $bank = Bank::find();
                                                for ($i = 0; $i < count($bank); $i++) {
                                                    echo '<option value="' . $bank[$i]['id'] . '">' . $bank[$i]['name'] . '</option>';
                                                }
                                                ?>
                                            </select>
                                        </div>
                                        <div class="form-group">
                                            <label>เลขที่บัญชี <span class="text-danger">*</span></label>
                                            <input type="text" class="form-control" name="bank_number" required>
                                        </div>
                                        <div class="form-group">
                                            <label>สินค้า <span class="text-danger">*</span></label>
                                            <input type="text" class="form-control" name="item_name" required>
                                        </div>
                                        <div class="form-group">
                                            <label>ยอดเงิน <span class="text-danger">*</span></label>
                                            <input type="text" class="form-control" name="item_balance" required>
                                        </div>
                                        <div class="form-group">
                                            <label>เวลาโอน <span class="text-danger">*</span></label>
                                            <input type="text" class="form-control" name="item_date" required>
                                        </div>
                                        <div class="form-group">
                                            <label>หลักฐานการฉ้อโกง <span class="text-danger">*</span></label>
                                            <div class="custom-file">
                                                <label class="custom-file-label" for="blacklist_image">เลือกไฟล์</label>
                                                <input type="file" class="custom-file-input" id="blacklist_image" name="blacklist_image[]" multiple accept="image/png, image/jpeg" required>
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
            <?= views('layouts.back_footer') ?>
        </div>
    </div>
    <?= resource('cdn/back_foot.php') ?>
</body>