<?php
if ($_POST['id']) {
    $id = $_POST['id'];
    $name = $_POST['name'];

    if (Blacklist::count(['id' => $id]) == 0) {
        echo Alert::alerts('ไม่พบกิจการนี้ในระบบ', 'error', null, 'window.history.back()');
        exit;
    }

    Blacklist::update([
        'id' => $id
    ], [
        'name' => $name,
        'update_at' => date('Y-m-d H:i:s'),
        'update_by' => $_SESSION['user_id']
    ]);

    $path = admin_url('blacklist');
    echo Alert::alerts('แก้ไขกิจการสำเร็จ', 'success', 1500, 'window.location.href="' . $path . '"');
} else {
    redirect(admin_url('blacklist.add'));
}
