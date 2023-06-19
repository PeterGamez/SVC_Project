<?php
if ($_POST['id']) {
    $id = $_POST['id'];
    $name = $_POST['name'];
    $description = $_POST['description'];
    $whitelist_category = $_POST['whitelist_category'];
    $website = $_POST['website'];
    $id_name = $_POST['id_name'];
    $id_card = $_POST['id_card'];

    if (count(Whitelist::find(['id' => $id])) == 0) {
        echo Alert::alerts('ไม่พบกิจการนี้ในระบบ', 'error', null, 'window.history.back()');
        exit;
    }

    $newData = [
        'name' => $name,
        'description' => $description,
        'whitelist_category' => $whitelist_category,
        'website' => $website,
        'id_name' => $id_name,
        'id_card' => $id_card,
        'id_image' => $id_image,
        'update_at' => date('Y-m-d H:i:s'),
        'update_by' => $_SESSION['user_id']
    ];

    if ($_POST['id_image']) {
        $id_image = $_POST['id_image'];
        $file = $id_image['tmp_name'];
        $file_name = $id_image['name'];
        $file_size = $id_image['size'];
        $file_type = $id_image['type'];

        $data = Discord::postImage(config('discord.whitelist.proof'), ["file" => curl_file_create($file, $file_type, $file_name)]);
        $image_url = $data['attachments'][0]['url'];
        array_push($newData, ['id_image' => $url]);
    }
    Whitelist::update(['id' => $id], $newData);

    $path = admin_url('whitelist');
    echo Alert::alerts('แก้ไขกิจการสำเร็จ', 'success', 1500, 'window.location.href="' . $path . '"');
} else {
    redirect(admin_url('whitelist.add'));
}
