<?php

use App\Class\Alert;
use App\Models\Account;

if ($_POST['id']) {
    $id = $_POST['id'];
    $password = $_POST['password'];

    $data = Account::find()->where('id', $id)->getOne();
    if (count($data) == 0) {
        echo Alert::alerts('ไม่พบบัญชีนี้ในระบบ', 'error', 1500, 'window.history.back()');
        exit;
    }

    if ($data['role'] == 'superadmin' and $_SESSION['user_role'] <> 'superadmin') {
        echo Alert::alerts('คุณไม่มีสิทธิ์แก้ไขบัญชีนี้', 'error', 1500, 'window.history.back()');
        exit;
    }

    Account::update(['id' => $id], ['password' => password_hash($password, PASSWORD_DEFAULT)]);

    $path = admin_url("account.$id");
    echo Alert::alerts('แก้ไขรหัสผ่านสำเร็จ', 'success', 1500, 'window.location.href="' . $path . '"');
} else {
    redirect(admin_url('account'));
}
