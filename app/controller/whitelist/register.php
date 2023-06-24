<?php
if ($_POST['name']) {
    $name = $_POST['name'];
    $description = $_POST['description'];
    $whitelist_category_id = $_POST['whitelist_category_id'];
    $website = $_POST['website'];
    $id_name = $_POST['id_name'];
    $id_number = $_POST['id_number'];
    $id_image = $_FILES['id_image'];

    $file = $id_image['tmp_name'];
    $file_name = $id_image['name'];
    $file_size = $id_image['size'];
    $file_type = $id_image['type'];

    if (Whitelist::count(['account_id' => $_SESSION['user_id']]) > 0) {
        echo Alert::alerts('บัญชีเจ้าของกิจการนี้ มีอยู่ในระบบแล้ว', 'error', 1500, 'window.history.back()');
        exit;
    }

    $data = Discord::postImage(config('discord.whitelist.proof'), ["file" => curl_file_create($file, $file_type, $file_name)]);
    $image_url = $data['attachments'][0]['url'];

    Whitelist::create([
        'name' => $name,
        'description' => $description,
        'whitelist_category_id' => $whitelist_category_id,
        'account_id' => $_SESSION['user_id'],
        'website' => $website,
        'id_name' => $id_name,
        'id_number' => $id_number,
        'id_image' => $image_url
    ]);

    $path = member_url('whitelist');
    echo Alert::alerts('เพิ่มกิจการสำเร็จ', 'success', 1500, 'window.location.href="' . $path . '"');
} else {
    redirect(member_url('whitelist.register'));
}
