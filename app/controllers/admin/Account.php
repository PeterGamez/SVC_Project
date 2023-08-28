<?php

namespace App\Controllers\Admin;

use App\Class\Alert;
use App\Models\Account as ModelsAccount;

class Account
{
    public static function add()
    {
        if ($_POST['username']) {
            $username = $_POST['username'];
            $email = $_POST['email'];
            $password = $_POST['password'];
            $role = $_POST['role'];

            if (ModelsAccount::count(['username' => $username, 'email' => $email], 'OR') > 0) {
                echo Alert::alerts('มีบัญชีนี้อยู่ในระบบแล้ว', 'error', 1500, 'window.history.back()');
                exit;
            }

            ModelsAccount::create([
                'username' => $username,
                'email' => $email,
                'password' => password_hash($password, PASSWORD_DEFAULT),
                'role' => $role
            ]);

            $path = admin_url('account');
            echo Alert::alerts('เพิ่มบัญชีสำเร็จ', 'success', 1500, 'window.location.href="' . $path . '"');
        } else {
            redirect(admin_url('account.add'));
        }
    }

    public static function delete()
    {
        if ($_POST['id']) {
            $id = $_POST['id'];

            $data = ModelsAccount::find()->where('id', $id)->getOne();
            if (count($data) == 0) {
                echo Alert::alerts('ไม่พบบัญชีนี้ในระบบ', 'error', 1500, 'window.history.back()');
                exit;
            }

            if ($data['role'] == 'superadmin' and $_SESSION['user_role'] <> 'superadmin') {
                echo Alert::alerts('คุณไม่มีสิทธิ์แก้ไขบัญชีนี้', 'error', 1500, 'window.history.back()');
                exit;
            }

            ModelsAccount::delete(['id' => $id]);

            $path = admin_url('account');
            echo Alert::alerts('ลบบัญชีสำเร็จ', 'success', 1500, 'window.location.href="' . $path . '"');
        } else {
            redirect(admin_url('account'));
        }
    }

    public static function edit()
    {
        if ($_POST['id']) {
            $id = $_POST['id'];
            $username = $_POST['username'];
            $email = $_POST['email'];
            $role = $_POST['role'];

            $data = ModelsAccount::find()->where('id', $id)->getOne();
            if (count($data) == 0) {
                echo Alert::alerts('ไม่พบบัญชีนี้ในระบบ', 'error', 1500, 'window.history.back()');
                exit;
            }

            if ($data['role'] == 'superadmin' and $_SESSION['user_role'] <> 'superadmin') {
                echo Alert::alerts('คุณไม่มีสิทธิ์แก้ไขบัญชีนี้', 'error', 1500, 'window.history.back()');
                exit;
            }

            if ($username <> $data['username']) {
                if (ModelsAccount::count(['username' => $username]) > 0) {
                    echo Alert::alerts('มีชื่อบัญชีนี้อยู่ในระบบแล้ว', 'error', 1500, 'window.history.back()');
                    exit;
                }
            }
            if ($email <> $data['email']) {
                if (ModelsAccount::count(['email' => $email]) > 0) {
                    echo Alert::alerts('มีอีเมลนี้อยู่ในระบบแล้ว', 'error', 1500, 'window.history.back()');
                    exit;
                }
            }

            ModelsAccount::update([
                'id' => $id
            ], [
                'username' => $username,
                'email' => $email,
                'role' => $role
            ]);

            $path = admin_url("account.$id");
            echo Alert::alerts('แก้ไขบัญชีสำเร็จ', 'success', 1500, 'window.location.href="' . $path . '"');
        } else {
            redirect(admin_url('account'));
        }
    }

    public static function password()
    {
        if ($_POST['id']) {
            $id = $_POST['id'];
            $password = $_POST['password'];

            $data = ModelsAccount::find()->where('id', $id)->getOne();
            if (count($data) == 0) {
                echo Alert::alerts('ไม่พบบัญชีนี้ในระบบ', 'error', 1500, 'window.history.back()');
                exit;
            }

            if ($data['role'] == 'superadmin' and $_SESSION['user_role'] <> 'superadmin') {
                echo Alert::alerts('คุณไม่มีสิทธิ์แก้ไขบัญชีนี้', 'error', 1500, 'window.history.back()');
                exit;
            }

            ModelsAccount::update(['id' => $id], ['password' => password_hash($password, PASSWORD_DEFAULT)]);

            $path = admin_url("account.$id");
            echo Alert::alerts('แก้ไขรหัสผ่านสำเร็จ', 'success', 1500, 'window.location.href="' . $path . '"');
        } else {
            redirect(admin_url('account'));
        }
    }
}
