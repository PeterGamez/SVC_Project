<?php

use App\Class\Alert;
use App\Models\BlacklistCategory;

if ($_POST['id']) {
    $id = $_POST['id'];
    $name = $_POST['name'];

    if (!BlacklistCategory::count(['id' => $id])) {
        echo Alert::alerts('ไม่พบหมวดหมู่นี้ในระบบ', 'danger', 1500, 'window.history.back()');
        exit;
    }
    BlacklistCategory::update(['id' => $id], ['name' => $name]);

    $path = admin_url('blacklist.category');
    echo Alert::alerts('แก้ไขหมวดหมู่สำเร็จ', 'success', 1500, 'window.location.href="' . $path . '"');
} else {
    redirect(admin_url('blacklist.category'));
}
