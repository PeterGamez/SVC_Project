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
                            <a href="<?= admin_url('bank.add') ?>" class="btn btn-primary">เพิ่มธนาคาร</a>
                        </div>
                    </div>
                    <div class="table-responsive">
                        <table id="table_bank" class="dt-responsive nowrap table table-striped table-hover align-middle">
                            <thead>
                                <tr>
                                    <th scope="col">#</th>
                                    <th scope="col">ธนาคาร</th>
                                    <th scope="col">&nbsp</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                $result = Bank::find();
                                for ($i = 0; $i < count($result); $i++) {
                                    echo '<tr>';
                                    echo '<th scope="row">' . $result[$i]['id'] . '</th>';
                                    echo '<td>' . '<img href=">' . $resule[$i]['image'] . '" style="width: 50px">' . ' ' . $result[$i]['name'] . '</td>';
                                    echo '<td><a href="' . admin_url('bank.' . $result[$i]['id']) . '.edit" class="btn btn-sm btn-primary">แก้ไข</a></td>';
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
        $('#table_bank').DataTable({
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