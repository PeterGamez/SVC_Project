<?php
if ($_POST['id']) {
    $id = $_POST['id'];
    $password = $_POST['password'];

    if (Account::count(['id' => $id]) == 0) {
        echo Alert::alerts('ไม่พบบัญชีนี้ในระบบ', 'error', null, 'window.history.back()');
        exit;
    }

    Account::update(['id' => $id], ['password' => password_hash($password, PASSWORD_DEFAULT)]);

    $path = admin_url('account');
    echo Alert::alerts('แก้ไขรหัสผ่านสำเร็จ', 'success', 1500, 'window.location.href="' . $path . '"');
} else {
    redirect(admin_url('account'));
}
