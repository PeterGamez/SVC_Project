<?php
$site['cdn'] = ['404'];
?>
<?= admin_views('layouts.header') ?>

<body>
    <div id="wrapper">
        <?= admin_views('layouts.sidebar') ?>
        <div id="content-wrapper" class="d-flex flex-column">
            <div id="content">
                <?= admin_views('layouts.topbar') ?>
                <div class="container-fluid">
                    <div class="text-center">
                        <div class="error mx-auto" data-text="404">404</div>
                        <span class="lead text-gray-800 mb-5">Page Not Found</span>
                        <div class="btn btn-primary" onclick="window.history.back()">ย้อนกลับ</div>
                    </div>
                </div>
            </div>
            <?= admin_views('layouts.footer') ?>
        </div>
    </div>
    <?= resource('cdn/back_foot.php') ?>
</body>