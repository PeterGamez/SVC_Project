<?php

use App\Models\Account as ModelsAccount;
use App\Class\Account;
use App\Class\Alert;
use App\Class\AlertLogin;
use App\Models\EmailVerify;

if (isset($_POST['token'])) {
    $token = $_POST['token'];
    $password1 = $_POST['password1'];
    $password2 = $_POST['password2'];

    if ($password1 != $password2) {
        echo AlertLogin::pass_mismatch();
        return;
    }

    $password = password_hash($password1, PASSWORD_DEFAULT);

    $data = Account::register_email($token, $password);
    if ($data) {
        Account::set_session($data);
        ModelsAccount::login($data['id']);
        
        echo Alert::alerts('ยืนยันอีเมลสำเร็จ', 'success', 1500, 'window.location.href = "' . member_url() . '"');
    } else {
        echo Alert::alerts('ยืนยันอีเมลไม่สำเร็จ', 'error', 1500, 'window.location.href = "' . member_url('login') . '"');
    }
}
