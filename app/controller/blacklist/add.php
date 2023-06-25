<?php
if ($_POST['name']) {
    $name = $_POST['name'];
    $reason = $_POST['reason'];
    $blacklist_category_id = $_POST['blacklist_category_id'];
    $website = $_POST['website'];
    $id_name = $_POST['id_name'];
    $id_number = $_POST['id_number'];
    $id_image = $_FILES['id_image'];
    $bank_id = $_POST['bank_id'];
    $bank_number = $_POST['bank_number'];
    $blacklist_image = $_FILES['blacklist_image'];

    $file = $id_image['tmp_name'];
    $file_name = $id_image['name'];
    $file_size = $id_image['size'];
    $file_type = $id_image['type'];

    $data = Discord::postImage(config('discord.blacklist.id_image'), ["file" => curl_file_create($file, $file_type, $file_name)]);
    $image_url = $data['attachments'][0]['url'];

    $insert_id = Blacklist::create([
        'name' => $name,
        'reason' => $reason,
        'blacklist_category_id' => $blacklist_category_id,
        'website' => $website,
        'id_name' => $id_name,
        'id_number' => $id_number,
        'id_image' => $image_url,
        'bank_id' => $bank_id,
        'bank_number' => $bank_number
    ]);

    $file_count = count($blacklist_image['name']);
    for ($i = 0; $i < $file_count; $i++) {
        $file = $blacklist_image['tmp_name'][$i];
        $file_name = $blacklist_image['name'][$i];
        $file_type = $blacklist_image['type'][$i];
        $file_size = $blacklist_image['size'][$i];

        $data = Discord::postImage(config('discord.blacklist.proof'), ["file" => curl_file_create($file, $file_type, $file_name)]);
        $image_url = $data['attachments'][0]['url'];
        BlacklistImage::create([
            'blacklist_id' => $insert_id,
            'image' => $image_url
        ]);
    }

    $path = admin_url('blacklist');
    echo Alert::alerts('เพิ่มกิจการสำเร็จ', 'success', 1500, 'window.location.href="' . $path . '"');
} else {
    redirect(admin_url('blacklist.add'));
}
