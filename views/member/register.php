<?php
$site['cdn'] = ['login'];
?>
<?= views('layouts.back_header') ?>

<body>
    <div class="container">
        <div class="row justify-content-center">
            <div class="card o-hidden border-0 shadow-lg my-5" style="width:40rem">
                <div class="card-body p-0">
                    <div class="p-5">
                        <a href="<?= url('/') ?>"><i class="fas fa-arrow-left"></i></a>
                        <div class="text-center">
                            <h1 class="h4 text-gray-900 mb-4"><?= config('site.name') ?></h1>
                        </div>
                        <form class="user" method="POST" action="<?= url() ?>">
                            <div class="form-group">
                                <input type="text" class="form-control form-control-user" name="user" placeholder="Username">
                            </div>
                            <div class="form-group">
                                <input type="email" class="form-control form-control-user" name="email" placeholder="Email">
                            </div>
                            <div class="form-group">
                                <input type="password" class="form-control form-control-user" name="password1" placeholder="Password">
                            </div>
                            <div class="form-group">
                                <input type="password" class="form-control form-control-user" name="password2" placeholder="Confirm Password">
                            </div>
                            <div class="form-group d-flex justify-content-center">
                                <div class="cf-turnstile" data-sitekey="<?= config('site.cloudflare.turnstile.key') ?>"></div>
                            </div>
                            <button type="submit" class="btn btn-primary btn-user btn-block"> Register </button>
                            <hr class="my-4">
                            <div class="text-center">
                                <a class="small" href="<?= member_url('login') ?>">Already have an account? Login!</a>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <?= views('layouts.back_footer') ?>
</body>