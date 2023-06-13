<?= admin_views('layouts.header') ?>

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
                            'icon' => 'fas fa-calendar fa-2x text-gray-300',
                        ], [
                            'title' => "Account (Superadmin, Admin, Staff)",
                            'count' => Account::count(['role' => ['superadmin',  'admin',  'staff']], 'OR'),
                            'theme' => 'primary',
                            'icon' => 'fas fa-calendar fa-2x text-gray-300',
                        ], [
                            'title' => "Account (Seller)",
                            'count' => Account::count(['role' => 'seller']),
                            'theme' => 'primary',
                            'icon' => 'fas fa-calendar fa-2x text-gray-300',
                        ], [
                            'title' => "Account (User)",
                            'count' => Account::count(['role' => 'user']),
                            'theme' => 'primary',
                            'icon' => 'fas fa-calendar fa-2x text-gray-300',
                        ], [
                            'title' => "Whitelist (Approve)",
                            'count' => Whitelist::count(['approve_agree' => '1']),
                            'theme' => 'primary',
                            'icon' => 'fas fa-calendar fa-2x text-gray-300',
                        ], [
                            'title' => "Whitelist (DisApprove)",
                            'count' =>  Whitelist::count(['approve_agree' => '0']),
                            'theme' => 'primary',
                            'icon' => 'fas fa-calendar fa-2x text-gray-300',
                        ], [
                            'title' => "Blacklist (Approve)",
                            'count' => Blacklist::count(['approve_agree' => '1']),
                            'theme' => 'primary',
                            'icon' => 'fas fa-calendar fa-2x text-gray-300',
                        ], [
                            'title' => "Blacklist (DisApprove)",
                            'count' => Blacklist::count(['approve_agree' => '0']),
                            'theme' => 'primary',
                            'icon' => 'fas fa-calendar fa-2x text-gray-300',
                        ]
                    );

                    for ($i = 0; $i < count($item); $i++) {
                        if ($i == 0) {
                            echo '<div class="row">';
                        }
                    ?>
                        <div class="col-xl-3 col-md-6 mb-4">
                            <div class="card border-left-<?= $item['theme'] ?> shadow h-100 py-2">
                                <div class="card-body">
                                    <div class="row no-gutters align-items-center">
                                        <div class="col mr-2">
                                            <div class="text-xs font-weight-bold text-<?= $item[$i]['theme'] ?> mb-1"><?= $item[$i]['title'] ?></div>
                                            <div class="h5 mb-0 font-weight-bold text-gray-800"><?= $item[$i]['count'] ?></div>
                                        </div>
                                        <div class="col-auto">
                                            <i class="<?= $item[$i]['icon'] ?>"></i>
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

                    <div class="row">
                        <div class="col-xl-8 col-lg-7">
                            <div class="card shadow mb-4">
                                <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                                    <h6 class="m-0 font-weight-bold text-primary">Earnings Overview</h6>
                                    <div class="dropdown no-arrow">
                                        <a class="dropdown-toggle" href="#" role="button" id="dropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                            <i class="fas fa-ellipsis-v fa-sm fa-fw text-gray-400"></i>
                                        </a>
                                        <div class="dropdown-menu dropdown-menu-right shadow animated--fade-in" aria-labelledby="dropdownMenuLink">
                                            <div class="dropdown-header">Dropdown Header:</div>
                                            <a class="dropdown-item" href="#">Action</a>
                                            <a class="dropdown-item" href="#">Another action</a>
                                            <div class="dropdown-divider"></div>
                                            <a class="dropdown-item" href="#">Something else here</a>
                                        </div>
                                    </div>
                                </div>
                                <div class="card-body">
                                    <div class="chart-area">
                                        <canvas id="myAreaChart"></canvas>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="col-xl-4 col-lg-5">
                            <div class="card shadow mb-4">
                                <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                                    <h6 class="m-0 font-weight-bold text-primary">Revenue Sources</h6>
                                    <div class="dropdown no-arrow">
                                        <a class="dropdown-toggle" href="#" role="button" id="dropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                            <i class="fas fa-ellipsis-v fa-sm fa-fw text-gray-400"></i>
                                        </a>
                                        <div class="dropdown-menu dropdown-menu-right shadow animated--fade-in" aria-labelledby="dropdownMenuLink">
                                            <div class="dropdown-header">Dropdown Header:</div>
                                            <a class="dropdown-item" href="#">Action</a>
                                            <a class="dropdown-item" href="#">Another action</a>
                                            <div class="dropdown-divider"></div>
                                            <a class="dropdown-item" href="#">Something else here</a>
                                        </div>
                                    </div>
                                </div>
                                <div class="card-body">
                                    <div class="chart-pie pt-4 pb-2">
                                        <canvas id="myPieChart"></canvas>
                                    </div>
                                    <div class="mt-4 text-center small">
                                        <span class="mr-2">
                                            <i class="fas fa-circle text-primary"></i> Direct
                                        </span>
                                        <span class="mr-2">
                                            <i class="fas fa-circle text-success"></i> Social
                                        </span>
                                        <span class="mr-2">
                                            <i class="fas fa-circle text-info"></i> Referral
                                        </span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <?= admin_views('layouts.footer') ?>
            </div>
        </div>
    </div>
    <?= resource('cdn/back_foot.php') ?>
</body>