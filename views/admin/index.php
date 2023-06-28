<?php

use App\Models\Account;
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
                        ], [
                            'title' => "Whitelist (Approve)",
                            'count' => Whitelist::count(['approve_agree' => '1']),
                            'theme' => 'success',
                            'icon' => 'fa-sharp fa-light fa-shield-check',
                        ], [
                            'title' => "Whitelist (DisApprove)",
                            'count' =>  Whitelist::count(['approve_agree' => '0']),
                            'theme' => 'danger',
                            'icon' => 'fa-sharp fa-light fa-shield-xmark',
                        ], [
                            'title' => "Blacklist (Approve)",
                            'count' => Blacklist::count(['approve_agree' => '1']),
                            'theme' => 'success',
                            'icon' => 'fa-solid fa-circle-check',
                        ], [
                            'title' => "Blacklist (DisApprove)",
                            'count' => Blacklist::count(['approve_agree' => '0']),
                            'theme' => 'danger',
                            'icon' => 'fa-solid fa-circle-xmark',
                        ]
                    );

                    for ($i = 0; $i < count($item); $i++) {
                        if ($i == 0) {
                            echo '<div class="row">';
                        }
                    ?>
                        <div class="col-xl-3 col-md-6 mb-4">
                            <div class="card border-left-<?= $item[$i]['theme'] ?> shadow h-100 py-2">
                                <div class="card-body">
                                    <div class="row no-gutters align-items-center">
                                        <div class="col mr-2">
                                            <div class="text-xs font-weight-bold text-<?= $item[$i]['theme'] ?> mb-1"><?= $item[$i]['title'] ?></div>
                                            <div class="h5 mb-0 font-weight-bold text-gray-800"><?= $item[$i]['count'] ?></div>
                                        </div>
                                        <div class="col-auto">
                                            <i class="<?= $item[$i]['icon'] ?> fa-2x text-gray-300"></i>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    <?php
                        if ($i == count($item) - 1) {
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