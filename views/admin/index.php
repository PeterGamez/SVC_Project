<?php

use App\Models\Account;
use App\Models\Approve;
use App\Models\Whitelist;
use App\Models\Blacklist;
?>

<?= views('layouts.back_header') ?>

<body>
    <div id="wrapper">
        <?= admin_views('layouts.sidebar') ?>
        <div id="content-wrapper" class="d-flex flex-column">
            <div id="content">
                <?= admin_views('layouts.topbar') ?>
                <div class="container-fluid">
                    <div class="d-sm-flex align-items-center justify-content-between mb-4">
                        <h1 class="h3 mb-0 text-gray-800">Dashboard</h1>
                    </div>

                    <?php
                    $item = array(
                        [
                            'title' => "Account (All)",
                            'count' => Account::count(),
                            'theme' => 'primary',
                            'icon' => 'fa-sharp fa-light fa-users',
                        ], [
                            'title' => "Account (Superadmin, Admin, Staff)",
                            'count' => Account::count(['role' => ['superadmin',  'admin',  'staff']]),
                            'theme' => 'primary',
                            'icon' => 'fa-sharp fa-light fa-square-terminal',
                        ], [
                            'title' => "Account (Seller)",
                            'count' => Account::count(['role' => 'seller']),
                            'theme' => 'primary',
                            'icon' => 'fa-sharp fa-light fa-shop',
                        ], [
                            'title' => "Account (User)",
                            'count' => Account::count(['role' => 'user']),
                            'theme' => 'primary',
                            'icon' => 'fa-light fa-user',
                        ],
                    );

                    for ($i = 0; $i < count($item); $i++) {
                        if ($i == 0) {
                            echo '<div class="row">';
                        }
                        show($item[$i]);
                        if ($i == count($item) - 1) {
                            echo '</div>';
                        }
                    }

                    $approve = Approve::find();
                    $whitelist = array_filter($approve, function ($item) {
                        return $item['whitelist'] == 1;
                    });

                    for ($i = 0; $i < count($whitelist); $i++) {
                        if ($i == 0) {
                            echo '<div class="row">';
                        }
                        show([
                            'title' => "Whitelist (" . $whitelist[$i]['name'] . ")",
                            'count' => Whitelist::count(['approve_id' => $whitelist[$i]['id']]),
                            'theme' => $whitelist[$i]['color'],
                            'icon' => $whitelist[$i]['icon'],
                        ]);
                        if ($i == count($approve) - 1) {
                            echo '</div>';
                        }
                    }

                    $blacklist = array_filter($approve, function ($item) {
                        return $item['blacklist'] == 1;
                    });
                    for ($i = 0; $i < count($blacklist); $i++) {
                        if ($i == 0) {
                            echo '<div class="row">';
                        }
                        show([
                            'title' => "Whitelist (" . $blacklist[$i]['name'] . ")",
                            'count' => Blacklist::count(['approve_id' => $blacklist[$i]['id']]),
                            'theme' => $blacklist[$i]['color'],
                            'icon' => $whitelist[$i]['icon'],
                        ]);
                        if ($i == count($approve) - 1) {
                            echo '</div>';
                        }
                    }
                    ?>
                </div>
            </div>
            <?= views('layouts.back_footer') ?>
        </div>
    </div>
    <?= resource('cdn/back_foot.php') ?>
</body>
<?php
function show($item)
{
?>
    <div class="col-xl-3 col-md-6 mb-4">
        <div class="card border-left-<?= $item['theme'] ?> shadow h-100 py-2">
            <div class="card-body">
                <div class="row no-gutters align-items-center">
                    <div class="col mr-2">
                        <div class="text-xs font-weight-bold text-<?= $item['theme'] ?> mb-1"><?= $item['title'] ?></div>
                        <div class="h5 mb-0 font-weight-bold text-gray-800"><?= $item['count'] ?></div>
                    </div>
                    <div class="col-auto">
                        <i class="<?= $item['icon'] ?> fa-2x text-gray-300"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>
<?php
}
?>