<?php

use App\Class\Account;
use App\Class\AlertLogin;
use App\Models\Account as ModelsAccount;
use Google\Client as GoogleClient;

require_once __ROOT__ . '/vendor/autoload.php';

if (isset($_POST['credential'])) {
    $client = new GoogleClient(['client_id' => config('site.google.id')]);
    $payload = $client->verifyIdToken($_POST['credential']);
    if ($payload) {
        if ($payload['email_verified'] == false) {
            echo AlertLogin::alert('กรุณายืนยันอีเมลก่อน', 'warning', 1500, 'history.back()');
            exit;
        }

        $data = ModelsAccount::find()->where('email', $payload['email'])->getOne();
        if ($data) {
            if ($data['email_verified'] == 0) {
                if (Account::create_verify_token($data['email']) == true) {
                    echo AlertLogin::verifyEmail();
                } else {
                    echo AlertLogin::reverifyEmail();
                }
                exit;
            }

            if ($data['avatar'] <> $payload['picture']) {
                ModelsAccount::update(['id' => $data['id']], ['avatar' => $payload['picture']]);
            }
            $data['avatar'] = $payload['picture'];

            ModelsAccount::login($data['id']);
            Account::set_session($data);

            echo AlertLogin::succeed();
        } else {
            echo AlertLogin::alert('ไม่พบอีเมลในระบบ', 'warning', 1500, 'history.back()');
        }
    } else {
        echo AlertLogin::alert('ไม่สามารถยืนยันตัวตนได้', 'error', 1500, 'history.back()');
    }
} else {
    redirect(member_url('login'));
}
