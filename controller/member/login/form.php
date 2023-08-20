<?php

use App\Class\Account;
use App\Class\Alert;
use App\Class\AlertLogin;
use App\Class\App;
use App\Models\Account as ModelsAccount;

$cf_turnstile_path = 'https://challenges.cloudflare.com/turnstile/v0/siteverify';

if (isset($_POST['user'])) {
    $captcha = App::Captcha($_POST['cf-turnstile-response']);
    if ($captcha == false) {
        exit;
    }

    // Login
    $user = strtolower($_POST['user']);
    $password = $_POST['password'];

    $data = ModelsAccount::find()->where('username', $user)->where('email', $user)->operator('OR')->getOne();
    if ($data) {
        if (!password_verify($password, $data['password'])) {
            echo AlertLogin::pass_mismatch();
            exit;
        }
        if ($data['email_verified'] == 0) {
            if (Account::create_verify_token($data['email'], 'verify') == true) {
                echo AlertLogin::verifyEmail();
            } else {
                echo AlertLogin::reverifyEmail();
            }
            exit;
        }
        
        Account::set_session($data);
        ModelsAccount::login($data['id']);

        echo AlertLogin::succeed();
    } else {
        echo Alert::alerts('ไม่พบชื่อผู้ใช้งาน', 'warning', 1500, 'history.back()');
    }
} else {
    redirect(member_url('login'));
}
