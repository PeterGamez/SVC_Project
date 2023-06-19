<?php
if ($_POST['id']) {
    $id = $_POST['id'];
    $password1 = $_POST['password1'];
    $password2 = $_POST['password2'];

    if ($password1 != $password2) {
        echo Alert::alerts('รหัสผ่านไม่ตรงกัน', 'error', null, 'window.history.back()');
        exit;
    }

    if (count(Account::find(['id' => $id])) == 0) {
        echo Alert::alerts('ไม่พบบัญชีนี้ในระบบ', 'error', null, 'window.history.back()');
        exit;
    }

    Account::update([
        'id' => $id
    ], [
        'password' => password_hash($password, PASSWORD_DEFAULT),
        'update_at' => date('Y-m-d H:i:s'),
        'update_by' => $_SESSION['user_id']
    ]);

    $path = admin_url('account');
    echo Alert::alerts('แก้ไขรหัสผ่านสำเร็จ', 'success', 1500, 'window.location.href="' . $path . '"');
} else {
    redirect(admin_url('account'));
}
