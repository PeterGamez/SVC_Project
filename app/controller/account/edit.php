<?php
if ($_POST['id']) {
    $id = $_POST['id'];
    $username = $_POST['username'];
    $email = $_POST['email'];
    $role = $_POST['role'];

    if (Account::count(['id' => $id]) == 0) {
        echo Alert::alerts('ไม่พบบัญชีนี้ในระบบ', 'error', null, 'window.history.back()');
        exit;
    }

    if (Account::count(['username' => $username, 'email' => $email], 'OR') > 0) {
        echo Alert::alerts('มีบัญชีนี้อยู่ในระบบแล้ว', 'error', null, 'window.history.back()');
        exit;
    }

    Account::update([
        'id' => $id
    ], [
        'username' => $username,
        'email' => $email,
        'role' => $role,
        'update_at' => date('Y-m-d H:i:s'),
        'update_by' => $_SESSION['user_id']
    ]);

    $path = admin_url('account');
    echo Alert::alerts('แก้ไขบัญชีสำเร็จ', 'success', 1500, 'window.location.href="' . $path . '"');
} else {
    redirect(admin_url('account'));
}
