<?php

use App\Models\Whitelist;

$site['cdn'] = ['datatables'];
?>

<?= views('layouts.back_header') ?>

<body>
    <div id="wrapper">
        <?= admin_views('layouts.sidebar') ?>
        <div id="content-wrapper" class="d-flex flex-column">
            <div id="content">
                <?= admin_views('layouts.topbar') ?>
                <div class="container-fluid">
                    <div class="d-flex">
                        <div class="p-2">
                            <a href="<?= admin_url('whitelist.add') ?>" class="btn btn-primary">เพิ่มกิจการ</a>
                        </div>
                    </div>
                    <div class="table-responsive">
                        <table id="table_whitelist" class="dt-responsive nowrap table table-striped table-hover align-middle" style="width:100%">
                            <thead>
                                <tr>
                                    <th scope="col">#</th>
                                    <th scope="col">ชื่อกิจการ</th>
                                    <th scope="col">เจ้าของกิจการ</th>
                                    <th scope="col">สถานะ</th>
                                    <th scope="col">&nbsp</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                $result = Whitelist::find()
                                    ->select(
                                        'whitelist.*',
                                        'approve.name as approve'
                                    )
                                    ->join('approve', 'approve.id', '=', 'whitelist.approve_id')
                                    ->get();
                                for ($i = 0; $i < count($result); $i++) {
                                    echo '<tr>';
                                    echo '<th scope="row">' . $result[$i]['id'] . '</th>';
                                    echo '<td>' . $result[$i]['name'] . '</td>';
                                    echo '<td>' . $result[$i]['id_firstname'] . ' ' . $result[$i]['id_lastname'] . '</td>';
                                    echo '<td>' . $result[$i]['approve'] . '</td>';
                                    echo '<td><a href="' . admin_url('whitelist.' . $result[$i]['id']) . '" class="btn btn-sm btn-primary">ตรวจสอบ</a></td>';
                                    echo '</tr>';
                                }
                                ?>
                            </tbody>
                            <tfoot>
                                <tr>
                                    <th>#</th>
                                    <th>ชื่อกิจการ</th>
                                    <th>เจ้าของกิจการ</th>
                                    <th>สถานะ</th>
                                    <th>&nbsp</th>
                                </tr>
                            </tfoot>
                        </table>
                    </div>
                </div>
            </div>
            <?= views('layouts.back_footer') ?>
        </div>
    </div>
    <?= resource('cdn/back_foot.php') ?>
    <script>
        $('#table_whitelist').DataTable({
            scrollX: false,
            scrollY: false,
            order: [
                [0, 'desc']
            ],
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