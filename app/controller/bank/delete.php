<?php
if ($_POST['id']) {
    $id = $_POST['id'];

    if (Bank::count(['id' => $id]) == 0) {
        echo Alert::alerts('ไม่พบธนาคารนี้ในระบบ', 'error', 1500, 'window.history.back()');
        exit;
    }

    Bank::delete(['id' => $id]);

    $path = admin_url('bank');
    echo Alert::alerts('ลบธนาคารสำเร็จ', 'success', 1500, 'window.location.href="' . $path . '"');
} else {
    redirect(admin_url('bank'));
}
