<?php

use App\Models\Account;
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
                                    <h5 class="modal-title">แก้ไขบัญชี</h5>
                                </div>
                                <form method="POST" action="<?= url() ?>">
                                    <?php
                                    $result = Account::find($request)->getOne();
                                    ?>
                                    <input type="hidden" name="id" value="<?= $result['id'] ?>">
                                    <div class="modal-body">
                                        <div class="form-group">
                                            <label>ชื่อบัญชี <span class="text-danger">*</span></label>
                                            <input type="text" class="form-control" name="username" value="<?= $result['username'] ?>" required pattern="[a-zA-Z0-9_]+" minlength="5" maxlength="20">
                                        </div>
                                        <div class="form-group">
                                            <label>อีเมล <span class="text-danger">*</span></label>
                                            <input type="text" class="form-control" name="email" value="<?= $result['email'] ?>" required maxlength="50">
                                        </div>
                                        <div class="form-group">
                                            <label>สิทธิ์การใช้งาน <span class="text-danger">*</span></label>
                                            <select class="form-control" name="role" required>
                                                <option value="superadmin" <?= $result['role'] == "superadmin" ? "selected" : "" ?>>ผู้ดูแลระบบ (superadmin)</option>
                                                <option value="admin" <?= $result['role'] == "admin" ? "selected" : "" ?>>ผู้ดูแล (admin)</option>
                                                <option value="staff" <?= $result['role'] == "staff" ? "selected" : "" ?>>เจ้าหน้าที่ (staff)</option>
                                                <option value="seller" <?= $result['role'] == "seller" ? "selected" : "" ?>>ผู้ขาย (seller)</option>
                                                <option value="user" <?= $result['role'] == "user" ? "selected" : "" ?>>ผู้ใช้งาน (user)</option>
                                            </select>
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