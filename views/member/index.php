<?php

use App\Models\Account;
use App\Models\Approve;
use App\Models\Blacklist;
use App\Models\Whitelist;

?>

<?= views('template/back/header') ?>

<body>
    <div id="wrapper">
        <?= member_views('layouts.sidebar') ?>
        <div id="content-wrapper" class="d-flex flex-column">
            <div id="content">
                <?= member_views('layouts.topbar') ?>
                <div class="container-fluid">
                    <div class="d-sm-flex align-items-center justify-content-between mb-4">
                        <h1 class="h3 mb-0 text-gray-800">Welcome <?= $_SESSION["user_username"] ?></h1>
                    </div>
                    <?php
                    $approve = Approve::find()->where('id', 2)->getOne();
                    echo '<div class="row">';
                    show([
                        'title' => "Account (ทั้งหมด)",
                        'count' => Account::count(),
                        'theme' => 'primary',
                        'icon' => 'fa-sharp fa-light fa-users',
                    ]);
                    show([
                        'title' => "Whitelist (" . $approve['name'] . ")",
                        'count' => Whitelist::count(['approve_id' => 2]),
                        'theme' => $approve['color'],
                        'icon' => $approve['icon'],
                    ]);
                    show([
                        'title' => "Blacklist (" . $approve['name'] . ")",
                        'count' => Blacklist::count(['approve_id' => 2]),
                        'theme' => $approve['color'],
                        'icon' => $approve['icon'],
                    ]);
                    echo '</div>';
                    ?>
                </div>
                <?= views('template/back/footer') ?>
            </div>
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