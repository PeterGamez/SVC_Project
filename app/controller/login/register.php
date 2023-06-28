<?php

use App\Class\Alert_Login;
use App\Class\App;
use App\Models\Account;

$cf_turnstile_path = 'https://challenges.cloudflare.com/turnstile/v0/siteverify';

if (isset($_POST['user'])) {
    // Captcha
    $captcha = $_POST['cf-turnstile-response'];
    if (!$captcha) {
        echo Alert_Login::alert('กรุณายืนยันตัวตนด้วย Captcha', 'warning', 1500, 'history.back()');
        exit;
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
        exit;
    }

    // Register
    $user = strtolower($_POST['user']);
    $email = strtolower($_POST['email']);
    $password1 = $_POST['password1'];
    $password2 = $_POST['password2'];

    $data = Account::findOne(['username' => $user, 'email' => $user], 'OR');
    if ($data) {
        echo Alert_Login::alert('ชื่อผู้ใช้งานหรืออีเมลนี้มีผู้ใช้งานแล้ว', 'warning', 1500, 'history.back()');
    } else {
        if ($password1 != $password2) {
            echo Alert_Login::pass_mismatch();
        } else {
            $password = password_hash($password1, PASSWORD_DEFAULT);
            $data = Account::register([
                'username' => $user,
                'email' => $email,
                'password' => $password,
                'role' => 'user'
            ]);
            if ($data) {
                $_SESSION['callback'] = member_url('login');
                echo Alert_Login::succeed();
            } else {
                echo Alert_Login::alert('ไม่สามารถลงทะเบียนได้', 'error', 1500, 'history.back()');
            }
        }
    }
} else {
    redirect(admin_url('login'));
}
