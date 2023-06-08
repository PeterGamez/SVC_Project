<?php
$site['cdn'] = ['datatables'];
?>
<?= admin_views('layouts.header') ?>

<body id="page-top">
    <div id="wrapper">
        <?= admin_views('layouts.sidebar') ?>
        <div id="content-wrapper" class="d-flex flex-column">
            <div id="content">
                <?= admin_views('layouts.topbar') ?>
                <div class="container-fluid">
                    <div class="table-responsive">
                        <table id="table_account" class="dt-responsive nowrap table table-striped table-hover align-middle">
                            <thead>
                                <tr>
                                    <th scope="col">#</th>
                                    <th scope="col">Username</th>
                                    <th scope="col">Email</th>
                                    <th scope="col">Role</th>
                                    <th scope="col">&nbsp</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                $result = Account::get_account_all();
                                for ($i = 0; $i < count($result); $i++) {
                                    echo '<tr>';
                                    echo '<th scope="row">' . $result[$i]['id'] . '</th>';
                                    echo '<td>' . $result[$i]['username'] . '</td>';
                                    echo '<td>' . $result[$i]['email'] . '</td>';
                                    echo '<td>' . $result[$i]['role'] . '</td>';
                                    echo '<td><a href="' . admin_url('account/' . $result[$i]['id']) . '" class="btn btn-primary btn-sm">View</a></td>';
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
        })
    </script>
</body>