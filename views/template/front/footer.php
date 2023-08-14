<footer class="sticky-footer bg-light text-center text-lg-start">
    <div class="container">
        <hr>
        <div class="row">
            <div class="col-sm-12 col-lg-10">
                <div class="text-center p-2">
                    <span class="text-dark">
                        Copyright © 2022-2023 <a href="<?= url('/') ?>"><?= config('site.name') ?></a>. All rights reserved
                    </span>
                </div>
                <div class="text-center p-2">
                    <span class="text-dark">
                        <a href="<?= url('privacy') ?>">Privacy Policy</a> | <a href="<?= url('tos') ?>">Terms of Service</a>
                    </span>
                </div>
            </div>
            <div class="col-sm-12 col-lg-2">
                <div class="text-center p-2">
                    <a href="<?= url('download.android') ?>"><img src="<?= resource('images/get-googleplay.png', true) ?>" alt="apk download" width="150px"></a>
                </div>
            </div>
        </div>
        <hr>
    </div>
</footer>