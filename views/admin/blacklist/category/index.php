<?php

use App\Models\BlacklistCategory;

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
                            <a href="<?= admin_url('blacklist.category.add') ?>" class="btn btn-primary">เพิ่มประเภทกิจการ</a>
                        </div>
                    </div>
                    <div class="table-responsive">
                        <table id="table_blacklist_category" class="dt-responsive nowrap table table-striped table-hover align-middle">
                            <thead>
                                <tr>
                                    <th scope="col">#</th>
                                    <th scope="col">ประเภทกิจการ</th>
                                    <th scope="col">&nbsp</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                $result = BlacklistCategory::find()->get();
                                for ($i = 0; $i < count($result); $i++) {
                                    echo '<tr>';
                                    echo '<th scope="row">' . $result[$i]['id'] . '</th>';
                                    echo '<td>' . $result[$i]['name'] . '</td>';
                                    echo '<td><a href="' . admin_url('blacklist.category.' . $result[$i]['id'] . '.edit') . '" class="btn btn-sm btn-primary">แก้ไข</a></td>';
                                    echo '</tr>';
                                }
                                ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
           <?= views('template/back/footer') ?>
        </div>
    </div>
    <?= views('template/back/cdn_footer') ?>
    <script>
        $('#table_blacklist_category').DataTable({
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