<?php
if ($_POST['id']) {
    $id = $_POST['id'];
    $name = $_POST['name'];
    $description = $_POST['description'];
    $whitelist_category = $_POST['whitelist_category'];
    $website = $_POST['website'];
    $id_name = $_POST['id_name'];
    $id_card = $_POST['id_card'];
    $id_image = $_POST['id_image'];

    if (count(Whitelist::find(['id' => $id])) == 0) {
        echo Alert::alerts('ไม่พบกิจการนี้ในระบบ', 'error', null, 'window.history.back()');
        exit;
    }

    $path = admin_url('whitelist');
    echo Alert::alerts('แก้ไขกิจการสำเร็จ', 'success', 1500, 'window.location.href = "' . $path . '"');
} else {
    redirect(admin_url('whitelist.add'));
}
