<?php

use App\Models\Approve;

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
                            <a href="<?= admin_url('approve.add') ?>" class="btn btn-primary">เพิ่มสถานะ</a>
                        </div>
                    </div>
                    <div class="table-responsive">
                        <table id="table_approve" class="dt-responsive nowrap table table-striped table-hover align-middle" style="width:100%">
                            <thead>
                                <tr>
                                    <th scope="col">#</th>
                                    <th scope="col">สถานะ</th>
                                    <th scope="col">whitelist</th>
                                    <th scope="col">blacklist</th>
                                    <th scope="col">&nbsp</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                $result = Approve::find()->get();
                                for ($i = 0; $i < count($result); $i++) {
                                    echo '<tr>';
                                    echo '<th scope="row">' . $result[$i]['id'] . '</th>';
                                    echo '<td>' . $result[$i]['name'] . '</td>';
                                    echo $result[$i]['whitelist'] == '1' ? '<td class="text-success">แสดง</td>' : '<td class="text-danger">ซ่อน</td>';
                                    echo $result[$i]['blacklist'] == '1' ? '<td class="text-success">แสดง</td>' : '<td class="text-danger">ซ่อน</td>';
                                    echo '<td><a href="' . admin_url('approve.' . $result[$i]['id'] . '.edit') . '" class="btn btn-sm btn-primary">แก้ไข</a></td>';
                                    echo '</tr>';
                                }
                                ?>
                            </tbody>
                            <tfoot>
                                <tr>
                                    <th>#</th>
                                    <th>สถานะ</th>
                                    <th>whitelist</th>
                                    <th>blacklist</th>
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
        $('#table_approve').DataTable({
            scrollX: false,
            scrollY: false,
            order: [
                [0, 'asc']
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