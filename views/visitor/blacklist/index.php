<?php

use App\Models\Blacklist;

$site['social'] = true; // กำหนดให้เว็บไซต์ใช้งาน Open Graph ได้
$site['cdn'] = array(); // กำหนดให้เว็บไซต์ใช้งาน CDN ที่กำหนดได้
$site['name'] = config('site.name');
$site['desc'] = config('site.description');
$site['bot'] = '';
?>

<?= visitor_views('layouts/header') ?>

<body>
    <?= visitor_views('layouts/navbar') ?>
    <div class="body container">
        <div class="row">
            <div class="col-sm-12 col-md-5 col-lg-4">
                <div class="card" style="width: 100%;">
                    <div class="card-header">
                        ค้นหาข้อมูล
                    </div>
                    <div class="card-body">
                        <form action="?">
                            <div class="mb-3">
                                <label for="bank" class="form-label">เลขที่บัญชี</label>
                                <input type="text" class="form-control" id="bank" name="bank" <?= isset($_GET['bank']) ? 'value="' . $_GET['bank'] . '"' : '' ?>>
                            </div>
                            <div class="mb-3">
                                <label for="firstname" class="form-label">ชื่อจริง</label>
                                <input type="text" class="form-control" id="firstname" name="firstname" <?= isset($_GET['firstname']) ? 'value="' . $_GET['firstname'] . '"' : '' ?>>
                            </div>
                            <div class="mb-3">
                                <label for="lastname" class="form-label">นามสกุล</label>
                                <input type="text" class="form-control" id="lastname" name="lastname" <?= isset($_GET['lastname']) ? 'value="' . $_GET['lastname'] . '"' : '' ?>>
                            </div>
                            <div class="mb-3">
                                <label for="idcard" class="form-label">เลขบัตรประชาชน</label>
                                <input type="text" class="form-control" id="idcard" name="idcard" <?= isset($_GET['idcard']) ? 'value="' . $_GET['idcard'] . '"' : '' ?>>
                            </div>
                            <button class="btn btn-primary" type="submit">ค้นหา</button>
                            <a href="<?= url('blacklist') ?>" class="btn btn-danger">ล้างข้อมูล</a>
                        </form>
                    </div>
                </div>
            </div>
            <div class="col-sm-12 col-md-7 col-lg-8">
                <table class="table table-striped table-hover align-middle nowrap" style="width:100%">
                    <thead>
                        <tr>
                            <th scope="col">ชื่อกิจการ</th>
                            <th scope="col">ผู้ขาย</th>
                            <th scope="col">สินค้า</th>
                            <th scope="col">ยอดเงินการโกง</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $result = Blacklist::find()->limit(20);
                        if (isset($_GET['bank']) and $_GET['bank'] != '') {
                            $result->where('bank_number', '=', $_GET['bank']);
                        }
                        if (isset($_GET['firstname']) and $_GET['firstname'] != '') {
                            $result->where('id_firstname', '=', $_GET['firstname']);
                        }
                        if (isset($_GET['lastname']) and $_GET['lastname'] != '') {
                            $result->where('id_lastname', '=', $_GET['lastname']);
                        }
                        if (isset($_GET['idcard']) and $_GET['idcard'] != '') {
                            $result->where('id_number', '=', $_GET['idcard']);
                        }
                        $result = $result->get();
                        if (count($result) == 0) {
                            echo '<tr><td colspan="4" class="text-center">ไม่พบข้อมูล</td></tr>';
                        }
                        for ($i = 0; $i < count($result); $i++) {
                            echo '<tr>';
                            echo '<td><a href="' . url('blacklist.' . $result[$i]['id']) . '">' . $result[$i]['name'] . '</a></td>';
                            echo '<td>' . $result[$i]['id_firstname'] . ' ' . $result[$i]['id_lastname'] . '</td>';
                            echo '<td>' . $result[$i]['item_name'] . '</td>';
                            echo '<td>' . $result[$i]['item_balance'] . '</td>';
                            echo '</tr>';
                        }
                        ?>
                    </tbody>
                    <tfoot>
                        <tr>
                            <th>ชื่อกิจการ</th>
                            <th>ผู้ขาย</th>
                            <th>สินค้า</th>
                            <th>ยอดเงินการโกง</th>
                        </tr>
                    </tfoot>
                </table>
            </div>
        </div>
    </div>
    <?= resource('cdn/front_foot.php') ?>
</body>

<?= visitor_views('layouts/footer') ?>