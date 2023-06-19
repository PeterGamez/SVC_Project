<?php
if ($_POST['name']) {
    $name = $_POST['name'];

    if (count(BlacklistCategory::find(['name' => $name])) > 0) {
        echo Alert::alerts('มีหมวดหมู่นี้อยู่แล้ว', 'error', 1500, 'window.history.back()');
        exit;
    }
    BlacklistCategory::create([
        'name' => $name,
        'create_at' => date('Y-m-d H:i:s'),
        'create_by' => $_SESSION['user_id'],
        'update_at' => date('Y-m-d H:i:s'),
        'update_by' => $_SESSION['user_id']
    ]);

    $path = admin_url('blacklist.category');
    echo Alert::alerts('เพิ่มหมวดหมู่สำเร็จ', 'success', 1500, 'window.location.href="' . $path . '"');
} else {
    redirect(admin_url('blacklist.category.add'));
}
