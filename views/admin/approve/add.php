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
                                    <h5 class="modal-title">เพิ่มสถานะ</h5>
                                </div>
                                <form method="POST" action="<?= url() ?>">
                                    <div class="modal-body">
                                        <div class="form-group">
                                            <label>ชื่อสถานะ <span class="text-danger">*</span></label>
                                            <input type="text" class="form-control" name="name" required>
                                        </div>
                                        <div class="form-group">
                                            <label>color <span class="text-danger">*</span></label>
                                            <select class="form-control" name="color" required>
                                                <option class="text-primary" value="primary">primary</option>
                                                <option class="text-secondary" value="secondary">secondary</option>
                                                <option class="text-success" value="success">success</option>
                                                <option class="text-danger" value="danger">danger</option>
                                                <option class="text-warning" value="warning">warning</option>
                                                <option class="text-info" value="info">info</option>
                                                <option class="text-light" value="light">light</option>
                                                <option class="text-dark" value="dark">dark</option>
                                                <option class="text-body" value="body">body</option>
                                                <option class="text-muted" value="muted">muted</option>
                                                <option class="text-white" value="white">white</option>
                                            </select>
                                        </div>
                                        <div class="form-group">
                                            <label>icon <span class="text-danger">*</span></label>
                                            <input type="text" class="form-control" name="icon" required>
                                        </div>
                                        <div class="form-group">
                                            <label>whitelist <span class="text-danger">*</span></label>
                                            <select class="form-control" name="whitelist" required>
                                                <option class="text-danger" value="0">ซ่อน</option>
                                                <option class="text-success" value="1">แสดง</option>
                                            </select>
                                        </div>
                                        <div class="form-group">
                                            <label>blacklist <span class="text-danger">*</span></label>
                                            <select class="form-control" name="blacklist" required>
                                                <option class="text-danger" value="0">ซ่อน</option>
                                                <option class="text-success" value="1">แสดง</option>
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