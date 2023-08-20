<?php

use App\Models\EmailVerify;

$site['cdn'] = ['login'];

if (empty($_GET['token'])) {
    redirect(url('login'));
    exit;
}
$token = $_GET['token'];

if (!EmailVerify::findToken($token)) {
    redirect(url('login'));
    exit;
}
?>
<?= views('template/back/header') ?>

<body>
    <div class="container">
        <div class="row justify-content-center">
            <div class="card card-40 o-hidden border-0 shadow-lg my-5">
                <div class="card-body p-0">
                    <div class="p-5">
                        <div class="text-center">
                            <h1 class="h4 text-gray-900 mb-4">Register</h1>
                        </div>
                        <form class="user" method="POST" action="<?= member_url('login.callback.register-email') ?>">
                            <input type="hidden" name="token" value="<?= $token ?>">
                            <div class="form-group">
                                <input type="password" class="form-control form-control-user" name="password1" placeholder="Password" required minlength="8">
                            </div>
                            <div class="form-group">
                                <input type="password" class="form-control form-control-user" name="password2" placeholder="Confirm Password" required minlength="8">
                            </div>
                            <div class="form-group form-check">
                                <input type="checkbox" class="form-check-input" name="agree" id="agree" required>
                                <label class="form-check-label" for="agree">I agree to the <a href="<?= url('tos') ?>">Terms of Service</a></label>
                            </div>
                            <button type="submit" class="btn btn-primary btn-user btn-block"> Register </button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <?= views('template/back/footer') ?>
</body>