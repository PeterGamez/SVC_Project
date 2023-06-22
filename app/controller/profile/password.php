<?php
if ($_POST['password1']) {
    $password1 = $_POST['password1'];
    $password2 = $_POST['password2'];

    if ($password1 != $password2) {
        echo Alert::alerts('รหัสผ่านไม่ตรงกัน', 'error', 1500, 'window.history.back()');
        exit;
    }

    Account::update(['id' => $_SESSION['user_id']], ['password' => password_hash($password, PASSWORD_DEFAULT)]);

    if (in_array($_SESSION['user_role'], ['superadmin', 'admin', 'staff'])) {
        $path = url(config('site.admin_panel'));
    } else {
        $path = url(config('site.member_panel'));
    }
    echo Alert::alerts('เปลี่ยนรหัสผ่านสำเร็จ', 'success', 1500, 'window.location.href="' . $path . '"');
} else {
    if (in_array($_SESSION['user_role'], ['superadmin', 'admin', 'staff'])) {
        $path = url(config('site.admin_panel'));
    } else {
        $path = url(config('site.member_panel'));
    }
}
