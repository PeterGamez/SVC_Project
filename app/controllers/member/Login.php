<?php

namespace App\Controller\Member;

use App\Class\Account;
use App\Class\Alert;
use App\Class\AlertLogin;
use App\Class\App;
use App\Models\Account as ModelsAccount;
use Google\Client as GoogleClient;

require_once __ROOT__ . '/vendor/autoload.php';


class Login
{
    public static function register()
    {
        if (isset($_POST['user'])) {
            $captcha = App::Captcha($_POST['cf-turnstile-response']);
            if ($captcha == false) {
                exit;
            }

            // Register
            $user = strtolower($_POST['user']);
            $email = strtolower($_POST['email']);
            $password1 = $_POST['password1'];
            $password2 = $_POST['password2'];

            $data = ModelsAccount::find()->where('username', $user)->where('email', $user)->operator('OR')->getOne();
            if ($data) {
                echo Alert::alerts('ชื่อผู้ใช้งานหรืออีเมลนี้มีผู้ใช้งานแล้ว', 'warning', 1500, 'history.back()');
                exit;
            }
            if ($password1 != $password2) {
                echo AlertLogin::pass_mismatch();
                exit;
            }
            $password = password_hash($password1, PASSWORD_DEFAULT);
            $data = ModelsAccount::register([
                'username' => $user,
                'email' => $email,
                'password' => $password,
                'role' => 'user'
            ]);
            if ($data) {
                if (Account::create_verify_token($email, 'verify')) {
                    echo AlertLogin::verifyEmail();
                } else {
                    echo AlertLogin::unverifyEmail();
                }
            } else {
                echo Alert::alerts('ไม่สามารถลงทะเบียนได้', 'error', 1500, 'history.back()');
            }
        } else {
            redirect(member_url('login'));
        }
    }

    public static function form()
    {
        if (isset($_POST['user'])) {
            $captcha = App::Captcha($_POST['cf-turnstile-response']);
            if ($captcha == false) {
                exit;
            }

            // Login
            $user = strtolower($_POST['user']);
            $password = $_POST['password'];

            $data = ModelsAccount::find()->where('username', $user)->where('email', $user)->operator('OR')->getOne();
            if ($data) {
                if (!password_verify($password, $data['password'])) {
                    echo AlertLogin::pass_mismatch();
                    exit;
                }
                if ($data['email_verified'] == 0) {
                    if (Account::create_verify_token($data['email'], 'verify') == true) {
                        echo AlertLogin::verifyEmail();
                    } else {
                        echo AlertLogin::reverifyEmail();
                    }
                    exit;
                }

                Account::set_session($data);
                ModelsAccount::login($data['id']);

                echo AlertLogin::succeed();
            } else {
                echo Alert::alerts('ไม่พบชื่อผู้ใช้งาน', 'warning', 1500, 'history.back()');
            }
        } else {
            redirect(member_url('login'));
        }
    }

    public static function google()
    {
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

                    if ($data['avatar'] != $payload['picture']) {
                        ModelsAccount::update(['id' => $data['id']], ['avatar' => $payload['picture']]);
                        $data['avatar'] = $payload['picture'];
                    }

                    Account::set_session($data);
                    ModelsAccount::login($data['id']);

                    echo AlertLogin::succeed();
                } else {
                    $username = explode('@', $payload['email'])[0];
                    $username = preg_replace('/[^a-zA-Z0-9_]/', '', $username);
                    $data = ModelsAccount::find()->where('username', $username)->getOne();
                    if ($data) {
                        echo Alert::alerts('บัญชี Google ของคุณมีผู้ใช้งานแล้ว', 'warning', 1500, 'history.back()');
                        exit;
                    }

                    $password = password_hash($payload['jti'], PASSWORD_DEFAULT);
                    $data = ModelsAccount::register([
                        'username' => $username,
                        'email' => $payload['email'],
                        'password' => $password,
                        'avatar' => $payload['picture'],
                        'role' => 'user'
                    ]);

                    if (Account::create_verify_token($payload['email'], 'register')) {
                        echo AlertLogin::verifyEmail();
                    } else {
                        echo AlertLogin::unverifyEmail();
                    }
                }
            } else {
                echo Alert::alerts('ไม่สามารถยืนยันตัวตนได้', 'error', 1500, 'history.back()');
            }
        } else {
            redirect(member_url('login'));
        }
    }

    public static function register_email()
    {
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
    }

    public static function verify_email()
    {
        if (isset($_GET['token'])) {
            $token = $_GET['token'];

            $data = Account::verify_email($token);
            if ($data) {
                echo Alert::alerts('ยืนยันอีเมลสำเร็จ', 'success', 1500, 'window.location.href = "' . member_url('login') . '"');
            } else {
                echo Alert::alerts('ยืนยันอีเมลไม่สำเร็จ', 'error', 1500, 'window.location.href = "' . member_url('login') . '"');
            }
        } else {
            redirect(member_url('login'));
        }
    }

    public static function logout()
    {
        session_destroy();

        redirect(member_url('login'));
    }
}
