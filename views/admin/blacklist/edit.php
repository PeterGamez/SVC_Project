<?php
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
                        <div class="card mb-4 shadow" style="width: 30rem;">
                            <div class="card-body">
                                <div class="modal-header justify-content-center">
                                    <h5 class="modal-title">เพื่มกิจการ</h5>
                                </div>
                                <form method="POST" action="<?= url() ?>" enctype="multipart/form-data">
                                    <div class="modal-body">
                                        <?php
                                        $result = Blacklist::findOne(['id' => $request['id']]);
                                        ?>
                                        <input type="hidden" name="id" value="<?= $result['id'] ?>">
                                        <div class="form-group">
                                            <label>ชื่อกิจการ <span class="text-danger">*</span></label>
                                            <input type="text" class="form-control" name="name" value="<?= $result['name'] ?>" required>
                                        </div>
                                        <div class="form-group">
                                            <label>สาเหตุการขึ้นบัญชีดำ <span class="text-danger">*</span></label>
                                            <textarea class="form-control" name="reason" rows="3" required><?= $result['reason'] ?></textarea>
                                        </div>
                                        <div class="form-group">
                                            <label>ประเภทกิจการ <span class="text-danger">*</span></label>
                                            <select class="form-control" name="blacklist_category_id" required>
                                                <?php
                                                $category = BlacklistCategory::find();
                                                for ($i = 0; $i < count($category); $i++) {
                                                    if ($category[$i]['id'] == $result['blacklist_category_id']) {
                                                        echo '<option value="' . $category[$i]['id'] . '" selected>' . $category[$i]['name'] . '</option>';
                                                    } else {
                                                        echo '<option value="' . $category[$i]['id'] . '">' . $category[$i]['name'] . '</option>';
                                                    }
                                                }
                                                ?>
                                            </select>
                                        </div>
                                        <div class="form-group">
                                            <label>เว็บไซต์ <span class="text-danger">*</span></label>
                                            <input type="text" class="form-control" name="website" value="<?= $result['website'] ?>" required>
                                        </div>
                                        <div class="form-group">
                                            <label>ชื่อเจ้าของกิจการ <span class="text-danger">*</span></label>
                                            <input type="text" class="form-control" name="id_name" value="<?= $result['id_name'] ?>" required>
                                        </div>
                                        <div class="form-group">
                                            <label>เลขบัตรประชาชน <span class="text-danger">*</span></label>
                                            <input type="text" class="form-control" name="id_card" value="<?= $result['id_card'] ?>" required>
                                        </div>
                                        <div class="form-group">
                                            <label>รูปบัตรประชาชน</label>
                                            <div class="custom-file">
                                                <label class="custom-file-label" for="id_image">เลือกไฟล์</label>
                                                <input type="file" class="custom-file-input" id="id_image" name="id_image">
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label>ประเภทบัญชีธนาคาร <span class="text-danger">*</span></label>
                                            <select class="form-control" name="bank_id" required>
                                                <?php
                                                $bank = Bank::find();
                                                for ($i = 0; $i < count($bank); $i++) {
                                                    if ($bank[$i]['id'] == $result['bank_id']) {
                                                        echo '<option value="' . $bank[$i]['id'] . '" selected>' . $bank[$i]['name'] . '</option>';
                                                    } else {
                                                        echo '<option value="' . $bank[$i]['id'] . '">' . $bank[$i]['name'] . '</option>';
                                                    }
                                                }
                                                ?>
                                            </select>
                                        </div>
                                        <div class="form-group">
                                            <label>เลขที่บัญชี <span class="text-danger">*</span></label>
                                            <input type="text" class="form-control" name="bank_number" value="<?= $result['bank_number'] ?>" required>
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