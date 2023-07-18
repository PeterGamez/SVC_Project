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
                                    <h5 class="modal-title">แก้ไขธนาคาร</h5>
                                </div>
                                <form method="POST" action="<?= url() ?>" enctype="multipart/form-data">
                                    <div class="modal-body">
                                        <?php
                                        $result = Bank::find()->where('id', '=', $request['id'])->getOne();
                                        ?>
                                        <input type="hidden" name="id" value="<?= $result['id'] ?>">
                                        <div class="form-group">
                                            <label>ชื่อธนาคาร <span class="text-danger">*</span></label>
                                            <input type="text" class="form-control" name="name" value="<?= $result['name'] ?>" required>
                                        </div>
                                        <div class="form-group">
                                            <label>โลโก้ธนาคาร</label>
                                            <div class="custom-file">
                                                <label class="custom-file-label" for="image">เลือกไฟล์</label>
                                                <input type="file" class="custom-file-input" id="image" accept="image/png, image/jpeg" name="image">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="modal-body">
                                        <div class="d-flex justify-content-between">
                                            <a href="<?= admin_url('bank') ?>" class="btn btn-secondary">ย้อนกลับ</a>
                                            <div class="btn-group">
                                                <a href="<?= admin_url('bank.' . $result['id'] . '.delete') ?>" class="btn btn-danger">ลบ</a>
                                                <button type="submit" class="btn btn-success">บันทึก</button>
                                            </div>
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