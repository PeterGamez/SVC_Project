<?= admin_views('layouts.header') ?>

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
                                    <h5 class="modal-title">อนุมัติกิจการ</h5>
                                </div>
                                <form method="POST" action="<?= url() ?>" enctype="multipart/form-data">
                                    <div class="modal-body">
                                        <?php
                                        $result = Whitelist::findOne(['id' => $request['id']]);
                                        ?>
                                        <input type="hidden" name="id" value="<?= $result['id'] ?>">
                                        <div class="form-group">
                                            <label>ชื่อกิจการ</label>
                                            <input type="text" class="form-control" value="<?= $result['name'] ?>" disabled>
                                        </div>
                                        <div class="form-group">
                                            <label>สถานะ <span class="text-danger">*</span></label>
                                            <select class="form-control" name="approve_agree" required>
                                                <option value="0" <?= $result['approve_agree'] == 0 ? 'selected' : '' ?>>ไม่อนุมัติ</option>
                                                <option value="1" <?= $result['approve_agree'] == 1 ? 'selected' : '' ?>>อนุมัติ</option>
                                            </select>
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
            <?= admin_views('layouts.footer') ?>
        </div>
    </div>
    <?= resource('cdn/back_foot.php') ?>
</body>