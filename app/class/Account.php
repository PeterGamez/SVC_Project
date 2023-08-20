<?php

namespace App\Class;

use App\Models\Account as ModelsAccount;
use App\Models\EmailVerify;

class Account
{
    /**
     * @param array $data [id, username, email, &avatar, role]
     */
    public static function set_session(array $data): void
    {
        $_SESSION['login'] = true;
        $_SESSION['user_id'] = $data['id'];
        $_SESSION['user_username'] = $data['username'];
        $_SESSION['user_email'] = $data['email'];
        $_SESSION['user_avatar'] = isset($data['avatar']) ? $data['avatar'] : config('site.logo.128');
        $_SESSION['user_role'] = $data['role'];
    }

    public static function create_verify_token(string $email, string $type): bool
    {
        $emailVerify = EmailVerify::findEmail($email);
        if (!$emailVerify) {
            $token = App::RandomText(16);

            if ($type == 'verify') {
                $subject = config('site.name') . ': Verify Your Email';
                $body = Mail::verifypage(url('verify-email?token=' . $token));
            } else if ($type == 'register') {
                $subject = config('site.name') . ': Register';
                $body = Mail::registerpage(url('register-email?token=' . $token));
            } else {
                return false;
            }

            EmailVerify::create([
                'email' => $email,
                'token' => $token,
                'type' => $type,
                'expired_at' => date('Y-m-d H:i:s', strtotime('+1 hour')),
            ]);

            Mail::sendMail($email, $subject, $body);

            return true;
        }
        return false;
    }

    public static function verify_email(string $token): bool
    {
        $emailVerify = EmailVerify::findToken($token);
        if ($emailVerify) {
            if (EmailVerify::verifyEmail($emailVerify['id'])) {
                $user = ModelsAccount::find()->where('email', $emailVerify['email'])->getOne();
                if (ModelsAccount::verifyEmail($user['id'])) {
                    return true;
                }
            }
        }
        return false;
    }

    /**
     * @return array user data
     */
    public static function register_email(string $token, string $password): array|false
    {
        $emailVerify = EmailVerify::findToken($token);
        if ($emailVerify) {
            if (EmailVerify::verifyEmail($emailVerify['id'])) {
                $user = ModelsAccount::find()->where('email', $emailVerify['email'])->getOne();
                if (ModelsAccount::registerEmail($user['id'], $password)) {
                    return $user;
                }
            }
        }
        return false;
    }
}
