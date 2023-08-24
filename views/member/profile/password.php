<?= views('template/back/header') ?>

<body>
    <div id="wrapper">
        <?php
        if (in_array($_SESSION['user_role'], ['superadmin', 'admin', 'staff'])) {
            echo admin_views('layouts.sidebar');
        } else {
            echo member_views('layouts.sidebar');
        }
        ?>
        <div id="content-wrapper" class="d-flex flex-column">
            <div id="content">
                <?php
                if (in_array($_SESSION['user_role'], ['superadmin', 'admin', 'staff'])) {
                    echo admin_views('layouts.topbar');
                } else {
                    echo member_views('layouts.topbar');
                }
                ?>
                <div class="container-fluid">
                    <div class="d-flex justify-content-center">
                        <div class="card card-30 mb-4 shadow">
                            <div class="card-body">
                                <div class="modal-header justify-content-center">
                                    <h5 class="modal-title">เปลี่ยนรหัสผ่าน</h5>
                                </div>
                                <form method="POST" action="<?= url() ?>">
                                    <input type="hidden" name="id" value="<?= $_SESSION['user_id'] ?>">
                                    <div class="modal-body">
                                        <div class="form-group">
                                            <label>รหัสผ่านใหม่ <span class="text-danger">*</span></label>
                                            <input type="password" class="form-control" name="password1" required minlength="8">
                                        </div>
                                        <div class="form-group">
                                            <label>ยืนยันรหัสผ่าน <span class="text-danger">*</span></label>
                                            <input type="password" class="form-control" name="password2" required minlength="8">
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