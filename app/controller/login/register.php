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
                if (ClassAccount::create_verify_token($email)) {
                    echo Alert_Login::verifyEmail();
                } else {
                    echo Alert_Login::alert('ไม่สามารถส่งอีเมลยืนยันได้', 'error', 1500, 'window.location.href="' . member_url('login') . '"');
                }
            } else {
                echo Alert_Login::alert('ไม่สามารถลงทะเบียนได้', 'error', 1500, 'history.back()');
            }
        }
    }
} else {
    redirect(member_url('login'));
}
