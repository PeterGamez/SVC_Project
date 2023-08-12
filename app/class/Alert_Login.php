<?php

namespace App\Class;

class AlertLogin extends Alert
{
    public static function contact()
    {
        return parent::alert('กรุณาติดต่อผู้ดูแลระบบ', 'error', 1500, 'history.back()');
    }

    public static function suspended()
    {
        return parent::alert('บัญชีของคุณถูกระงับการใช้งาน', 'error', 1500, 'history.back()');
    }

    public static function pass_mismatch()
    {
        return parent::alert('รหัสผ่านไม่ถูกต้อง', 'error', 1500, 'history.back()');
    }

    public static function verifyEmail()
    {
        return parent::alerts('ส่งอีเมลยืนยันสำเร็จ', 'หากไม่พบอีเมลกรุณาตรวจสอบที่ <b>จดหมายขยะ</b>', 'warning', 1500, 'window.location.href="' . member_url('login') . '"');
    }

    public static function reverifyEmail()
    {
        return parent::alerts('กรุณายืนยันอีเมลก่อนเข้าใช้งาน', 'หากไม่พบอีเมลกรุณาตรวจสอบที่ <b>จดหมายขยะ</b>', 'warning', 1500, 'window.location.href="' . member_url('login') . '"');
    }

    public static function succeed()
    {
        if (isset($_SESSION['callback'])) {
            $path = "window.location.href='$_SESSION[callback]'";
            unset($_SESSION['callback']);
        } else if (in_array($_SESSION['user_role'], ['superadmin', 'admin', 'staff'])) {
            $path = "window.location.href='" . admin_url() . "'";
        } else {
            $path = "window.location.href='" . member_url() . "'";
        }
        return AlertLogin::alert('เข้าสู่ระบบสำเร็จ', 'success', 1500, $path);
    }
}
