<?php
if ($_POST['name']) {
    $name = $_POST['name'];

    if (WhitelistCategory::count(['name' => $name]) > 0) {
        echo Alert::alerts('มีหมวดหมู่นี้อยู่แล้ว', 'error', 1500, 'window.history.back()');
        exit;
    }
    WhitelistCategory::create(['name' => $name]);

    $path = admin_url('whitelist.category');
    echo Alert::alerts('เพิ่มหมวดหมู่สำเร็จ', 'success', 1500, 'window.location.href="' . $path . '"');
} else {
    redirect(admin_url('whitelist.category.add'));
}
