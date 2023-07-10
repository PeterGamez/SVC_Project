<?php

use App\Class\Alert;
use App\Models\Account;
use App\Models\EmailVerify;

if (isset($_GET['token'])) {
    $token = $_GET['token'];

    $emailVerify = EmailVerify::findToken(['token' => $token, 'verifed' => 0, 'expire_at' => date('Y-m-d H:i:s')]);

    if ($emailVerify) {
        EmailVerify::update(['id' => $emailVerify['id']], ['verifed' => 1]);
        Account::update(
            ['email' => $emailVerify['email']],
            [
                'email_verified' => 1,
                'email_verified_at' => date('Y-m-d H:i:s')
            ]
        );
        echo Alert::alerts('ยืนยันอีเมลสำเร็จ', 'success', 1500, 'window.location.href = "' . member_url('login') . '"');
    } else {
        echo Alert::alerts('ยืนยันอีเมลไม่สำเร็จ', 'error', 1500, 'window.history.href = "' . member_url('login') . '"');
    }
} else {
    redirect(member_url('login'));
}
