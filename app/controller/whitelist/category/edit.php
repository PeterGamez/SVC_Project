<?php
if ($_POST['id']) {
    $id = $_POST['id'];
    $name = $_POST['name'];

    if (count(Whitelist_Category::find(['id' => $id])) == 0) {
        echo Alert::alerts('ไม่พบหมวดหมู่นี้ในระบบ', 'error', null, 'window.history.back()');
        exit;
    }
    Whitelist_Category::update([
        'id' => $id
    ], [
        'name' => $name,
        'update_at' => date('Y-m-d H:i:s'),
        'update_by' => $_SESSION['user_id']
    ]);

    $path = admin_url('whitelist.category');
    echo Alert::alerts('แก้ไขหมวดหมู่สำเร็จ', 'success', 1500, 'window.location.href = "' . $path . '"');
} else {
    redirect(admin_url('whitelist.category.add'));
}
