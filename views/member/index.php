<?= views('layouts.back_header') ?>

<body>
    <div id="wrapper">
        <?= member_views('layouts.sidebar') ?>
        <div id="content-wrapper" class="d-flex flex-column">
            <div id="content">
                <?= member_views('layouts.topbar') ?>
                <div class="container-fluid">
                    <div class="d-sm-flex align-items-center justify-content-between mb-4">
                        <h1 class="h3 mb-0 text-gray-800">Dashboard</h1>
                    </div>
                    <strong>ยินดีต้อนรับ!</strong> คุณ <?= $_SESSION['user_username'] ?> สวัสดีครับ ยินดีต้อนรับสู่ <?= config('site.name') ?> ครับ
                    <?= views('layouts.back_footer') ?>
                </div>
            </div>
        </div>
    </div>
    <?= resource('cdn/back_foot.php') ?>
</body>