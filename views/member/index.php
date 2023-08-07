<?= views('template/back/header') ?>

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
                </div>
               <?= views('template/back/footer') ?>
            </div>
        </div>
    </div>
    <?= views('template/back/cdn_footer') ?>
</body>