<?php

namespace App\Class;

class Alert
{
    public static function alert(string $title, string $icon, string $timer, string $willClose)
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
    public static function alerts(string $title, string $icon, string $timer, string $willClose)
    {
        return "<head>
            <script src='https://cdnjs.cloudflare.com/ajax/libs/sweetalert2/11.7.20/sweetalert2.all.min.js'></script>
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

    public static function error()
    {
        return Alert::alert('เกิดข้อผิดพลาด', 'error', 1500, 'history.back()');
    }
}
