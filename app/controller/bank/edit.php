<?php
if ($_POST['id']) {
    $id = $_POST['id'];
    $name = $_POST['name'];

    if (Bank::count(['id' => $id]) == 0) {
        echo Alert::alerts('ไม่พบกิจการนี้ในระบบ', 'error', 1500, 'window.history.back()');
        exit;
    }

    $newData = ['name' => $name];

    if ($_POST['image']) {
        $image = $_POST['image'];
        $file = $image['tmp_name'];
        $file_name = $image['name'];
        $file_size = $image['size'];
        $file_type = $image['type'];

        $data = Discord::postImage(config('discord.bank.image'), ["file" => curl_file_create($file, $file_type, $file_name)]);
        $image_url = $data['attachments'][0]['url'];
        array_push($newData, ['image' => $image_url]);
    }
    Bank::update(['id' => $id], $newData);

    $path = admin_url("bank.$id.view");
    echo Alert::alerts('แก้ไขกิจการสำเร็จ', 'success', 1500, 'window.location.href="' . $path . '"');
} else {
    redirect(admin_url('bank'));
}
