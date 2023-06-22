<?php
$site['cdn'] = ['404'];
?>
<?= views('layouts.back_header') ?>

<body>
    <div id="wrapper">
        <?= admin_views('layouts.sidebar') ?>
        <div id="content-wrapper" class="d-flex flex-column">
            <div id="content">
                <?= admin_views('layouts.topbar') ?>
                <div class="container-fluid">
                    <div class="text-center">
                        <div class="error mx-auto" data-text="404">404</div>
                        <div class="lead text-gray-800 m-3">Page Not Found</div>
                        <div class="btn btn-primary" onclick="window.history.back()">ย้อนกลับ</div>
                    </div>
                </div>
            </div>
            <?= views('layouts.back_footer') ?>
        </div>
    </div>
    <?= resource('cdn/back_foot.php') ?>
</body>