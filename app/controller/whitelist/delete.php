<?php
if ($_POST['id']) {
    $id = $_POST['id'];

    if (count(Whitelist::find(['id' => $id])) == 0) {
        echo Alert::alerts('ไม่พบกิจการนี้ในระบบ', 'error', null, 'window.history.back()');
        exit;
    }

    Whitelist::delete(['id' => $id]);

    $path = admin_url('whitelist');
    echo Alert::alerts('ลบกิจการสำเร็จ', 'success', 1500, 'window.location.href="' . $path . '"');
} else {
    redirect(admin_url('whitelist'));
}
