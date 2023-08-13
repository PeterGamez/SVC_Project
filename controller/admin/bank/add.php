<?php

use App\Class\Alert;
use App\Class\App;
use App\Class\Discord;
use App\Models\Bank;

if ($_POST['name']) {
    $name = $_POST['name'];
    $image = $_FILES['image'];

    $file = $image['tmp_name'];

    $data = Discord::postImage(config('discord.bank.image'), ["file" => curl_file_create($file, 'png', App::RandomHex(4) . '.png')]);
    $image_url = $data['attachments'][0]['url'];

    Bank::create([
        'name' => $name,
        'image' => $image_url
    ]);

    $path = admin_url('bank');
    echo Alert::alerts('เพื่มธนาคารสำเร็จ', 'success', 1500, 'window.location.href="' . $path . '"');
} else {
    redirect(admin_url('bank.add'));
}
