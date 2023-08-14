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

    // อนุมัติ
    if ($approve_id == 2) {
        Account::update(['id' => $data['account_id']], ['role' => 'seller']);

        $last_id = Whitelist::status();
        $last_id = $last_id['Auto_increment'];
        $tag = $last_id;
        if (strlen($last_id) < 5) {
            $tag = str_pad($last_id, 5, '0', STR_PAD_LEFT);
        }
        
        Whitelist::create([
            'tag' => 'WLS' . $tag,
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

        WhitelistWaiting::delete(['id' => $id]);

        $path = admin_url("whitelist.$last_id");
        echo Alert::alerts('ยืนยันกิจการสำเร็จ', 'success', 1500, 'window.location.href="' . $path . '"');
    }
    // คำขอแก้ไข
    else if ($approve_id == 4) {
        $old_data = Whitelist::find()->where('account_id', $data['account_id'])->getOne();

        Whitelist::update(['id' => $old_data['id']], [
            'name' => $data['name'],
            'description' => $data['description'],
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

        WhitelistWaiting::delete(['id' => $id]);

        $path = admin_url("whitelist.$old_data[id]");
        echo Alert::alerts('แก้ไขกิจการสำเร็จ', 'success', 1500, 'window.location.href="' . $path . '"');
    }
    // คำขอลบ
    else if ($approve_id == 5) {
        $old_data = Whitelist::find()->where('account_id', $data['account_id'])->getOne();

        Whitelist::delete(['id' => $old_data['id']]);

        WhitelistWaiting::delete(['id' => $id]);

        $path = admin_url('whitelist');
        echo Alert::alerts('ลบกิจการสำเร็จ', 'success', 1500, 'window.location.href="' . $path . '"');
    }
    // อื่นๆ
    else {
        WhitelistWaiting::update(['id' => $id], [
            'approve_id' => $approve_id,
            'approve_reason' => $approve_reason,
            'approve_by' => $_SESSION['user_id'],
            'approve_at' => date('Y-m-d H:i:s')
        ]);
        $path = admin_url("whitelist.waiting.$id");
        echo Alert::alerts('แก้ไขกิจการสำเร็จ', 'success', 1500, 'window.location.href="' . $path . '"');
    }
} else {
    redirect(admin_url('whitelist'));
}
