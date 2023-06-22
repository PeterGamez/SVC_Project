<?= views('layouts.back_header') ?>

<body>
    <div id="wrapper">
        <?= member_views('layouts.sidebar') ?>
        <div id="content-wrapper" class="d-flex flex-column">
            <div id="content">
                <?= member_views('layouts.topbar') ?>
                <div class="container-fluid">

                </div>
            </div>
        </div>
    </div>
    <?= resource('cdn/back_foot.php') ?>
</body>