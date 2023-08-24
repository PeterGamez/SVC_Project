<?php

use App\Class\Alert;
use App\Models\Account;

if ($_POST['id']) {
    $id = $_POST['id'];
    $username = $_POST['username'];
    $email = $_POST['email'];
    $role = $_POST['role'];

    $data = Account::find()->where('id', $id)->getOne();
    if (count($data) == 0) {
        echo Alert::alerts('ไม่พบบัญชีนี้ในระบบ', 'error', 1500, 'window.history.back()');
        exit;
    }

    if ($data['role'] == 'superadmin' and $_SESSION['user_role'] <> 'superadmin') {
        echo Alert::alerts('คุณไม่มีสิทธิ์แก้ไขบัญชีนี้', 'error', 1500, 'window.history.back()');
        exit;
    }

    if ($username <> $data['username']) {
        if (Account::count(['username' => $username]) > 0) {
            echo Alert::alerts('มีชื่อบัญชีนี้อยู่ในระบบแล้ว', 'error', 1500, 'window.history.back()');
            exit;
        }
    }
    if ($email <> $data['email']) {
        if (Account::count(['email' => $email]) > 0) {
            echo Alert::alerts('มีอีเมลนี้อยู่ในระบบแล้ว', 'error', 1500, 'window.history.back()');
            exit;
        }
    }

    Account::update([
        'id' => $id
    ], [
        'username' => $username,
        'email' => $email,
        'role' => $role
    ]);

    $path = admin_url("account.$id");
    echo Alert::alerts('แก้ไขบัญชีสำเร็จ', 'success', 1500, 'window.location.href="' . $path . '"');
} else {
    redirect(admin_url('account'));
}
