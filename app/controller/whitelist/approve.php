<?php
if ($_POST['id']) {
    $id = $_POST['id'];
    $approve_agree = $_POST['approve_agree'];

    if (Whitelist::count(['id' => $id]) == 0) {
        echo Alert::alerts('ไม่พบกิจการนี้ในระบบ', 'error', 1500, 'window.history.back()');
        exit;
    }

    Whitelist::update(['id' => $id], [
        'approve_agree' => $approve_agree,
        'approve_by' => $_SESSION['user_id'],
        'approve_at'=> date('Y-m-d H:i:s')
    ]);

    $path = admin_url("whitelist.$id.view");
    echo Alert::alerts('แก้ไขกิจการสำเร็จ', 'success', 1500, 'window.location.href="' . $path . '"');
} else {
    redirect(admin_url('whitelist'));
}
