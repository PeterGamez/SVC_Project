<?php
if ($_POST['id']) {
    $id = $_POST['id'];
    $name = $_POST['name'];

    if (count(Blacklist::find(['id' => $id])) == 0) {
        echo Alert::alerts('ไม่พบกิจการนี้ในระบบ', 'error', null, 'window.history.back()');
        exit;
    }

    Blacklist::delete(['id' => $id]);

    $path = admin_url('blacklist');
    echo Alert::alerts('ลบกิจการสำเร็จ', 'success', 1500, 'window.location.href="' . $path . '"');
} else {
    redirect(admin_url('blacklist'));
}
