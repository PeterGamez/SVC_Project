<?php
if (isset($_POST['credential'])) {
    require_once('./vendor/autoload.php');

    $client = new Google_Client(['client_id' => config('site.google.id')]);
    $payload = $client->verifyIdToken($_POST['credential']);
    if ($payload) {
        if ($payload['email_verified'] == false) {
            echo Alert_Login::alert('กรุณายืนยันอีเมลก่อน', 'warning', 1500, 'history.back()');
            exit();
        }

        $data = Login::get_email($payload['email']);
        if ($data) {
            if ($data['avatar'] <> $payload['picture']) {
                Login::set_avatar($data['id'], $payload['picture']);
            }
            $data['avatar'] = $payload['picture'];
            Login::set_session($data);

            echo Alert_Login::succeed();
        } else {
            echo Alert_Login::alert('ไม่พบอีเมลในระบบ', 'warning', 1500, 'history.back()');
        }
    } else {
        echo Alert_Login::alert('ไม่สามารถยืนยันตัวตนได้', 'error', 1500, 'history.back()');
    }
} else {
    redirect(admin_url('login'));
}
