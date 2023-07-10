<?php

namespace App\Class;

use App\Models\Account as ModelsAccount;
use App\Models\EmailVerify;

class Account
{
    public static function set_session(array $data): void
    {
        $_SESSION['login'] = true;
        $_SESSION['user_id'] = $data['id'];
        $_SESSION['user_username'] = $data['username'];
        $_SESSION['user_avatar'] = isset($data['avatar']) ? $data['avatar'] : resource('images/logo-1000.png', true);
        $_SESSION['user_role'] = $data['role'];
    }

    public static function create_verify_token(string $email)
    {
        $emailVerify = EmailVerify::findEmail(['email' => $email]);
        if ($emailVerify) {
            return false;
        } else {
            $token = App::RandomText(16);
            EmailVerify::create([
                'email' => $email,
                'token' => $token,
                'expired_at' => date('Y-m-d H:i:s', strtotime('+1 hour')),
            ]);

            $subject = config('site.name') . ': Verify Your Email';
            $body = Mail::verifypage(url('verify-email?token=' . $token));

            Mail::sendMail($email,  $subject, $body);
            return true;
        }
    }

    public static function verify_email(string $token): bool
    {
        $emailVerify = EmailVerify::findToken(['token' => $token]);
        if ($emailVerify) {
            EmailVerify::update(['id' => $emailVerify['id']], ['verifed' => 1]);
            ModelsAccount::update(['email' => $emailVerify['email']], ['email_verified' => 1, 'email_verified_at' => date('Y-m-d H:i:s')]);
            return true;
        } else {
            return false;
        }
    }
}
