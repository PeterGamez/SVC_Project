<?php

use App\Class\Account as ClassAccount;
use App\Class\AlertLogin;
use App\Class\App;
use App\Models\Account;

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

    $data = Account::find()->where('username', $user)->where('email', $user)->operator('OR')->getOne();
    if ($data) {
        echo AlertLogin::alert('ชื่อผู้ใช้งานหรืออีเมลนี้มีผู้ใช้งานแล้ว', 'warning', 1500, 'history.back()');
    } else {
        if ($password1 != $password2) {
            echo AlertLogin::pass_mismatch();
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
                if (ClassAccount::create_verify_token($email)) {
                    echo AlertLogin::verifyEmail();
                } else {
                    echo AlertLogin::alert('ไม่สามารถส่งอีเมลยืนยันได้', 'error', 1500, 'window.location.href="' . member_url('login') . '"');
                }
            } else {
                echo AlertLogin::alert('ไม่สามารถลงทะเบียนได้', 'error', 1500, 'history.back()');
            }
        }
    }
} else {
    redirect(member_url('login'));
}
