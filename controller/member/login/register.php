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

    // Register
    $user = strtolower($_POST['user']);
    $email = strtolower($_POST['email']);
    $password1 = $_POST['password1'];
    $password2 = $_POST['password2'];

    $data = ModelsAccount::find()->where('username', $user)->where('email', $user)->operator('OR')->getOne();
    if ($data) {
        echo Alert::alerts('ชื่อผู้ใช้งานหรืออีเมลนี้มีผู้ใช้งานแล้ว', 'warning', 1500, 'history.back()');
        exit;
    }
    if ($password1 != $password2) {
        echo AlertLogin::pass_mismatch();
        exit;
    }
    $password = password_hash($password1, PASSWORD_DEFAULT);
    $data = ModelsAccount::register([
        'username' => $user,
        'email' => $email,
        'password' => $password,
        'role' => 'user'
    ]);
    if ($data) {
        if (Account::create_verify_token($email, 'verify')) {
            echo AlertLogin::verifyEmail();
        } else {
            echo AlertLogin::unverifyEmail();
        }
    } else {
        echo Alert::alerts('ไม่สามารถลงทะเบียนได้', 'error', 1500, 'history.back()');
    }
} else {
    redirect(member_url('login'));
}
