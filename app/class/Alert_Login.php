<?php

namespace App\Class;

class Alert_Login
{
    public static function alert(string $title, string $icon, string $timer, string $willClose)
    {
        return "<head>
            <script src='https://cdnjs.cloudflare.com/ajax/libs/limonte-sweetalert2/11.7.3/sweetalert2.all.min.js'></script>
        </head>
        <body>
            <script>
                Swal.fire({
                    title: '" . $title . "',
                    icon: '" . $icon . "',
                    timer: " . $timer . ",
                    willClose: () => {
                        " . $willClose . "
                    }
                })
            </script>
        </body>";
    }
    public static function alert2(string $title, string $text, string $icon, string $timer, string $willClose)
    {
        return "<head>
            <script src='https://cdnjs.cloudflare.com/ajax/libs/limonte-sweetalert2/11.7.3/sweetalert2.all.min.js'></script>
        </head>
        <body>
            <script>
                Swal.fire({
                    title: '" . $title . "',
                    html: '" . $text . "',
                    icon: '" . $icon . "',
                    timer: " . $timer . ",
                    willClose: () => {
                        " . $willClose . "
                    }
                })
            </script>
        </body>";
    }

    public static function contact()
    {
        return Alert_Login::alert('กรุณาติดต่อผู้ดูแลระบบ', 'error', 1500, 'history.back()');
    }

    public static function suspended()
    {
        return Alert_Login::alert('บัญชีของคุณถูกระงับการใช้งาน', 'error', 1500, 'history.back()');
    }

    public static function pass_mismatch()
    {
        return Alert_Login::alert('รหัสผ่านไม่ถูกต้อง', 'error', 1500, 'history.back()');
    }

    public static function verifyEmail()
    {
        return Alert_Login::alert2('ส่งอีเมลยืนยันสำเร็จ', 'หากไม่พบอีเมลกรุณาตรวจสอบที่ <b>จดหมายขยะ</b>', 'warning', 1500, 'window.location.href="' . member_url('login') . '"');
    }

    public static function reverifyEmail()
    {
        return Alert_Login::alert2('กรุณายืนยันอีเมลก่อนเข้าใช้งาน', 'หากไม่พบอีเมลกรุณาตรวจสอบที่ <b>จดหมายขยะ</b>', 'warning', 1500, 'window.location.href="' . member_url('login') . '"');
    }

    public static function succeed()
    {
        if (isset($_SESSION['callback'])) {
            $path = "window.location.href='$_SESSION[callback]'";
            unset($_SESSION['callback']);
        } else if (in_array($_SESSION['user_role'], ['superadmin', 'admin', 'staff'])) {
            $path = "window.location.href='" . url(config('site.admin_panel')) . "'";
        } else {
            $path = "window.location.href='" . url(config('site.member_panel')) . "'";
        }
        return Alert_Login::alert('เข้าสู่ระบบสำเร็จ', 'success', 1500, $path);
    }
}
