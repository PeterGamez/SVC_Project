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
                                    <h5 class="modal-title">เพื่มกิจการ</h5>
                                </div>
                                <div class="modal-body">
                                    <?php
                                    $result = Whitelist::findOne(['id' => $request['id']]);
                                    ?>
                                    <div class="form-group">
                                        <label>ชื่อกิจการ</label>
                                        <input type="text" class="form-control" value="<?= $result['name'] ?>" disabled>
                                    </div>
                                    <div class="form-group">
                                        <label>คำอธิบายกิจการ</label>
                                        <textarea class="form-control" rows="3" disabled><?= $result['description'] ?></textarea>
                                    </div>
                                    <div class="form-group">
                                        <label>ประเภทกิจการ</label>
                                        <input type="text" class="form-control" value="<?= $result[$i]['name'] ?>" disabled>
                                    </div>
                                    <div class="form-group">
                                        <label>เว็บไซต์</label>
                                        <input type="text" class="form-control" value="<?= $result['website'] ?>" disabled>
                                    </div>
                                    <div class="form-group">
                                        <label>ชื่อเจ้าของกิจการ</label>
                                        <input type="text" class="form-control" value="<?= $result['id_name'] ?>" disabled>
                                    </div>
                                    <div class="form-group">
                                        <label>เลขบัตรประชาชน</label>
                                        <input type="text" class="form-control" value="<?= $result['id_card'] ?>" disabled>
                                    </div>
                                    <div class="form-group">
                                        <label>รูปบัตรประชาชน</label>
                                        <div class="text-center">
                                            <img src="<?= $result['id_image'] ?>" class="img-fluid" style="width: 200px;">
                                        </div>
                                    </div>
                                    <div class="modal-body">
                                        <div class="btn btn-group">
                                            <a href="<?= admin_url('whitelist') ?>" class="btn btn-sm btn-secondary">ย้อนกลับ</a>
                                            <a href="<?= admin_url('whitelist.' . $result['id'] . '.edit') ?>" class="btn btn-sm btn-primary">แก้ไขกิจการ</a>
                                            <a href="<?= admin_url('whitelist.' . $result['id'] . '.delete') ?>" class="btn btn-sm btn-danger">ลบกิจการ</a>
                                        </div>
                                    </div>
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