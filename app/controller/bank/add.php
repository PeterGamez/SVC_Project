<?php
if ($_POST['name']) {
    $name = $_POST['name'];
    $image = $_FILES['image'];

    $file = $image['tmp_name'];
    $file_name = $image['name'];
    $file_size = $image['size'];
    $file_type = $image['type'];

    $data = Discord::postImage(config('discord.bank.image'), ["file" => curl_file_create($file, $file_type, $file_name)]);
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
