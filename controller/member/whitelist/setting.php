<?php

use App\Class\Alert;
use App\Class\App;
use App\Class\Discord;
use App\Models\Whitelist;
use App\Models\WhitelistWaiting;

if ($_POST['id']) {
    $id = $_POST['id'];
    $name = $_POST['name'];
    $description = $_POST['description'];
    $website = $_POST['website'];

    $data = Whitelist::find()->where('id', $id)->getOne();
    if (!$data) {
        echo Alert::alerts('ไม่พบกิจการนี้ในระบบ', 'error', 1500, 'window.history.back()');
        exit;
    }

    $newData = [
        'tag' => $data['tag'],
        'name' => $name,
        'description' => $description,
        'account_id' => $_SESSION['user_id'],
        'website' => $website,
        'id_firstname' => $data['id_firstname'],
        'id_lastname' => $data['id_lastname'],
        'id_number' => $data['id_number'],
        'id_image' => $data['image_url'],
        'approve_id' => 4
    ];

    if ($_FILES['banner']['tmp_name']) {
        $banner = $_FILES['banner'];
        $data = Discord::postImage(config('discord.whitelist.banner'), ["file" => curl_file_create($banner['tmp_name'], 'png', App::RandomHex(4) . '.png')]);
        $banner_url = $data['attachments'][0]['url'];
        $newData['banner'] = $banner_url;
    }

    WhitelistWaiting::create($newData);

    $path = member_url('whitelist.setting');
    echo Alert::alerts('แก้ไขกิจการสำเร็จ', 'success', 1500, 'window.location.href="' . $path . '"');
} else {
    redirect(member_url('whitelist.setting'));
}
