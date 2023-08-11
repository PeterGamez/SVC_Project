<?php

use App\Class\Alert;
use App\Class\App;
use App\Class\Discord;
use App\Models\Whitelist;

if ($_POST['id']) {
    $id = $_POST['id'];
    $name = $_POST['name'];
    $description = $_POST['description'];
    $website = $_POST['website'];

    if (Whitelist::count(['id' => $id]) == 0) {
        echo Alert::alerts('ไม่พบกิจการนี้ในระบบ', 'error', 1500, 'window.history.back()');
        exit;
    }
    if (Whitelist::count(['account_id' => $account_id]) > 0) {
        echo Alert::alerts('บัญชีเจ้าของกิจการนี้ มีอยู่ในระบบแล้ว', 'error', 1500, 'window.history.back()');
        exit;
    }

    $newData = [
        'name' => $name,
        'description' => $description,
        'account_id' => $account_id,
        'website' => $website
    ];

    if ($_FILES['banner']) {
        $banner = $_FILES['banner'];
        $data = Discord::postImage(config('discord.whitelist.banner'), ["file" => curl_file_create($banner['tmp_name'], 'png', App::RandomHex(4) . '.png')]);
        $banner_url = $data['attachments'][0]['url'];
        $newData['banner'] = $banner_url;
    }

    Whitelist::update(['id' => $id], $newData);

    $path = member_url('whitelist.setting');
    echo Alert::alerts('แก้ไขกิจการสำเร็จ', 'success', 1500, 'window.location.href="' . $path . '"');
} else {
    redirect(member_url('whitelist.setting'));
}
