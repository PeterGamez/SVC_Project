<?= admin_views('layouts.header') ?>

<body id="page-top">
    <div id="wrapper">
        <?= admin_views('layouts.sidebar') ?>
        <div id="content-wrapper" class="d-flex flex-column">
            <div id="content">
                <?= admin_views('layouts.topbar') ?>
                <div class="container-fluid">
                    <h1 class="h3 mb-4 text-gray-800">Blank Page</h1>
                </div>
            </div>
            <?= admin_views('layouts.footer') ?>
        </div>
    </div>
    <?= resource('cdn/back_foot.php') ?>
</body>