<?php

use App\Class\Alert;
use App\Class\App;
use App\Class\Discord;
use App\Models\Whitelist;

if ($_POST['name']) {
    $name = $_POST['name'];
    $description = $_POST['description'];
    $account_id = $_POST['account_id'];
    $website = $_POST['website'];
    $id_name = $_POST['id_name'];
    $id_number = $_POST['id_number'];
    $id_image = $_FILES['id_image'];

    $file = $id_image['tmp_name'];
    $file_name = $id_image['name'];
    $file_size = $id_image['size'];
    $file_type = $id_image['type'];

    if (Whitelist::count(['account_id' => $account_id]) > 0) {
        echo Alert::alerts('บัญชีเจ้าของกิจการนี้ มีอยู่ในระบบแล้ว', 'error', 1500, 'window.history.back()');
        exit;
    }

    $data = Discord::postImage(config('discord.whitelist.id_image'), ["file" => curl_file_create($file, 'png', App::RandomHex(16) . '.png')]);
    $image_url = $data['attachments'][0]['url'];

    Whitelist::create([
        'name' => $name,
        'description' => $description,
        'account_id' => $account_id,
        'website' => $website,
        'id_name' => $id_name,
        'id_number' => $id_number,
        'id_image' => $image_url
    ]);

    $path = admin_url('whitelist');
    echo Alert::alerts('เพิ่มกิจการสำเร็จ', 'success', 1500, 'window.location.href="' . $path . '"');
} else {
    redirect(admin_url('whitelist.add'));
}
