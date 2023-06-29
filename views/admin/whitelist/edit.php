<?php

use App\Models\Whitelist;

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
                                        <?php
                                        $result = Whitelist::findOne(['id' => $request['id']]);
                                        ?>
                                        <input type="hidden" name="id" value="<?= $result['id'] ?>">
                                        <div class="form-group">
                                            <label>ชื่อกิจการ <span class="text-danger">*</span></label>
                                            <input type="text" class="form-control" name="name" value="<?= $result['name'] ?>" required>
                                        </div>
                                        <div class="form-group">
                                            <label>คำอธิบายกิจการ <span class="text-danger">*</span></label>
                                            <textarea class="form-control" name="description" rows="3" required><?= $result['description'] ?></textarea>
                                        </div>
                                        <div class="form-group">
                                            <label>ไอดีเจ้าของกิจการ <span class="text-danger">*</span></label>
                                            <input type="text" class="form-control" name="account_id" value="<?= $result['account_id'] ?>" required>
                                        </div>
                                        <div class="form-group">
                                            <label>เว็บไซต์ <span class="text-danger">*</span></label>
                                            <input type="text" class="form-control" name="website" value="<?= $result['website'] ?>" required>
                                        </div>
                                        <div class="form-group">
                                            <label>ชื่อเจ้าของกิจการ <span class="text-danger">*</span></label>
                                            <input type="text" class="form-control" name="id_name" value="<?= $result['id_name'] ?>" required>
                                        </div>
                                        <div class="form-group">
                                            <label>เลขบัตรประชาชน <span class="text-danger">*</span></label>
                                            <input type="text" class="form-control" name="id_number" value="<?= $result['id_number'] ?>" required>
                                        </div>
                                        <div class="form-group">
                                            <label>รูปบัตรประชาชน</label>
                                            <div class="custom-file">
                                                <label class="custom-file-label" for="id_image">เลือกไฟล์</label>
                                                <input type="file" class="custom-file-input" id="id_image" name="id_image" accept="image/png, image/jpeg">
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