<?php

use App\Class\Account;
use App\Class\Alert;

if (isset($_GET['token'])) {
    $token = $_GET['token'];

    $data = Account::verify_email($token);
    if ($data) {
        echo Alert::alerts('ยืนยันอีเมลสำเร็จ', 'success', 1500, 'window.location.href = "' . member_url('login') . '"');
    } else {
        echo Alert::alerts('ยืนยันอีเมลไม่สำเร็จ', 'error', 1500, 'window.location.href = "' . member_url('login') . '"');
    }
} else {
    redirect(member_url('login'));
}
