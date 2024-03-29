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
                                    <h5 class="modal-title">ตรวจสอบบัญชี</h5>
                                </div>
                                <?php
                                $result = Account::find($request)->getOne();
                                ?>
                                <div class="modal-body">
                                    <div class="form-group">
                                        <label>ชื่อบัญชี</label>
                                        <input type="text" class="form-control" value="<?= $result['username'] ?>" disabled>
                                    </div>
                                    <div class="form-group">
                                        <label>อีเมล</label>
                                        <input type="text" class="form-control" value="<?= $result['email'] ?>" disabled>
                                    </div>
                                    <div class="form-group">
                                        <label>สิทธิ์การใช้งาน</label>
                                        <select class="form-control" disabled>
                                            <option value="superadmin" <?= $result['role'] == "superadmin" ? "selected" : "" ?>>ผู้ดูแลระบบ (superadmin)</option>
                                            <option value="admin" <?= $result['role'] == "admin" ? "selected" : "" ?>>ผู้ดูแล (admin)</option>
                                            <option value="staff" <?= $result['role'] == "staff" ? "selected" : "" ?>>เจ้าหน้าที่ (staff)</option>
                                            <option value="seller" <?= $result['role'] == "seller" ? "selected" : "" ?>>ผู้ขาย (seller)</option>
                                            <option value="user" <?= $result['role'] == "user" ? "selected" : "" ?>>ผู้ใช้งาน (user)</option>
                                        </select>
                                    </div>
                                    <?php
                                    if ($result['role'] == 'superadmin' and $_SESSION['user_role'] == 'superadmin') {
                                    ?>
                                        <div class="modal-body">
                                            <div class="btn btn-group">
                                                <a href="<?= admin_url('account.' . $result['id'] . '.edit') ?>" class="btn btn-sm btn-primary">แก้ไขบัญชี</a>
                                                <a href="<?= admin_url('account.' . $result['id'] . '.password') ?>" class="btn btn-sm btn-primary">เปลี่ยนรหัสผ่าน</a>
                                                <a href="<?= admin_url('account.' . $result['id'] . '.delete') ?>" class="btn btn-sm btn-danger">ลบบัญชี</a>
                                            </div>
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
            <?= views('template/back/footer') ?>
        </div>
    </div>
    <?= views('template/back/cdn_footer') ?>
</body>