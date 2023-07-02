<?php

use App\Class\Alert;
use App\Models\Approve;

if ($_POST['name']) {
    $name = $_POST['name'];
    $color = $_POST['color'];
    $icon = $_POST['icon'];
    $whitelist = $_POST['whitelist'];
    $blacklist = $_POST['blacklist'];

    Approve::create([
        'name' => $name,
        'color' => $color,
        'icon' => $icon,
        'whitelist' => $whitelist,
        'blacklist' => $blacklist
    ]);

    $path = admin_url('approve');
    echo Alert::alerts('เพื่มสถานะสำเร็จ', 'success', 1500, 'window.location.href="' . $path . '"');
} else {
    redirect(admin_url('approve.add'));
}
