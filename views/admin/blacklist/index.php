<?php

use App\Models\Blacklist;

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
                            <a href="<?= admin_url('blacklist.add') ?>" class="btn btn-primary">เพิ่มกิจการ</a>
                        </div>
                    </div>
                    <div class="table-responsive">
                        <table id="table_blacklist" class="dt-responsive nowrap table table-striped table-hover align-middle" style="width:100%">
                            <thead>
                                <tr>
                                    <th scope="col">#</th>
                                    <th scope="col">ชื่อกิจการ</th>
                                    <th scope="col">ผู้ขาย</th>
                                    <th scope="col">สถานะ</th>
                                    <th scope="col">&nbsp</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                if (isset($_GET['s'])) {
                                    $result = Blacklist::find()
                                        ->select(
                                            'blacklist.*',
                                            'approve.name as approve_name'
                                        )
                                        ->join('approve', 'id', 'approve_id')
                                        ->where('blacklist.approve_id', $_GET['s'])
                                        ->get();
                                } else {
                                    $result = Blacklist::find()
                                        ->select(
                                            'blacklist.*',
                                            'approve.name as approve_name'
                                        )
                                        ->join('approve', 'id', 'approve_id')
                                        ->get();
                                }
                                for ($i = 0; $i < count($result); $i++) {
                                    echo '<tr>';
                                    echo '<th scope="row">' . $result[$i]['id'] . '</th>';
                                    echo '<td>' . $result[$i]['name'] . '</td>';
                                    echo '<td>' . $result[$i]['id_firstname'] . ' ' . $result[$i]['id_lastname'] . '</td>';
                                    echo '<td>' . $result[$i]['approve_name'] . '</td>';
                                    echo '<td><a href="' . admin_url('blacklist.' . $result[$i]['id']) . '" class="btn btn-sm btn-primary">ตรวจสอบ</a></td>';
                                    echo '</tr>';
                                }
                                ?>
                            </tbody>
                            <tfoot>
                                <tr>
                                    <th>#</th>
                                    <th>ชื่อกิจการ</th>
                                    <th>ผู้ขาย</th>
                                    <th>สถานะ</th>
                                    <th>&nbsp</th>
                                </tr>
                            </tfoot>
                        </table>
                    </div>
                </div>
            </div>
            <?= views('template/back/footer') ?>
        </div>
    </div>
    <?= views('template/back/cdn_footer') ?>
    <script>
        $('#table_blacklist').DataTable({
            scrollX: false,
            scrollY: false,
            columnDefs: [{
                targets: -1,
                searchable: false,
                orderable: false
            }, ],
            language: {
                url: "<?= resource('datatables/th.json', true) ?>"
            }
        })
    </script>
</body>