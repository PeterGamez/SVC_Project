<?php

use App\Class\Alert;
use App\Models\Whitelist;

if ($_POST['id']) {
    $id = $_POST['id'];
    $approve_id = $_POST['approve_id'];
    $approve_reason = $_POST['approve_reason'];

    if (Whitelist::count(['id' => $id]) == 0) {
        echo Alert::alerts('ไม่พบกิจการนี้ในระบบ', 'error', 1500, 'window.history.back()');
        exit;
    }

    Whitelist::update(['id' => $id], [
        'approve_id' => $approve_id,
        'approve_reason' => $approve_reason,
        'approve_by' => $_SESSION['user_id'],
        'approve_at' => date('Y-m-d H:i:s')
    ]);

    $path = admin_url("whitelist.$id.view");
    echo Alert::alerts('แก้ไขกิจการสำเร็จ', 'success', 1500, 'window.location.href="' . $path . '"');
} else {
    redirect(admin_url('whitelist'));
}
