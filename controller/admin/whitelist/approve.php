<?php

use App\Class\Alert;
use App\Models\Account;
use App\Models\Whitelist;

if ($_POST['id']) {
    $id = $_POST['id'];
    $approve_id = $_POST['approve_id'];
    $approve_reason = $_POST['approve_reason'];

    $data = Whitelist::find()->where('id', $id)->getOne();
    if (!$data) {
        echo Alert::alerts('ไม่พบกิจการนี้ในระบบ', 'error', 1500, 'window.history.back()');
        exit;
    }

    if ($approve_id == 2) {
        Account::update(['id' => $data['account_id']], ['role' => 'seller']);
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
