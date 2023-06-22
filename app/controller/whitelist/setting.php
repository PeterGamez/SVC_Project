<?php
if ($_POST['id']) {
    $id = $_POST['id'];
    $name = $_POST['name'];
    $description = $_POST['description'];
    $whitelist_category_id = $_POST['whitelist_category_id'];
    $website = $_POST['website'];


    if (Whitelist::count(['id' => $id]) == 0) {
        echo Alert::alerts('ไม่พบกิจการนี้ในระบบ', 'error', 1500, 'window.history.back()');
        exit;
    }
    if (Whitelist::count(['account_id' => $account_id]) > 0) {
        echo Alert::alerts('บัญชีเจ้าของกิจการนี้ มีอยู่ในระบบแล้ว', 'error', 1500, 'window.history.back()');
        exit;
    }

    $newData = [
        'name' => $name,
        'description' => $description,
        'whitelist_category_id' => $whitelist_category_id,
        'account_id' => $account_id,
        'website' => $website
    ];

    Whitelist::update(['id' => $id], $newData);

    $path = member_url('whitelist');
    echo Alert::alerts('แก้ไขกิจการสำเร็จ', 'success', 1500, 'window.location.href="' . $path . '"');
} else {
    redirect(member_url('whitelist.setting'));
}
