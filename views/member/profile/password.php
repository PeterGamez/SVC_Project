<?= views('layouts.back_header') ?>

<body>
    <div id="wrapper">
        <?= admin_views('layouts.sidebar') ?>
        <div id="content-wrapper" class="d-flex flex-column">
            <div id="content">
                <?= admin_views('layouts.topbar') ?>
                <div class="container-fluid">
                    <div class="d-flex justify-content-center">
                        <div class="card mb-4 shadow" style="width: 30rem;">
                            <div class="card-body">
                                <div class="modal-header justify-content-center">
                                    <h5 class="modal-title">เปลี่ยนรหัสผ่าน</h5>
                                </div>
                                <form method="POST" action="<?= url() ?>">
                                    <input type="hidden" name="id" value="<?= $_SESSION['user_id'] ?>">
                                    <div class="modal-body">
                                        <div class="form-group">
                                            <label>รหัสผ่านใหม่ <span class="text-danger">*</span></label>
                                            <input type="password" class="form-control" name="password1" required>
                                        </div>
                                        <div class="form-group">
                                            <label>ยืนยันรหัสผ่าน <span class="text-danger">*</span></label>
                                            <input type="password" class="form-control" name="password2" required>
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