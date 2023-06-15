<?php
if ($_POST['name']) {
    $name = $_POST['name'];
    $description = $_POST['description'];
    $whitelist_category = $_POST['whitelist_category'];
    $website = $_POST['website'];
    $id_name = $_POST['id_name'];
    $id_card = $_POST['id_card'];
    $id_image = $_FILES['id_image'];

    $file = $id_image['tmp_name'];
    $file_name = $id_image['name'];
    $file_size = $id_image['size'];
    $file_type = $id_image['type'];

    $data = Discord::postImage(config('discord.whitelist.proof'), ["file" => curl_file_create($file, $file_type, $file_name)]);

    Whitelist::create([
        'name' => $name,
        'description' => $description,
        'whitelist_category' => $whitelist_category,
        'website' => $website,
        'id_name' => $id_name,
        'id_card' => $id_card,
        'id_image' => $data['attachments'][0]['url'],
    ]);

    $path = admin_url('whitelist');
    echo Alert::alerts('เพิ่มกิจการสำเร็จ', 'success', 1500, 'window.location.href = "' . $path . '"');
} else {
    redirect(admin_url('whitelist.add'));
}
