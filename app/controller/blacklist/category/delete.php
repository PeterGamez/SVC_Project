<?php

use App\Class\Alert;
use App\Models\BlacklistCategory;

if ($_POST['id']) {
    $id = $_POST['id'];

    if (BlacklistCategory::count(['id' => $id]) == 0) {
        echo Alert::alerts('ไม่พบหมวดหมู่นี้ในระบบ', 'error', 1500, 'window.history.back()');
        exit;
    }
    BlacklistCategory::delete(['id' => $id]);

    $path = admin_url('blacklist.category.index');
    echo Alert::alerts('ลบหมวดหมู่สำเร็จ', 'success', 1500, 'window.location.href="' . $path . '"');
} else {
    redirect(admin_url('blacklist.category.index'));
}
