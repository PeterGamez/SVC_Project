<?php

use App\Models\Approve;

$site['cdn'] = ['bs-file'];
?>

<?= views('layouts.back_header') ?>

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
                                    <h5 class="modal-title">แก้ไขสถานะ</h5>
                                </div>
                                <form method="POST" action="<?= url() ?>">
                                    <div class="modal-body">
                                        <?php
                                        $result = Approve::findOne(['id' => $request['id']]);
                                        ?>
                                        <input type="hidden" name="id" value="<?= $result['id'] ?>">
                                        <div class="form-group">
                                            <label>ชื่อสถานะ <span class="text-danger">*</span></label>
                                            <input type="text" class="form-control" name="name" value="<?= $result['name'] ?>" required>
                                        </div>
                                        <div class="form-group">
                                            <label>color <span class="text-danger">*</span></label>
                                            <select class="form-control" name="color" required>
                                                <option class="text-primary" value="primary" <?= $result['color'] == 'primary' ? 'selected' : '' ?>>primary</option>
                                                <option class="text-secondary" value="secondary" <?= $result['color'] == 'secondary' ? 'selected' : '' ?>>secondary</option>
                                                <option class="text-success" value="success" <?= $result['color'] == 'success' ? 'selected' : '' ?>>success</option>
                                                <option class="text-danger" value="danger" <?= $result['color'] == 'danger' ? 'selected' : '' ?>>danger</option>
                                                <option class="text-warning" value="warning" <?= $result['color'] == 'warning' ? 'selected' : '' ?>>warning</option>
                                                <option class="text-info" value="info" <?= $result['color'] == 'info' ? 'selected' : '' ?>>info</option>
                                                <option class="text-light" value="light" <?= $result['color'] == 'light' ? 'selected' : '' ?>>light</option>
                                                <option class="text-dark" value="dark" <?= $result['color'] == 'dark' ? 'selected' : '' ?>>dark</option>
                                                <option class="text-body" value="body" <?= $result['color'] == 'body' ? 'selected' : '' ?>>body</option>
                                                <option class="text-muted" value="muted" <?= $result['color'] == 'muted' ? 'selected' : '' ?>>muted</option>
                                                <option class="text-white" value="white" <?= $result['color'] == 'white' ? 'selected' : '' ?>>white</option>
                                            </select>
                                        </div>
                                        <div class="form-group">
                                            <label>icon <span class="text-danger">*</span></label>
                                            <input type="text" class="form-control" name="icon" value="<?= $result['icon'] ?>" required>
                                        </div>
                                        <div class="form-group">
                                            <label>whitelist <span class="text-danger">*</span></label>
                                            <select class="form-control" name="whitelist" required>
                                                <option class="text-danger" value="0" <?= $result['whitelist'] == '0' ? 'selected' : '' ?>>ซ่อน</option>
                                                <option class="text-success" value="1" <?= $result['whitelist'] == '1' ? 'selected' : '' ?>>แสดง</option>
                                            </select>
                                        </div>
                                        <div class="form-group">
                                            <label>blacklist <span class="text-danger">*</span></label>
                                            <select class="form-control" name="blacklist" required>
                                                <option class="text-danger" value="0" <?= $result['blacklist'] == '0' ? 'selected' : '' ?>>ซ่อน</option>
                                                <option class="text-success" value="1" <?= $result['blacklist'] == '1' ? 'selected' : '' ?>>แสดง</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="modal-body">
                                        <div class="d-flex justify-content-between">
                                            <a href="<?= admin_url('approve') ?>" class="btn btn-secondary">ย้อนกลับ</a>
                                            <div class="btn-group">
                                                <a href="<?= admin_url('approve.' . $result['id'] . '.delete') ?>" class="btn btn-danger">ลบ</a>
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
            <?= views('layouts.back_footer') ?>
        </div>
    </div>
    <?= resource('cdn/back_foot.php') ?>
</body>