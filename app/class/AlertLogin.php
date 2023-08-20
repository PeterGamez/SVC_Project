<?php

namespace App\Class;

class AlertLogin extends Alert
{
    public static function contact(): string
    {
        return parent::alerts('กรุณาติดต่อผู้ดูแลระบบ', 'error', 1500, 'history.back()');
    }

    public static function suspended(): string
    {
        return parent::alerts('บัญชีของคุณถูกระงับการใช้งาน', 'error', 1500, 'history.back()');
    }

    public static function pass_mismatch(): string
    {
        return parent::alerts('รหัสผ่านไม่ถูกต้อง', 'error', 1500, 'history.back()');
    }

    public static function verifyEmail(): string
    {
        return parent::alerts2('ส่งอีเมลยืนยันสำเร็จ', 'หากไม่พบอีเมลกรุณาตรวจสอบที่ <b>จดหมายขยะ</b>', 'warning', 1500, 'window.location.href="' . member_url('login') . '"');
    }

    public static function unverifyEmail(): string
    {
        return parent::alerts('ไม่สามารถส่งอีเมลยืนยันได้', 'error', 1500, 'window.location.href="' . member_url('login') . '"');
    }

    public static function reverifyEmail(): string
    {
        return parent::alerts2('กรุณายืนยันอีเมลก่อนเข้าใช้งาน', 'หากไม่พบอีเมลกรุณาตรวจสอบที่ <b>จดหมายขยะ</b>', 'warning', 1500, 'window.location.href="' . member_url('login') . '"');
    }

    public static function succeed(): string
    {
        if (isset($_SESSION['callback'])) {
            $path = "window.location.href='$_SESSION[callback]'";
            unset($_SESSION['callback']);
        } else if (in_array($_SESSION['user_role'], ['superadmin', 'admin', 'staff'])) {
            $path = "window.location.href='" . admin_url() . "'";
        } else {
            $path = "window.location.href='" . member_url() . "'";
        }
        return parent::alerts('เข้าสู่ระบบสำเร็จ', 'success', 1500, $path);
    }
}
