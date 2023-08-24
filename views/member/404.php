<?php
$site['cdn'] = ['404'];
?>
<?= views('template/back/header') ?>

<body>
    <div id="wrapper">
        <?= member_views('layouts.sidebar') ?>
        <div id="content-wrapper" class="d-flex flex-column">
            <div id="content">
                <?= member_views('layouts.topbar') ?>
                <div class="container-fluid">
                    <div class="text-center">
                        <div class="error mx-auto" data-text="404">404</div>
                        <div class="lead text-gray-800 m-3">Page Not Found</div>
                        <div class="btn btn-primary" onclick="window.history.back()">ย้อนกลับ</div>
                    </div>
                </div>
            </div>
            <?= views('template/back/footer') ?>
        </div>
    </div>
    <?= views('template/back/cdn_footer') ?>
</body>