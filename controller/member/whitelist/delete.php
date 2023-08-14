<?php

use App\Class\Alert;
use App\Models\Whitelist;
use App\Models\WhitelistWaiting;

$data = Whitelist::find()->where('account_id', $_SESSION['user_id'])->getOne();
if (!$data) {
    echo Alert::alerts('ไม่พบข้อมูล', 'error', 1500, 'window.history.back()');
    exit;
}

WhitelistWaiting::create([
    'name' => $data['name'],
    'description' => $data['description'],
    'account_id' => $data['account_id'],
    'banner' => $data['banner'],
    'website' => $data['website'],
    'id_firstname' => $data['id_firstname'],
    'id_lastname' => $data['id_lastname'],
    'id_number' => $data['id_number'],
    'id_image' => $data['id_image'],
    'approve_id' => 5
]);

echo Alert::alerts('แจ้งลบข้อมูลสำเร็จ', 'success', 1500, 'window.location.href="' . member_url() . '"');
