<?php

use App\Class\Account;
use App\Class\Alert;
use App\Class\AlertLogin;
use App\Models\Account as ModelsAccount;
use Google\Client as GoogleClient;

require_once __ROOT__ . '/vendor/autoload.php';

if (isset($_POST['credential'])) {
    $client = new GoogleClient(['client_id' => config('site.google.id')]);
    $payload = $client->verifyIdToken($_POST['credential']);

    if ($payload) {
        if ($payload['email_verified'] == false) {
            echo Alert::alerts('กรุณายืนยันอีเมลก่อน', 'warning', 1500, 'history.back()');
            exit;
        }

        $data = ModelsAccount::find()->where('email', $payload['email'])->getOne();
        if ($data) {
            if ($data['email_verified'] == 0) {
                if (Account::create_verify_token($data['email'], 'verify') == true) {
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

            Account::set_session($data);
            ModelsAccount::login($data['id']);

            echo AlertLogin::succeed();
        } else {
            $data = ModelsAccount::find()->where('username', $payload['given_name'])->getOne();
            if ($data) {
                echo Alert::alerts('ชื่อบัญชี Google ของคุณมีผู้ใช้งานแล้ว', 'warning', 1500, 'history.back()');
                exit;
            }
            $password = password_hash($payload['jti'], PASSWORD_DEFAULT);
            $data = ModelsAccount::register([
                'username' => $payload['given_name'],
                'email' => $payload['email'],
                'password' => $password,
                'avatar' => $payload['picture'],
                'role' => 'user'
            ]);
            if (Account::create_verify_token($payload['email'], 'register')) {
                echo AlertLogin::verifyEmail();
            } else {
                echo Alert::alerts('ไม่สามารถส่งอีเมลยืนยันได้', 'error', 1500, 'window.location.href="' . member_url('login') . '"');
            }
        }
    } else {
        echo Alert::alerts('ไม่สามารถยืนยันตัวตนได้', 'error', 1500, 'history.back()');
    }
} else {
    redirect(member_url('login'));
}
