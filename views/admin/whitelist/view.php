<?= admin_views('layouts.header') ?>

<body id="page-top">
    <div id="wrapper">
        <?= admin_views('layouts.sidebar') ?>
        <div id="content-wrapper" class="d-flex flex-column">
            <div id="content">
                <?= admin_views('layouts.topbar') ?>
                <div class="container-fluid">
                    <?php
                    $result = Whitelist::findOne(['id' => $request['id']]);
                    ?>
                    <?= json_encode($result, JSON_PRETTY_PRINT) ?>
                </div>
            </div>
            <?= admin_views('layouts.footer') ?>
        </div>
    </div>
    <?= resource('cdn/back_foot.php') ?>
</body>