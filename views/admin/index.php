<?php

use App\Models\Account;
use App\Models\Approve;
use App\Models\Whitelist;
use App\Models\Blacklist;
use App\Models\WhitelistWaiting;

?>

<?= views('template/back/header') ?>

<body>
    <div id="wrapper">
        <?= admin_views('layouts.sidebar') ?>
        <div id="content-wrapper" class="d-flex flex-column">
            <div id="content">
                <?= admin_views('layouts.topbar') ?>
                <div class="container-fluid">
                    <div class="d-sm-flex align-items-center justify-content-between mb-4">
                        <h1 class="h3 mb-0 text-gray-800">Welcome <?= $_SESSION["user_username"] ?></h1>
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
                            'count' => Account::count(['role' => ['superadmin', 'admin', 'staff']]),
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

                    $whitelist = Approve::find()
                        ->where('whitelist', 1)
                        ->get();
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
                        if ($i == count($whitelist) - 1) {
                            echo '</div>';
                        }
                    }

                    $whitelist_waiting = Approve::find()
                        ->where('whitelist_waiting', 1)
                        ->get();
                    for ($i = 0; $i < count($whitelist_waiting); $i++) {
                        if ($i == 0) {
                            echo '<div class="row">';
                        }
                        show([
                            'title' => "Whitelist Waiting (" . $whitelist_waiting[$i]['name'] . ")",
                            'count' => WhitelistWaiting::count(['approve_id' => $whitelist_waiting[$i]['id']]),
                            'theme' => $whitelist_waiting[$i]['color'],
                            'icon' => $whitelist_waiting[$i]['icon'],
                        ]);
                        if ($i == count($whitelist_waiting) - 1) {
                            echo '</div>';
                        }
                    }

                    $blacklist = Approve::find()
                        ->where('blacklist', 1)
                        ->get();
                    for ($i = 0; $i < count($blacklist); $i++) {
                        if ($i == 0) {
                            echo '<div class="row">';
                        }
                        show([
                            'title' => "Blacklist (" . $blacklist[$i]['name'] . ")",
                            'count' => Blacklist::count(['approve_id' => $blacklist[$i]['id']]),
                            'theme' => $blacklist[$i]['color'],
                            'icon' => $blacklist[$i]['icon'],
                        ]);
                        if ($i == count($blacklist) - 1) {
                            echo '</div>';
                        }
                    }
                    ?>
                </div>
            </div>
            <?= views('template/back/footer') ?>
        </div>
    </div>
    <?= views('template/back/cdn_footer') ?>
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
                        <small class="font-weight-bold text-<?= $item['theme'] ?> mb-1"><?= $item['title'] ?></small>
                        <div class="h5 font-weight-bold text-gray-800"><?= $item['count'] ?></div>
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