<?php
$cf_turnstile_path = 'https://challenges.cloudflare.com/turnstile/v0/siteverify';

if (isset($_POST['user'])) {
    // Captcha
    $captcha = $_POST['cf-turnstile-response'];
    if (!$captcha) {
        echo Alert_Login::alert('กรุณายืนยันตัวตนด้วย Captcha', 'warning', 1500, 'history.back()');
        exit();
    }
    $ip = App::getAgentIP();

    $result = App::apiRequest($cf_turnstile_path, array(
        'secret' => config('site.cloudflare.turnstile.secret'),
        'response' => $captcha,
        'remoteip' => $ip['ip']
    ));

    if ($result->success == false) {
        if ($result->{'error-codes'}[0] == 'missing-input-secret' || $result->{'error-codes'}[0] == 'invalid-input-response') {
            echo Alert_Login::contact();
        } else {
            echo Alert_Login::alert('ยืนยันตัวตนไม่สำเร็จ ' . $result->{'error-codes'}[0], 'error', 1500, 'history.back()');
        }
        exit();
    }

    // Login
    $user = strtolower($_POST['user']);
    $password = $_POST['password'];

    $data = Login::get_user($user);
    if ($data) {
        if (!password_verify($password, $data['password'])) {
            echo Alert_Login::pass_mismatch();
        } else {
            Login::set_session($data);

            echo Alert_Login::succeed();
        }
    } else {
        echo Alert_Login::alert('ไม่พบชื่อผู้ใช้งาน', 'warning', 1500, 'history.back()');
    }
} else {
    redirect(admin_url('login'));
}
