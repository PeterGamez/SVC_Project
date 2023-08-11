<?php

use App\Class\Alert;
use App\Models\Account;
use App\Models\Whitelist;
use App\Models\WhitelistWaiting;

if ($_POST['id']) {
    $id = $_POST['id'];
    $approve_id = $_POST['approve_id'];
    $approve_reason = $_POST['approve_reason'];

    $data = WhitelistWaiting::find()->where('id', $id)->getOne();
    if (!$data) {
        echo Alert::alerts('ไม่พบกิจการนี้ในระบบ', 'error', 1500, 'window.history.back()');
        exit;
    }

    if ($approve_id == 2) {
        Account::update(['id' => $data['account_id']], ['role' => 'seller']);

        $last_id = Whitelist::find()->order('id', 'DESC')->limit(1)->getOne();
        $last_id = $last_id ? $last_id['id'] + 1 : 1;
        if (strlen($last_id) < 5) {
            $last_id = str_pad($last_id, 5, '0', STR_PAD_LEFT);
        }
        Whitelist::create([
            'tag' => 'WLS' . $last_id,
            'name' => $data['name'],
            'description' => $data['description'],
            'account_id' => $data['account_id'],
            'website' => $data['website'],
            'id_firstname' => $data['id_firstname'],
            'id_lastname' => $data['id_lastname'],
            'id_number' => $data['id_number'],
            'id_image' => $data['id_image'],
            'approve_id' => $approve_id,
            'approve_reason' => $approve_reason,
            'approve_by' => $_SESSION['user_id'],
            'approve_at' => date('Y-m-d H:i:s')
        ]);
        $path = admin_url("whitelist.$id.view");
        echo Alert::alerts('แก้ไขกิจการสำเร็จ', 'success', 1500, 'window.location.href="' . $path . '"');
    } else {
        WhitelistWaiting::update(['id' => $id], [
            'approve_id' => $approve_id,
            'approve_reason' => $approve_reason,
            'approve_by' => $_SESSION['user_id'],
            'approve_at' => date('Y-m-d H:i:s')
        ]);
        $path = admin_url("whitelist.waiting.$id.view");
        echo Alert::alerts('แก้ไขกิจการสำเร็จ', 'success', 1500, 'window.location.href="' . $path . '"');
    }
} else {
    redirect(admin_url('whitelist'));
}
