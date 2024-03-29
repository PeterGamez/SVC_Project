<?php

use App\Models\Account;

$site['cdn'] = ['datatables'];
?>

<?= views('template/back/header') ?>

<body>
    <div id="wrapper">
        <?= admin_views('layouts.sidebar') ?>
        <div id="content-wrapper" class="d-flex flex-column">
            <div id="content">
                <?= admin_views('layouts.topbar') ?>
                <div class="container-fluid">
                    <div class="d-flex">
                        <div class="p-2">
                            <a href="<?= admin_url('account.add') ?>" class="btn btn-primary">เพิ่มบัญชี</a>
                        </div>
                    </div>
                    <div class="table-responsive">
                        <table id="table_account" class="dt-responsive nowrap table table-striped table-hover align-middle" style="width:100%">
                            <thead>
                                <tr>
                                    <th scope="col">#</th>
                                    <th scope="col">ชื่อผู้ใช้งาน</th>
                                    <th scope="col">อีเมล</th>
                                    <th scope="col">สิทธิ์การใช้งาน</th>
                                    <th scope="col">&nbsp</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                $result = Account::find()->get();
                                for ($i = 0; $i < count($result); $i++) {
                                    echo '<tr>';
                                    echo '<th scope="row">' . $result[$i]['id'] . '</th>';
                                    echo '<td>' . $result[$i]['username'] . '</td>';
                                    echo '<td>' . $result[$i]['email'] . '</td>';
                                    echo '<td>' . $result[$i]['role'] . '</td>';
                                    echo '<td><a href="' . admin_url('account/' . $result[$i]['id']) . '" class="btn btn-sm btn-primary">ตรวจสอบ</a></td>';
                                    echo '</tr>';
                                }
                                ?>
                            </tbody>
                            <tfoot>
                                <tr>
                                    <th>#</th>
                                    <th>ชื่อผู้ใช้งาน</th>
                                    <th>อีเมล</th>
                                    <th>สิทธิ์การใช้งาน</th>
                                    <th>&nbsp</th>
                                </tr>
                        </table>
                    </div>
                </div>
            </div>
            <?= views('template/back/footer') ?>
        </div>
    </div>
    <?= views('template/back/cdn_footer') ?>
    <script>
        $('#table_account').DataTable({
            scrollX: false,
            scrollY: false,
            columnDefs: [{
                targets: -1,
                searchable: false,
                orderable: false
            }, ],
            language: {
                url: "<?= config('site.cdn.path') ?>/json/datatables-th.json"
            }
        })
    </script>
</body>