<?= admin_views('layouts.header') ?>

<body id="page-top">
    <div id="wrapper">
        <?= admin_views('layouts.sidebar') ?>
        <div id="content-wrapper" class="d-flex flex-column">
            <div id="content">
                <?= admin_views('layouts.topbar') ?>
                <div class="container-fluid">
                    <div class="d-flex justify-content-center">
                        <div class="card" style="width: 30rem;">
                            <div class="card-body">
                                <div class="modal-header justify-content-center">
                                    <h5 class="modal-title">ลบบัญชี</h5>
                                </div>
                                <form method="POST" action="<?= url() ?>">
                                    <?php
                                    $result = Account::findOne(['id' => $request['id']]);
                                    ?>
                                    <input type="hidden" name="id" value="<?= $result['id'] ?>">
                                    <div class="modal-body">
                                        <div class="form-group">
                                            <label>ชื่อบัญชี</label>
                                            <input type="text" class="form-control" value="<?= $result['username'] ?>" disabled>
                                        </div>
                                    </div>
                                    <div class="modal-body">
                                        <div class="d-flex justify-content-between">
                                            <a href="<?= admin_url('account.' . $result['id']) ?>" class="btn btn-secondary">ย้อนกลับ</a>
                                            <button type="submit" class="btn btn-danger">ยืนยัน</button>
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