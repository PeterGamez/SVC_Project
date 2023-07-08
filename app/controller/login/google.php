<?php
require_once('./vendor/autoload.php');

use App\Class\Alert_Login;
use App\Class\Account as ClassAccount;
use App\Models\Account;
use Google\Client as GoogleClient;

if (isset($_POST['credential'])) {
    $client = new GoogleClient(['client_id' => config('site.google.id')]);
    $payload = $client->verifyIdToken($_POST['credential']);
    if ($payload) {
        if ($payload['email_verified'] == false) {
            echo Alert_Login::alert('กรุณายืนยันอีเมลก่อน', 'warning', 1500, 'history.back()');
            exit;
        }

        $data = Account::findOne(['email' => $payload['email']]);
        if ($data) {
            if ($data['avatar'] <> $payload['picture']) {
                Account::update(['id' => $data['id']], ['avatar' => $payload['picture']]);
            }
            $data['avatar'] = $payload['picture'];
            ClassAccount::set_session($data);

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
