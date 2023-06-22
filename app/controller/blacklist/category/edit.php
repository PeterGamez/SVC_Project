<?php
if ($_POST['id']) {
    $id = $_POST['id'];
    $name = $_POST['name'];

    if (!BlacklistCategory::findOne(['id' => $id])) {
        redirect(admin_url('blacklist.category'));
        exit;
    }
    BlacklistCategory::update(['id' => $id], ['name' => $name]);

    $path = admin_url('blacklist.category');
    echo Alert::alerts('แก้ไขหมวดหมู่สำเร็จ', 'success', 1500, 'window.location.href="' . $path . '"');
} else {
    redirect(admin_url('blacklist.category.add'));
}
