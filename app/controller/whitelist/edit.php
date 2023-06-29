<?php

use App\Class\Alert;
use App\Class\App;
use App\Class\Discord;
use App\Models\Whitelist;

if ($_POST['id']) {
    $id = $_POST['id'];
    $name = $_POST['name'];
    $description = $_POST['description'];
    $whitelist_category_id = $_POST['whitelist_category_id'];
    $account_id = $_POST['account_id'];
    $website = $_POST['website'];
    $id_name = $_POST['id_name'];
    $id_number = $_POST['id_number'];


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
        'whitelist_category_id' => $whitelist_category_id,
        'account_id' => $account_id,
        'website' => $website,
        'id_name' => $id_name,
        'id_number' => $id_number,
        'id_image' => $id_image
    ];

    if ($_POST['id_image']) {
        $id_image = $_POST['id_image'];
        $file = $id_image['tmp_name'];
        $file_name = $id_image['name'];
        $file_size = $id_image['size'];
        $file_type = $id_image['type'];

        $data = Discord::postImage(config('discord.whitelist.proof'), ["file" => curl_file_create($file, 'png', App::RandomHex(16) . '.png')]);
        $image_url = $data['attachments'][0]['url'];
        $newData['id_image'] = $image_url;
    }
    Whitelist::update(['id' => $id], $newData);

    $path = admin_url("whitelist.$id.view");
    echo Alert::alerts('แก้ไขกิจการสำเร็จ', 'success', 1500, 'window.location.href="' . $path . '"');
} else {
    redirect(admin_url('whitelist'));
}
