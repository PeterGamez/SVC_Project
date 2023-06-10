<?php
class Alert
{
    static function alert($title, $icon, $timer, $willClose)
    {
        return "<body><script>
            Swal.fire({
                title: '$title',
                icon: '$icon',
                timer: $timer,
                willClose: () => {
                    $willClose
                }
            })
        </script></body>";
    }
    static function alerts($title, $icon, $timer, $willClose)
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
    static function error()
    {
        return Alert::alert('เกิดข้อผิดพลาด', 'error', 1500, 'history.back()');
    }
}
class Alert_Login
{
    static function alert($title, $icon, $timer, $willClose)
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
    static function contact()
    {
        return Alert_Login::alert('กรุณาติดต่อผู้ดูแลระบบ', 'error', 1500, 'history.back()');
    }
    static function suspended()
    {
        return Alert_Login::alert('บัญชีของคุณถูกระงับการใช้งาน', 'error', 1500, 'history.back()');
    }
    static function pass_mismatch()
    {
        return Alert_Login::alert('รหัสผ่านไม่ถูกต้อง', 'error', 1500, 'history.back()');
    }
    static function succeed()
    {
        if (isset($_SESSION['callback'])) {
            $path = "window.location.href = '$_SESSION[callback]'";
            unset($_SESSION['callback']);
        } else {
            $path = "window.location.href = '" . url(config('site.admin_panel')) . "'";
        }
        return Alert_Login::alert('เข้าสู่ระบบสำเร็จ', 'success', 1500, $path);
    }
}
