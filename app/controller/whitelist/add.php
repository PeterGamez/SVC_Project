<?php
if ($_POST['name']) {
    $name = $_POST['name'];
    $description = $_POST['description'];
    $whitelist_category = $_POST['whitelist_category'];
    $website = $_POST['website'];
    $id_name = $_POST['id_name'];
    $id_card = $_POST['id_card'];
    $id_image = $_POST['id_image'];

    Whitelist::create([
        'name' => $name,
        'description' => $description,
        'whitelist_category' => $whitelist_category,
        'website' => $website,
        'id_name' => $id_name,
        'id_card' => $id_card,
        'id_image' => $id_image,
    ]);

    $path = admin_url('whitelist');
    echo Alert::alerts('เพิ่มกิจการสำเร็จ', 'success', 1500, 'window.location.href = "' . $path . '"');
} else {
    redirect(admin_url('whitelist.add'));
}
