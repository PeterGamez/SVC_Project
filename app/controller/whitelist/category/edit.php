<?php

use App\Class\Alert;
use App\Models\WhitelistCategory;

if ($_POST['id']) {
    $id = $_POST['id'];
    $name = $_POST['name'];

    if (WhitelistCategory::count(['id' => $id]) == 0) {
        echo Alert::alerts('ไม่พบหมวดหมู่นี้ในระบบ', 'error', 1500, 'window.history.back()');
        exit;
    }
    WhitelistCategory::update(['id' => $id], ['name' => $name]);

    $path = admin_url('whitelist.category');
    echo Alert::alerts('แก้ไขหมวดหมู่สำเร็จ', 'success', 1500, 'window.location.href="' . $path . '"');
} else {
    redirect(admin_url('whitelist.category.add'));
}
