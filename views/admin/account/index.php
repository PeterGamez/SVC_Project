<?php
$site['cdn'] = ['datatables'];
?>
<?= admin_views('layouts.header') ?>

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
                        <table id="table_account" class="dt-responsive nowrap table table-striped table-hover align-middle">
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
                                $result = Account::find();
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
                        </table>
                    </div>
                </div>
            </div>
            <?= admin_views('layouts.footer') ?>
        </div>
    </div>
    <?= resource('cdn/back_foot.php') ?>
    <script>
        $('#table_account').DataTable({
            scrollX: false,
            scrollY: false,
            language: {
                url: "<?= resource('datatables/th.json', true) ?>"
            }
        })
    </script>
</body>