<?php

use App\Class\Alert;
use App\Models\Account;

if ($_POST['username']) {
    $username = $_POST['username'];
    $email = $_POST['email'];
    $password = $_POST['password'];
    $role = $_POST['role'];

    if (Account::count(['username' => $username, 'email' => $email], 'OR') > 0) {
        echo Alert::alerts('มีบัญชีนี้อยู่ในระบบแล้ว', 'error', 1500, 'window.history.back()');
        exit;
    }

    Account::create([
        'username' => $username,
        'email' => $email,
        'password' => password_hash($password, PASSWORD_DEFAULT),
        'role' => $role
    ]);

    $path = admin_url('account');
    echo Alert::alerts('เพิ่มบัญชีสำเร็จ', 'success', 1500, 'window.location.href="' . $path . '"');
} else {
    redirect(admin_url('account.add'));
}
