<?php

use App\Class\Alert;
use App\Models\Account;

if ($_POST['id']) {
    $id = $_POST['id'];

    if (Account::count(['id' => $id]) == 0) {
        echo Alert::alerts('ไม่พบบัญชีนี้ในระบบ', 'error', 1500, 'window.history.back()');
        exit;
    }

    Account::delete(['id' => $id]);

    $path = admin_url('account');
    echo Alert::alerts('ลบบัญชีสำเร็จ', 'success', 1500, 'window.location.href="' . $path . '"');
} else {
    redirect(admin_url('account'));
}
