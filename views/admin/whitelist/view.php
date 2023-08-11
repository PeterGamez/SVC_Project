<?php

use App\Models\Whitelist;
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
                                    <h5 class="modal-title">รายละเอียดกิจการ</h5>
                                </div>
                                <div class="modal-body">
                                    <?php
                                    $result = Whitelist::find()
                                        ->select(
                                            'whitelist.*',
                                            'approve.color as approve_color',
                                            'approve.icon as approve_icon'
                                        )
                                        ->join('approve', 'id', 'approve_id')
                                        ->where('whitelist.id', $request['id'])
                                        ->getOne();
                                    ?>
                                    <div class="form-group">
                                        <label>ชื่อกิจการ <span class="text-<?= $result['approve_color'] ?>"><i class="<?= $result['approve_icon'] ?>"></i></span></label>
                                        <input type="text" class="form-control" value="<?= $result['name'] ?>" disabled>
                                    </div>
                                    <div class="form-group">
                                        <label>คำอธิบายกิจการ</label>
                                        <textarea class="form-control" rows="3" disabled><?= $result['description'] ?></textarea>
                                    </div>
                                    <div class="form-group">
                                        <label>รูปป้ายร้าน</label>
                                        <div class="text-center">
                                            <img src="<?= $result['banner'] ?>" class="img-fluid" style="width:150px">
                                        </div>
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
                                        <?php
                                        if (in_array($_SESSION['user_role'], ['superadmin', 'admin'])) {
                                        ?>
                                            <a href="<?= admin_url('whitelist.' . $result['id'] . '.edit') ?>" class="btn btn-sm btn-primary">แก้ไขกิจการ</a>

                                            <a href="<?= admin_url('whitelist.' . $result['id'] . '.delete') ?>" class="btn btn-sm btn-danger">ลบกิจการ</a>
                                        <?php
                                        }
                                        ?>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <?= views('template/back/footer') ?>
            </div>
        </div>
    </div>
    <?= views('template/back/cdn_footer') ?>
</body>