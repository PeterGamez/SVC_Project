<?php
if ($_POST['id']) {
    $id = $_POST['id'];

    if (count(WhitelistCategory::find(['id' => $id])) == 0) {
        echo Alert::alerts('ไม่พบหมวดหมู่นี้ในระบบ', 'error', null, 'window.history.back()');
        exit;
    }
    WhitelistCategory::delete(['id' => $id]);

    $path = admin_url('whitelist.category.index');
    echo Alert::alerts('ลบหมวดหมู่สำเร็จ', 'success', 1500, 'window.location.href = "' . $path . '"');
} else {
    redirect(admin_url('whitelist.category.index'));
}
