<?php

use App\Models\Approve;
use App\Models\Whitelist;
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
                                    $result = Whitelist::findOne(['id' => $request['id']]);
                                    ?>
                                    <div class="form-group">
                                        <?php
                                        $approve = Approve::findOne(['id' => $result['approve_id']]);
                                        ?>
                                        <label>ชื่อกิจการ <span class="text-<?= $approve['color'] ?>"><i class="<?= $approve['icon'] ?>"></i></span></label>
                                        <input type="text" class="form-control" value="<?= $result['name'] ?>" disabled>
                                    </div>
                                    <div class="form-group">
                                        <label>คำอธิบายกิจการ</label>
                                        <textarea class="form-control" rows="3" disabled><?= $result['description'] ?></textarea>
                                    </div>
                                    <div class="form-group">
                                        <label>เว็บไซต์</label>
                                        <input type="text" class="form-control" value="<?= $result['website'] ?>" disabled>
                                    </div>
                                    <div class="row">
                                        <div class="col">
                                            <div class="form-group">
                                                <label>ชื่อเจ้าของกิจการ</label>
                                                <input type="text" class="form-control" value="<?= $result['id_firstname'] ?>" disabled>
                                            </div>
                                        </div>
                                        <div class="col">
                                            <div class="form-group">
                                                <label>นามสกุลเจ้าของกิจการ</label>
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
                                </div>
                                <div class="modal-body">
                                    <div class="btn btn-group">
                                        <a href="<?= admin_url('whitelist.' . $result['id'] . '.approve') ?>" class="btn btn-sm btn-secondary">ยืนยันกิจการ</a>
                                        <a href="<?= admin_url('whitelist.' . $result['id'] . '.edit') ?>" class="btn btn-sm btn-primary">แก้ไขกิจการ</a>
                                        <a href="<?= admin_url('whitelist.' . $result['id'] . '.delete') ?>" class="btn btn-sm btn-danger">ลบกิจการ</a>
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