<?php

use App\Models\Account;

$result = Account::find($request)->getOne();
if ($result['role'] == 'superadmin' and $_SESSION['user_role'] <> 'superadmin') {
    redirect(admin_url('account'));
    exit;
}
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
                                    <h5 class="modal-title">แก้ไขรหัสผ่าน</h5>
                                </div>
                                <form method="POST" action="<?= url() ?>">
                                    <input type="hidden" name="id" value="<?= $result['id'] ?>">
                                    <div class="modal-body">
                                        <div class="form-group">
                                            <label>ชื่อบัญชี</label>
                                            <input type="text" class="form-control" value="<?= $result['username'] ?>" disabled>
                                        </div>
                                        <div class="form-group">
                                            <label>รหัสผ่าน <span class="text-danger">*</span></label>
                                            <input type="text" class="form-control" name="password" required minlength="8">
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