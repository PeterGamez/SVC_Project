<?php

use App\Class\Alert;
use App\Models\Blacklist;

if ($_POST['id']) {
    $id = $_POST['id'];
    $name = $_POST['name'];
    $reason = $_POST['reason'];
    $website = $_POST['website'];
    $id_name = $_POST['id_name'];
    $id_number = $_POST['id_number'];
    $id_image = $_FILES['id_image'];
    $bank_id = $_POST['bank_id'];
    $bank_number = $_POST['bank_number'];
    $item_name = $_POST['item_name'];
    $item_balance = $_POST['item_balance'];
    $item_date = $_POST['item_date'];

    if (Blacklist::count(['id' => $id]) == 0) {
        echo Alert::alerts('ไม่พบกิจการนี้ในระบบ', 'error', 1500, 'window.history.back()');
        exit;
    }

    Blacklist::update(['id' => $id], [
        'name' => $name,
        'reason' => $reason,
        'website' => $website,
        'id_name' => $id_name,
        'id_number' => $id_number,
        'id_image' => $id_image,
        'bank_id' => $bank_id,
        'bank_number' => $bank_number,
        'item_name' => $item_name,
        'item_balance' => $item_balance,
        'item_date' => $item_date
    ]);

    $path = admin_url("blacklist.$id.view");
    echo Alert::alerts('แก้ไขกิจการสำเร็จ', 'success', 1500, 'window.location.href="' . $path . '"');
} else {
    redirect(admin_url('blacklist'));
}
