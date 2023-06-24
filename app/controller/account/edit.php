<?php
if ($_POST['id']) {
    $id = $_POST['id'];
    $username = $_POST['username'];
    $email = $_POST['email'];
    $role = $_POST['role'];

    $data = Account::findOne(['id' => $id]);
    if (count($data) == 0) {
        echo Alert::alerts('ไม่พบบัญชีนี้ในระบบ', 'error', 1500, 'window.history.back()');
        exit;
    }

    if ($username <> $data['username'] || $email <> $data['email']) {
        if (Account::count(['username' => $username, 'email' => $email], 'OR') > 0) {
            echo Alert::alerts('มีบัญชีนี้อยู่ในระบบแล้ว', 'error', 1500, 'window.history.back()');
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
