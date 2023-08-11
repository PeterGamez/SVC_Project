<?php

use App\Models\BlacklistCategory;
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
                                    <h5 class="modal-title">แก้ไขประเภทกิจการ</h5>
                                </div>
                                <form method="POST" action="<?= url() ?>">
                                    <?php
                                    $result = BlacklistCategory::find($request)->getOne();
                                    ?>
                                    <input type="hidden" name="id" value="<?= $result['id'] ?>">
                                    <div class="modal-body">
                                        <div class="form-group">
                                            <label>ชื่อประเภทกิจการ <span class="text-danger">*</span></label>
                                            <input type="text" class="form-control" name="name" value="<?= $result['name'] ?>" required maxlength="50">
                                        </div>
                                    </div>
                                    <div class="modal-body">
                                        <div class="d-flex justify-content-between">
                                            <a href="<?= url_back() ?>" class="btn btn-secondary">ย้อนกลับ</a>
                                            <div class="btn-group">
                                                <a href="<?= admin_url('blacklist.category.' . $result['id'] . '.delete') ?>" class="btn btn-danger">ลบ</a>
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
           <?= views('template/back/footer') ?>
        </div>
    </div>
    <?= views('template/back/cdn_footer') ?>
</body>