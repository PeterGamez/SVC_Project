<?php
if (isset($_POST['credential'])) {
    require_once('./vendor/autoload.php');

    $client = new Google_Client(['client_id' => config('site.google.id')]);
    $payload = $client->verifyIdToken($_POST['credential']);
    if ($payload) {
        $email = $payload['email'];

        $data = Login::get_email($email);

        if ($data) {
            Login::set_session($data);

            echo Alert_Login::succeed();
        } else {
            echo Alert_Login::alert('ไม่พบอีเมลในระบบ', 'warning', 1500, 'window.location.href = "/login"');
        }
    } else {
        echo 'User not found';
    }
} else {
    redirect(config('site.admin_panel') . '/login');
}
