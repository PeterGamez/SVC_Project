<?= views('layouts.back_header') ?>

<body>
    <div id="wrapper">
        <?= member_views('layouts.sidebar') ?>
        <div id="content-wrapper" class="d-flex flex-column">
            <div id="content">
                <?= member_views('layouts.topbar') ?>
                <div class="container-fluid">
                    <div class="d-flex justify-content-center">
                        <div class="card mb-4 shadow" style="width: 30rem;">
                            <div class="card-body">
                                <div class="modal-header justify-content-center">
                                    <h5 class="modal-title">ลงทะเบียนกิจการ</h5>
                                </div>
                                <form method="POST" action="<?= url() ?>" enctype="multipart/form-data">
                                    <div class="modal-body">
                                        <div class="form-group">
                                            <label>ชื่อกิจการ <span class="text-danger">*</span></label>
                                            <input type="text" class="form-control" required>
                                        </div>
                                        <div class="form-group">
                                            <label>คำอธิบายกิจการ <span class="text-danger">*</span></label>
                                            <textarea class="form-control" name="description" rows="3" required></textarea>
                                        </div>
                                        <div class="form-group">
                                            <label>ประเภทกิจการ <span class="text-danger">*</span></label>
                                            <select class="form-control" name="whitelist_category_id" required>
                                                <?php
                                                $result = WhitelistCategory::find();
                                                for ($i = 0; $i < count($result); $i++) {
                                                    echo '<option value="' . $result[$i]['id'] . '">' . $result[$i]['name'] . '</option>';
                                                }
                                                ?>
                                            </select>
                                        </div>
                                        <div class="form-group">
                                            <label>เว็บไซต์ <span class="text-danger">*</span></label>
                                            <input type="text" class="form-control" name="website" required>
                                        </div>
                                        <div class="form-group">
                                            <label>ชื่อเจ้าของกิจการ <span class="text-danger">*</span></label>
                                            <input type="text" class="form-control" name="id_name" required>
                                        </div>
                                        <div class="form-group">
                                            <label>เลขบัตรประชาชน <span class="text-danger">*</span></label>
                                            <input type="text" class="form-control" name="id_card" required>
                                        </div>
                                        <div class="form-group">
                                            <label>รูปบัตรประชาชน <span class="text-danger">*</span></label>
                                            <div class="custom-file">
                                                <label class="custom-file-label" for="id_image">เลือกไฟล์</label>
                                                <input type="file" class="custom-file-input" id="id_image" name="id_image" required>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="modal-body">
                                        <div class="d-flex justify-content-center">
                                            <button type="submit" class="btn btn-success">ลงทะเบียน</button>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
                <?= views('layouts.back_footer') ?>
            </div>
        </div>
    </div>
    <?= resource('cdn/back_foot.php') ?>
</body>