<?php

use App\Class\Alert;
use App\Models\Approve;

if ($_POST['id']) {
    $id = $_POST['id'];

    if (Approve::count(['id' => $id]) == 0) {
        echo Alert::alerts('ไม่พบสถานะนี้ในระบบ', 'error', 1500, 'window.history.back()');
        exit;
    }

    Approve::delete(['id' => $id]);

    $path = admin_url('approve');
    echo Alert::alerts('ลบสถานะสำเร็จ', 'success', 1500, 'window.location.href="' . $path . '"');
} else {
    redirect(admin_url('approve'));
}
