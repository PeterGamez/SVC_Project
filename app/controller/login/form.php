<?php

use App\Class\Account as ClassAccount;
use App\Class\Alert_Login;
use App\Class\App;
use App\Models\Account;

$cf_turnstile_path = 'https://challenges.cloudflare.com/turnstile/v0/siteverify';

if (isset($_POST['user'])) {
    $captcha = App::Captcha($_POST['cf-turnstile-response']);
    if ($captcha == false) {
        exit;
    }

    // Login
    $user = strtolower($_POST['user']);
    $password = $_POST['password'];

    $data = Account::findOne(['username' => $user, 'email' => $user], 'OR');
    if ($data) {
        if (!password_verify($password, $data['password'])) {
            echo Alert_Login::pass_mismatch();
            exit;
        }
        // if ($data['email_verifed'] == 0) {
        //     echo Alert_Login::verifyEmail();
        //     exit;
        // }
        ClassAccount::set_session($data);

        echo Alert_Login::succeed();
    } else {
        echo Alert_Login::alert('ไม่พบชื่อผู้ใช้งาน', 'warning', 1500, 'history.back()');
    }
} else {
    redirect(member_url('login'));
}
