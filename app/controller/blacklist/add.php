<?php
if ($_POST['name']) {
    $name = $_POST['name'];

    Blacklist::create([
        'name' => $name
    ]);

    $path = admin_url('blacklist');
    echo Alert::alerts('เพิ่มกิจการสำเร็จ', 'success', 1500, 'window.location.href="' . $path . '"');
} else {
    redirect(admin_url('blacklist.add'));
}
