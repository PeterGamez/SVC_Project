<?php

use App\Class\Account;
use App\Class\Alert_Login;
use App\Models\Account as ModelsAccount;
use Google\Client as GoogleClient;

require_once __ROOT__ . '/vendor/autoload.php';

if (isset($_POST['credential'])) {
    $client = new GoogleClient(['client_id' => config('site.google.id')]);
    $payload = $client->verifyIdToken($_POST['credential']);
    if ($payload) {
        if ($payload['email_verified'] == false) {
            echo Alert_Login::alert('กรุณายืนยันอีเมลก่อน', 'warning', 1500, 'history.back()');
            exit;
        }

        $data = ModelsAccount::find()->where('email', $payload['email'])->getOne();
        if ($data) {
            if ($data['email_verified'] == 0) {
                if (Account::create_verify_token($data['email']) == true) {
                    echo Alert_Login::verifyEmail();
                } else {
                    echo Alert_Login::reverifyEmail();
                }
                exit;
            }

            if ($data['avatar'] <> $payload['picture']) {
                ModelsAccount::update(['id' => $data['id']], ['avatar' => $payload['picture']]);
            }
            $data['avatar'] = $payload['picture'];

            ModelsAccount::update(["id" => $data["id"]], ["last_login" => date('Y-m-d H:i:s')]);
            Account::set_session($data);

            echo Alert_Login::succeed();
        } else {
            echo Alert_Login::alert('ไม่พบอีเมลในระบบ', 'warning', 1500, 'history.back()');
        }
    } else {
        echo Alert_Login::alert('ไม่สามารถยืนยันตัวตนได้', 'error', 1500, 'history.back()');
    }
} else {
    redirect(member_url('login'));
}
