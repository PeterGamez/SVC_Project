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
                                    <h5 class="modal-title">เพิ่มบัญชี</h5>
                                </div>
                                <form method="POST" action="<?= url() ?>">
                                    <div class="modal-body">
                                        <div class="form-group">
                                            <label>ชื่อบัญชี <span class="text-danger">*</span></label>
                                            <input type="text" class="form-control" name="username" required>
                                        </div>
                                        <div class="form-group">
                                            <label>อีเมล <span class="text-danger">*</span></label>
                                            <input type="text" class="form-control" name="email" required>
                                        </div>
                                        <div class="form-group">
                                            <label>รหัสผ่าน <span class="text-danger">*</span></label>
                                            <input type="text" class="form-control" name="password" required>
                                        </div>
                                        <div class="form-group">
                                            <label>สิทธิ์การใช้งาน <span class="text-danger">*</span></label>
                                            <select class="form-control" name="role" required>
                                                <option value="superadmin">ผู้ดูแลระบบ (superadmin)</option>
                                                <option value="admin">ผู้ดูแล (admin)</option>
                                                <option value="staff">เจ้าหน้าที่ (staff)</option>
                                                <option value="seller">ผู้ขาย (seller)</option>
                                                <option value="user" selected>ผู้ใช้งาน (user)</option>
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
            <?= views('layouts.back_footer') ?>
        </div>
    </div>
    <?= resource('cdn/back_foot.php') ?>
</body>