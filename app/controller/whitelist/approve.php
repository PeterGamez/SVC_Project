<?php
if ($_POST['id']) {
    $id = $_POST['id'];
    $approve_agree = $_POST['approve_agree'];

    if (count(Whitelist::find(['id' => $id])) == 0) {
        echo Alert::alerts('ไม่พบกิจการนี้ในระบบ', 'error', null, 'window.history.back()');
        exit;
    }

    Whitelist::update(
        ['id' => $id],
        [
            'approve_agree' => $approve_agree,
            'update_at' => date('Y-m-d H:i:s'),
            'update_by' => $_SESSION['user_id']
        ]
    );

    $path = admin_url("whitelist.$id.view");
    echo Alert::alerts('แก้ไขกิจการสำเร็จ', 'success', 1500, 'window.location.href="' . $path . '"');
} else {
    redirect(admin_url('whitelist'));
}
