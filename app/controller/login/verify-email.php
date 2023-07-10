<?php

use App\Class\Alert;
use App\Models\EmailVerify;

if (isset($_GET['token'])) {
    $token = $_GET['token'];

    $emailVerify = EmailVerify::findToken(['token' => $token]);

    if ($emailVerify) {
        if (EmailVerify::update(['id' => $emailVerify['id']], ['verifed' => 1])) {
            echo Alert::alerts('ยืนยันอีเมลสำเร็จ', 'success', 1500, 'window.location.href = "' . url('login') . '"');
        } else {
            echo Alert::alerts('ยืนยันอีเมลไม่สำเร็จ', 'error', 1500, 'window.history.href = "' . url('/') . '"');
        }
    } else {
        redirect(url('login'));
    }
} else {
    redirect(url('login'));
}
