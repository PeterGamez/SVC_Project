<?php

use App\Models\Approve;
use App\Models\Blacklist;
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
                                    <h5 class="modal-title">อนุมัติกิจการ</h5>
                                </div>
                                <form method="POST" action="<?= url() ?>">
                                    <div class="modal-body">
                                        <?php
                                        $result = Blacklist::find($request)->getOne();
                                        ?>
                                        <input type="hidden" name="id" value="<?= $result['id'] ?>">
                                        <div class="form-group">
                                            <label>ชื่อกิจการ</label>
                                            <input type="text" class="form-control" value="<?= $result['name'] ?>" disabled>
                                        </div>
                                        <div class="form-group">
                                            <label>สถานะ <span class="text-danger">*</span></label>
                                            <select class="form-control" name="approve_id" required>
                                                <?php
                                                $approve = Approve::find()->where('blacklist', 1)->get();
                                                for ($i = 0; $i < count($approve); $i++) {
                                                    echo '<option value="' . $approve[$i]['id'] . '" ' . ($result['approve_id'] == $approve[$i]['id'] ? 'selected' : '') . '>' . $approve[$i]['name'] . '</option>';
                                                }
                                                ?>
                                            </select>
                                        </div>
                                        <div class="form-group">
                                            <label>เหตุผล</label>
                                            <input type="text" class="form-control" name="approve_reason" value="<?= $result['approve_reason'] ?>" required maxlength="255">
                                        </div>
                                    </div>
                                    <div class="modal-body">
                                        <div class="d-flex justify-content-between">
                                            <a href="<?= url_back() ?>" class="btn btn-secondary">ย้อนกลับ</a>
                                            <button type="submit" class="btn btn-success">ยืนยัน</button>
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