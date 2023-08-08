<?php
$site['cdn'] = ['login'];
?>
<?= views('template/back/header') ?>

<body>
    <div class="container">
        <div class="row justify-content-center">
            <div class="card card-40 o-hidden border-0 shadow-lg my-5">
                <div class="card-body p-0">
                    <div class="p-5">
                        <a href="<?= url('/') ?>"><i class="fas fa-arrow-left"></i></a>
                        <div class="text-center">
                            <h1 class="h4 text-gray-900 mb-4">Login</h1>
                        </div>
                        <form class="user" method="POST" action="<?= member_url('login.callback.form') ?>">
                            <div class="form-group">
                                <input type="text" class="form-control form-control-user" name="user" placeholder="Username or Email">
                            </div>
                            <div class="form-group">
                                <input type="password" class="form-control form-control-user" name="password" placeholder="Password">
                            </div>
                            <div class="form-group d-flex justify-content-center">
                                <div class="cf-turnstile" data-sitekey="<?= config('site.cloudflare.turnstile.key') ?>"></div>
                            </div>
                            <button type="submit" class="btn btn-primary btn-user btn-block"> Login </button>
                            <div class="mt-2 text-center">
                                <a class="small" href="<?= member_url('register') ?>">Create an Account!</a>
                            </div>
                            <hr class="my-4">
                            <div class="d-flex justify-content-center">
                                <div id="g_id_onload" data-client_id="<?= config('site.google.id') ?>" data-context="signin" data-ux_mode="redirect" data-login_uri="<?= config('site.google.callback') ?>" data-auto_prompt="false">
                                </div>
                                <div class="g_id_signin" data-type="standard" data-shape="pill" data-theme="outline" data-text="continue_with" data-size="large" data-logo_alignment="center">
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
   <?= views('template/back/footer') ?>
</body>