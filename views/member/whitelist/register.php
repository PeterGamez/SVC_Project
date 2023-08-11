<?php

use App\Class\Alert;
use App\Models\Whitelist;

$data = Whitelist::find()->where('account_id', $_SESSION['user_id'])->getOne();
if ($data) {
    if ($data['approve_id'] == 1) {
        echo Alert::alerts("กิจการของคุณอยู่ระหว่างการตรวจสอบ", "warning", 1500, "window.location.href = '" . member_url() . "'");
        exit;
    }
    if ($data['approve_id'] == 3) {
        echo Alert::alerts("ข้อมูลการลงทะเบียนไม่ถูกต้อง", "error", 1500, "window.location.href = '" . member_url() . "'");
        exit;
    }
}
$site['cdn'] = ['bs-file'];
?>

<?= views('template/back/header') ?>

<body>
    <div id="wrapper">
        <?= member_views('layouts.sidebar') ?>
        <div id="content-wrapper" class="d-flex flex-column">
            <div id="content">
                <?= member_views('layouts.topbar') ?>
                <div class="container-fluid">
                    <div class="d-flex justify-content-center">
                        <div class="card card-40 mb-4 shadow">
                            <div class="card-body">
                                <div class="modal-header justify-content-center">
                                    <h5 class="modal-title">ลงทะเบียนกิจการ</h5>
                                </div>
                                <form method="POST" action="<?= url() ?>" enctype="multipart/form-data">
                                    <div class="modal-body">
                                        <div class="form-group">
                                            <label>ชื่อกิจการ <span class="text-danger">*</span></label>
                                            <input type="text" class="form-control" name="name" required maxlength="50">
                                        </div>
                                        <div class="form-group">
                                            <label>คำอธิบายกิจการ <span class="text-danger">*</span></label>
                                            <textarea class="form-control" name="description" rows="3" required maxlength="255"></textarea>
                                        </div>
                                        <div class="form-group">
                                            <label>แบนเนอร์ <span class="text-danger">*</span></label>
                                            <div class="custom-file">
                                                <label class="custom-file-label" for="banner">เลือกไฟล์</label>
                                                <input type="file" class="custom-file-input" id="banner" name="banner" accept="image/png, image/jpeg" required>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label>เว็บไซต์ <span class="text-danger">*</span></label>
                                            <input type="text" class="form-control" name="website" required maxlength="50">
                                        </div>
                                        <div class="row">
                                            <div class="col">
                                                <div class="form-group">
                                                    <label>ชื่อเจ้าของกิจการ <span class="text-danger">*</span></label>
                                                    <input type="text" class="form-control" name="id_firstname" required maxlength="50">
                                                </div>
                                            </div>
                                            <div class="col">
                                                <div class="form-group">
                                                    <label>นามสกุลเจ้าของกิจการ <span class="text-danger">*</span></label>
                                                    <input type="text" class="form-control" name="id_lastname" required maxlength="50">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label>เลขบัตรประชาชน <span class="text-danger">*</span></label>
                                            <input type="text" class="form-control" name="id_number" required pattern="\d+" maxlength="13">
                                        </div>
                                        <div class="form-group">
                                            <label>รูปบัตรประชาชน <span class="text-danger">*</span></label>
                                            <div class="custom-file">
                                                <label class="custom-file-label" for="id_image">เลือกไฟล์</label>
                                                <input type="file" class="custom-file-input" id="id_image" name="id_image" accept="image/png, image/jpeg" required>
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
                <?= views('template/back/footer') ?>
            </div>
        </div>
    </div>
    <?= views('template/back/cdn_footer') ?>
</body>