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
                            <h1 class="h4 text-gray-900 mb-4">Register</h1>
                        </div>
                        <form class="user" method="POST" action="<?= url() ?>">
                            <div class="mb-3">
                                <input type="text" class="form-control form-control-user" name="user" placeholder="Username" required pattern="a-zA-Z0-9_" minlength="5" maxlength="20">
                            </div>
                            <div class="mb-3">
                                <input type="email" class="form-control form-control-user" name="email" placeholder="Email" required>
                            </div>
                            <div class="mb-3">
                                <input type="password" class="form-control form-control-user" name="password1" placeholder="Password" required minlength="8">
                            </div>
                            <div class="mb-3">
                                <input type="password" class="form-control form-control-user" name="password2" placeholder="Confirm Password" required minlength="8">
                            </div>
                            <div class="mb-3 form-check">
                                <input type="checkbox" class="form-check-input" name="agree" id="agree" required>
                                <label class="form-check-label" for="agree">I agree to the <a href="<?= url('tos') ?>">Terms of Service</a></label>
                            </div>
                            <div class="mb-3 d-flex justify-content-center">
                                <div class="cf-turnstile" data-sitekey="<?= config('site.cloudflare.turnstile.key') ?>"></div>
                            </div>
                            <button type="submit" class="btn btn-primary btn-user btn-block"> Register </button>
                            <div class="mt-2 text-center">
                                <a class="small" href="<?= member_url('login') ?>">Already have an account? Login!</a>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <?= views('template/back/footer') ?>
</body>