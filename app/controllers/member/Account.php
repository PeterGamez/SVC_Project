<?php

namespace App\Controllers\Member;

use App\Class\Alert;
use App\Models\Account as ModelsAccount;

class Account
{
    public static function password()
    {
        if ($_POST['password1']) {
            $password1 = $_POST['password1'];
            $password2 = $_POST['password2'];

            if ($password1 <> $password2) {
                echo Alert::alerts('รหัสผ่านไม่ตรงกัน', 'error', 1500, 'window.history.back()');
                exit;
            }

            ModelsAccount::update(['id' => $_SESSION['user_id']], ['password' => password_hash($password1, PASSWORD_DEFAULT)]);

            if (in_array($_SESSION['user_role'], ['superadmin', 'admin', 'staff'])) {
                $path = admin_url();
            } else {
                $path = member_url();
            }
            echo Alert::alerts('เปลี่ยนรหัสผ่านสำเร็จ', 'success', 1500, 'window.location.href="' . $path . '"');
        } else {
            if (in_array($_SESSION['user_role'], ['superadmin', 'admin', 'staff'])) {
                $path = admin_url();
            } else {
                $path = member_url();
            }
        }
    }
}
