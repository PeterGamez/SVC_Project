<?php

use App\Class\Alert;
use App\Models\Approve;

if ($_POST['id']) {
    $id = $_POST['id'];
    $name = $_POST['name'];
    $color = $_POST['color'];
    $icon = $_POST['icon'];
    $whitelist = $_POST['whitelist'];
    $blacklist = $_POST['blacklist'];

    $data = Approve::findOne(['id' => $id]);
    if (count($data) == 0) {
        echo Alert::alerts('ไม่พบสถานะนี้ในระบบ', 'error', 1500, 'window.history.back()');
        exit;
    }

    Approve::update([
        'id' => $id
    ], [
        'name' => $name,
        'color' => $color,
        'icon' => $icon,
        'whitelist' => $whitelist,
        'blacklist' => $blacklist
    ]);

    $path = admin_url("approve.$id.edit");
    echo Alert::alerts('แก้ไขสถานะสำเร็จ', 'success', 1500, 'window.location.href="' . $path . '"');
} else {
    redirect(admin_url('approve'));
}
